<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\UpdateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * ログインユーザリソース取得
     * @param Request $request
     * @return UserResource
     */
    public function loginUser(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * おすすめユーザー取得
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function recommendUsers()
    {
        return UserResource::collection(User::paginate(10));
    }

    /**
     * ユーザー(プロフィール更新)
     * @param UserRequest $request
     * @param User $user
     * @param UserService $userService
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user, UserService $userService)
    {
        return $userService->update($request, $user);
    }
}
