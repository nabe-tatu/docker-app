<?php

namespace App\Http\Requests;

class UserRequest extends Request
{
    /**
     * 作成ルール
     * @return array
     */
    public function createRules(): array
    {
        return [
            'screen_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
            'profile_image' => 'required|string|max:255',
            'background_image' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|max:255',
            'remember_token' => 'nullable|string|max:255',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'deleted_at' => 'nullable|date'
        ];
    }

    /**
     * 編集ルール
     * @return array
     */
    public function editRules(): array
    {
        return [
            'screen_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
            'profile_image' => 'required|string|max:255',
            'background_image' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|max:255',
            'remember_token' => 'nullable|string|max:255',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'deleted_at' => 'nullable|date'
        ];
    }
}
