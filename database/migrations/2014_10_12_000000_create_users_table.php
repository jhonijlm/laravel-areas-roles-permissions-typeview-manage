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
            $table->id();

            $table->string('name')->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('cell_phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('user_created_id')->nullable();
            $table->bigInteger('user_deleted_id')->nullable();
            $table->bigInteger('user_updated_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
