<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersColumnToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->string('profile_image')
//                ->nullable()
//                ->default(NULL)
//                ->comment('プロフィール画像URL')
//                ->change();
//
//            $table->string('background_image')
//                ->nullable()
//                ->default(NULL)
//                ->comment('背景画像URL')
//                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('users', function (Blueprint $table) {
//            $table->string('profile_image')
//                ->comment('プロフィール画像URL')
//                ->change();
//
//            $table->string('background_image')
//                ->comment('背景画像URL')
//                ->change();
//        });
    }
}
