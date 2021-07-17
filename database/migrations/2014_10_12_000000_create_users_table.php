<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->comment('id');

            $table->string('screen_name')
                ->nullable()
                ->default('ニックネーム')
                ->comment('表示用ニックネーム');

            $table->string('name')
                ->default('名前')
                ->comment('本名');

            $table->string('profile_image')
                ->index('users_profile_image_index')
                ->comment('プロフィール画像URL');

            $table->string('email')
                ->unique()
                ->comment('メールアドレス');

            $table->timestamp('email_verified_at')
                ->nullable()
                ->comment('??????');

            $table->string('password')
                ->comment('パスワード');

            $table->rememberToken()
                ->comment('??????');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
