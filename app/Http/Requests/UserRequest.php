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
            'profile_image' => 'sometimes|string|max:255',
            'background_image' => 'sometimes|string|max:255',
            'email' => 'required|email|max:255',
//            'email_verified_at' => 'nullable|date',
            'old_password' => 'sometimes|string|max:30',
            'new_password' => 'sometimes|string|max:30',
            'new_password_confirm' => 'sometimes|string|max:30',
//            'remember_token' => 'nullable|string|max:255',
//            'created_at' => 'nullable|date',
//            'updated_at' => 'nullable|date',
//            'deleted_at' => 'nullable|date'
        ];
    }

    /**
     * 編集ルール
     * @return array
     */
    public function editRules(): array
    {
        if ($this->input('isChangePass'))
        {
            return [
                'screen_name' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'introduction' => 'required|string|max:255',
                'profile_image' => 'sometimes|string|max:255',
                'background_image' => 'sometimes|string|max:255',
                'email' => 'required|email|max:255',
                'old_password' => 'required|string|max:30',
                'new_password' => 'required|string|max:30',
                'new_password_confirm' => 'required|string|max:30',
            ];
        }else{
            return [
                'screen_name' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'introduction' => 'required|string|max:255',
                'profile_image' => 'sometimes|string|max:255',
                'background_image' => 'sometimes|string|max:255',
                'email' => 'required|email|max:255',
            ];
        }
    }
}
