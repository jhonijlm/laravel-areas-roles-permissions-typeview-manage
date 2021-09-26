<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_detail', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('type_view_id')->nullable();
            $table->unsignedBigInteger('permission_id')->nullable();

            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('type_view_id')->references('id')->on('type_view');
            $table->foreign('permission_id')->references('id')->on('permissions');

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
        Schema::dropIfExists('access_detail');
    }
}
