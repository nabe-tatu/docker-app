<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * フォームデータを取得するメソッド
     * @param array $without
     * @return array
     */
    public function formData($without = []): array
    {
        return collect($this->only(array_keys($this->rules())))->except($without)->toArray();
    }

    /**
     * フォームデータCollectionを取得するメソッド
     * @param array $without
     * @return Collection
     */
    public function formDataCollection($without = []): Collection
    {
        return collect($this->only(array_keys($this->rules())))->except($without);
    }

    /**
     * 入力チェックルール
     * @return array
     */
    public function rules(): array
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                {
                    return $this->createRules();
                }
            // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return $this->editRules();
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    /**
     * 作成ルール
     * @return array
     */
    abstract public function createRules(): array;

    /**
     * 編集ルール
     * @return array
     */
    abstract public function editRules(): array;
}
