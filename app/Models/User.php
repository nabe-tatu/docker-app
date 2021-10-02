<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends AuthModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 主キーのインクリメントしない
     * @var bool
     */
    public $incrementing = false;

    /**
     * ブラックリスト、カラム指定
     * @var array
     */
    protected $guarded = [

    ];

//    /**
//     * ホワイトリスト
//     * @var array
//     */
//    protected $fillable = [];

    public $encryptable = [
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * つぶやき
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class,'user_id','id');
    }

    /**
     * コメント
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id','id');
    }

    /**
     * お気に入り
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class,'user_id','id');
    }
}
