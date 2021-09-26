<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120)->nullable();
            $table->text('content')->nullable();
            $table->integer('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->bigInteger('user_deleted_id')->nullable();
            $table->bigInteger('user_updated_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->dateTime('deleted_at', $precision = 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
