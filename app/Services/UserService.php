<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return UserResource|string
     */
    public function store(Request $request)
    {
        $user = $this->userRepository->store(
            $request
                ->formDataCollection([
                    'profile_image_file',
                    'background_image_file',
                    'password_confirmation'
                ])
                ->toArray()
        );

        return new UserResource($user);
    }

    /**
     * ユーザー(プロフィール更新)
     * @param Request $request
     * @param User $user
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request
            ->formDataCollection([
                'new_password',
                'old_password',
                'new_password_confirmation',
                'profile_image_file',
                'profile_image_url',
                'background_image_file',
                'background_image_url'
            ])
            ->when(
                $request->input('new_password'),
                function ($collection) use($request) {
                    return $collection->put('password', $request->input('new_password'));
                }
            )
            ->when(
                $request->input('isDeleteProfileImg'),
                function ($collection) use($request, $user) {

                    $path = '/user/profile/' . $user->id;

                    Storage::disk('s3')->deleteDirectory($path);

                    return $collection->put(
                        'profile_image',
                        null
                    );
                }
            )
            ->when(
                $request->input('isDeleteBackgroundImg'),
                function ($collection) use($request, $user) {

                    $path = '/user/background/' . $user->id;

                    Storage::disk('s3')->deleteDirectory($path);

                    return $collection->put(
                        'background_image',
                        null
                    );
                }
            )
            ->when(
                $request->file('profile_image_file'),
                function ($collection) use($request, $user) {

                    $path = '/user/profile/' . $user->id;

                    Storage::disk('s3')->deleteDirectory($path);

                    $path = $this->putS3(
                        $path,
                        $request->file('profile_image_file')
                    );

                    return $collection->put(
                        'profile_image',
                        config('api.s3.domain') . $path
                    );
                }
            )
            ->when(
                $request->file('background_image_file'),
                function ($collection) use($request, $user) {

                    $path = '/user/background/' . $user->id;

                    Storage::disk('s3')->deleteDirectory($path);

                    $path = $this->putS3(
                        $path,
                        $request->file('background_image_file')
                    );

                    return $collection->put(
                        'background_image',
                        config('api.s3.domain') . $path
                    );
                }
            )
            ->toArray();

        return new UserResource($this->userRepository->update($user, $data));
    }

    public function sendResetPasswordUrl(): string
    {
        return URL::temporarySignedRoute(
            'resetPassword',
            now()->addSeconds(10000),
            ['email' => \request()->input('email')]
        );
    }

    public function resetPassword(Request $request): UserResource
    {
        $user = $this->userRepository->firstByEmail($request->input('email'));

        return new UserResource(
            $this->userRepository->update(
                $user,
                ['password' => $request->input('new_password')]
            )
        );
    }

    public function isCorrectPassword($attribute, $value, $fail)
    {
        $user = User::where('email', \request()->input('email'))->first();

        if (is_null($user)) {
            return;
        }

        if(! Hash::check($value, $user->password)){
            $fail($attribute.'が違います');
        }
    }

    private function storeS3($user): \Illuminate\Support\Collection
    {
        $collection = collect($user);

        $profilePath = '/user/profile/' . $user->id;
        $backgroundPath = '/user/background/' . $user->id;

        $profilePath = $this->putS3(
            $profilePath,
            request()->file('profile_image_file')
        );

        $backgroundPath = $this->putS3(
            $backgroundPath,
            request()->file('background_image_file')
        );

        $collection = $collection->put(
            'profile_image',
            config('api.s3.domain') . $profilePath
        );

        $collection = $collection->put(
            'background_image',
            config('api.s3.domain') . $backgroundPath
        );

        return $collection;
    }

    /**
     * @param string $path
     * @param $file
     * @return bool
     */
    private function putS3(string $path, $file): bool
    {
        return Storage::disk('s3')->put($path, $file);
    }
}
