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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('user_id');
            $table->string('title',100);
            $table->string('recipient_name',150);
            $table->string('phone',20);
            $table->string('city',100);
            $table->string('district',100);
            $table->text('full_address');
            $table->string('postal_code',10)->nullable();
            $table->boolean('is_default')->default(false);
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
