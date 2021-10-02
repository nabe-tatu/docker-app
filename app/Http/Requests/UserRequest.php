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
            'introduction' => 'required||string|max:255',
            'profile_image' => 'sometimes|image',
            'background_image' => 'sometimes|string|max:255',
            'email' => 'required|email|max:255',
//            'email_verified_at' => 'nullable|date',
            'old_password' => 'sometimes|string|max:30',
            'new_password' => 'sometimes|string|max:30',
            'new_password_confirmation' => 'sometimes|string|max:30',
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
        $validation = [
            'screen_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'introduction' => 'required||string|max:255',
            'email' => 'required|email|max:255',
        ];

        if ($this->input('isChangePass'))
        {
            $validation = array_merge($validation,[
                'old_password' => 'required|string|max:30',
                'new_password' => 'required|string|max:30|confirmed',
                'new_password_confirmation' => 'required|string|max:30',
            ]);
        }

        if ($this->file('profile_image'))
        {
            $validation = array_merge($validation,[
                'profile_image' => 'required|image'
            ]);
        }

        if ($this->file('background_image'))
        {
            $validation = array_merge($validation,[
                'background_image' => 'required|image'
            ]);
        }

        return $validation;
    }
}
