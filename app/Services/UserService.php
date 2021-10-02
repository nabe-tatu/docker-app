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
            ->formDataCollection(['new_password','old_password', 'new_password_confirmation'])
            ->when(
                $request->input('new_password'),
                function ($collection) use($request) {
                    return $collection->put('password', $request->input('new_password'));
                }
            )
            ->when(
                $request->file('profile_image'),
                function ($collection) use($request, $user) {
//                    $this->storeS3(
//                        $this->makePath('user/profile/', $user, $request),
//                        $request->file('profile_image')
//                    );
                    return $collection->put('profile_image', $request->file('profile_image'));
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
        Storage::put($path, $file);
    }

    /**
     * @param string $path
     * @param $user
     * @param $request
     * @return string
     */
    private function makePath(string $path, $user, $request): string
    {
        return config('api.s3.domain') . $path . $user->id . '/' . $request->file('profile_image')->getClientOriginalName();
    }
}
