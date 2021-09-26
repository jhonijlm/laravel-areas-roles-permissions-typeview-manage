<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50)->nullable();
            $table->string("slug", 50)->nullable();
            $table->string("description", 255)->nullable();
            $table->integer('repeat')->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('user_created_id')->nullable();
            $table->bigInteger('user_deleted_id')->nullable();
            $table->bigInteger('user_updated_id')->nullable();
            $table->dateTime('created_at', $precision = 0)->nullable();
            $table->dateTime('updated_at', $precision = 0)->nullable();
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
        Schema::dropIfExists('roles');
    }
}
