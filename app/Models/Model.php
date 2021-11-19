<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

abstract class Model extends BaseModel
{
    /**
     * Increment OFF
     * @var bool
     */
    public $incrementing = false;

    /**
     * JSON 非表示カラム
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * 更新不可カラム
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * 主キーの型指定
     * @var string
     */
    protected $keyType = 'string';

    /**
     * グローバル設定
     */
    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    /**
     * カラム配列で取得
     * @return array
     */
    public function attributes()
    {
        return $this->attributesToArray();
    }

    /**
     * モデルデータをリフレッシュする
     * @param array $with
     * @return mixed
     */
    public function reload($with = [])
    {
        return static::whereId($this->id)->with($with)->first();
    }

    /**
     * TODO::理解する、もっといい方法、復号化は？、他の暗号化ロジック
     * パスワードをハッシュして保存
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            $value = Hash::make($value);
        }
        return parent::setAttribute($key, $value);
    }
}
