<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * ユーザー登録
     * @param UserRequest $request
     * @return UserResource
     */
    public function store(UserRequest $request)
    {
        return $this->userService->store($request);
    }

    /**
     * ユーザー(プロフィール更新)
     * @param UserRequest $request
     * @param User $user
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        return $this->userService->update($request, $user);
    }

    /**
     * TODO::そもそもREST以外のAPIは別クラスに切り分けるべき？？
     * ログインユーザリソース取得
     * @param Request $request
     * @return UserResource
     */
    public function loginUser(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    /**
     * TODO::そもそもREST以外のAPIは別クラスに切り分けるべき？？
     * おすすめユーザー取得
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function recommendUsers(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return UserResource::collection(User::paginate(10));
    }

    /**
     * TODO::リクエストクラス作って切り分けたい
     * TODO::そもそもREST以外のAPIは別クラスに切り分けるべき？？
     * パスワード再設定URLをメールで送付
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function sendResetPasswordUrl(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
            ],422);
        }

        return $this->userService->sendResetPasswordUrlMail();
    }

    /**
     * TODO::リクエストクラス作って切り分けたい
     * TODO::そもそもREST以外のAPIは別クラスに切り分けるべき？？
     * パスワードを変更
     * @param Request $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users',
            'old_password' => [
                'required',
                'string',
                'max:30',
                function($attribute, $value, $fail) {
                    $this->userService->isCorrectPassword($attribute, $value, $fail);
                }
            ],
            'new_password' => 'required|string|max:30|confirmed',
            'new_password_confirmation' => 'required|string|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
            ],422);
        }

        return $this->userService->resetPassword($request);
    }
}
