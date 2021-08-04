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
            'screen_name' => '',
            'name' => '',
            'introduction' => '',
            'profile_image' => '',
            'background_image' => '',
            'email' => '',
            'email_verified_at' => '',
            'password' => '',
            'remember_token' => '',
            'created_at' => '',
            'updated_at' => '',
            'deleted_at' => ''
        ];
    }

    /**
     * 編集ルール
     * @return array
     */
    public function editRules(): array
    {
        return [
            'screen_name' => '',
            'name' => '',
            'introduction' => '',
            'profile_image' => '',
            'background_image' => '',
            'email' => '',
            'email_verified_at' => '',
            'password' => '',
            'remember_token' => '',
            'created_at' => '',
            'updated_at' => '',
            'deleted_at' => ''
        ];
    }
}
