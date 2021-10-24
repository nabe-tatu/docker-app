<?php
namespace App\Services;

use App\Http\Requests\Request;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Support\Facades\Storage;

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
                'background_image_file'
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

                    $path = $this->storeS3(
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

                    $path = $this->storeS3(
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

    /**
     * @param string $path
     * @param $file
     */
    private function storeS3(string $path, $file)
    {
        return Storage::disk('s3')->put($path, $file);
    }
}
