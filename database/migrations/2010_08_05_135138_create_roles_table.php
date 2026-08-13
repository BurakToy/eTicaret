<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('role_id');
            $table->string('role_name',100)->unique();
            $table->bigInteger('permissions_id');
            $table->string('permissions_name',100)->unique();
            $table->bigInteger('role_permission_role_id');
            $table->bigInteger('role_permission_permission_id');
            $table->softDeletes();
            $table->timestamps();
            //foreign key çoka çok eklenecek anlamdım

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
};
