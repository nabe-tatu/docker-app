<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class UserService extends Service
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
     * TODO::もっと簡単に書きたい
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

    /**
     * パスワード再設定メール送信
     * @return string
     */
    public function sendResetPasswordUrlMail(): string
    {
         $this->sendMail(
             \request()->input('email'),
             'Fine パスワード変更',
             $this->resetPasswordUrl()
         );

         return 'success';
    }

    /**
     * パスワード再設定画面を返却するURL生成
     * 時間制限付き
     * 180秒
     * パラメーターを潰す際に制限時間を付与(DBやファイルで管理しているわけではない)
     * URLを知っていれば時間内であれば誰でもアクセス可能
     * @return string
     */
    private function resetPasswordUrl(): string
    {
        return URL::temporarySignedRoute(
            'resetPassword',
            now()->addSeconds(180),
            ['email' => \request()->input('email')]
        );
    }

    /**
     * パスワードを変更
     * @param Request $request
     * @return UserResource
     */
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

    /**
     * TODO::リクエストクラス作って切り分けたい
     * 認証通る前のユーザーのIDパスワードが正しいかチェック
     * バリデーションのロジック
     * @param $attribute
     * @param $value
     * @param $fail
     */
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

    /**
     * S3にファイルおく
     * @param string $path
     * @param $file
     * @return bool
     */
    private function putS3(string $path, $file): bool
    {
        return Storage::disk('s3')->put($path, $file);
    }
}
