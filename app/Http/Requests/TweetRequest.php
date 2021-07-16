<?php

namespace App\Http\Requests;

//use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends Request
{
    /**
     * 作成ルール
     * @return array
     */
    public function createRules(): array
    {
        return [];
    }

    /**
     * 編集ルール
     * @return array
     */
    public function editRules(): array
    {
        return [];
    }
//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * @return bool
//     */
//    public function authorize()
//    {
//        return false;
//    }
//
//    /**
//     * Get the validation rules that apply to the request.
//     *
//     * @return array
//     */
//    public function rules()
//    {
//        return [
//            //
//        ];
//    }
}
