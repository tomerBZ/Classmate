<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_friends', function (Blueprint $table) {
            $table->integer('friend_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('accepted')->default(false);

            $table->primary(['user_id', 'friend_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_friends', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'friend_id']);
        });
        Schema::dropIfExists('users_friends');
    }
}
