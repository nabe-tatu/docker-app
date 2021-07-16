<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as BaseModel;
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
}
