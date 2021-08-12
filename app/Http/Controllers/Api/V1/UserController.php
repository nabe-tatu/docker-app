<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        try
        {
            $user = User::where('id', $user->id)->update([
                "screen_name" => $request->input('screen_name'),
                "name" => $request->input('name'),
                "introduction" => $request->input('introduction'),
                "profile_image" => $request->input('profile_image'),
                "background_image" => $request->input('background_image'),
                "email" => $request->input('email'),
                "password" => bcrypt($request->input('password'))
            ]);

        }catch (\Exception $e)
        {
            logger("error occurred on update user");
            logger("message:" . $e->getMessage());

            return response()->json([
                "message" => $e->getMessage()
            ],400);
        }

        return response()->json([
            "message" => "success update user",
            "user" => $user
        ],200);
    }
}
