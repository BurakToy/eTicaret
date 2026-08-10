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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type',50);
            $table->string('title',200);
            $table->text('message');
            $table->string('related_entity_type',50)->nullable();
            $table->bigInteger('related_entity_id')->nullable();
            $table->boolean('is_read');
            $table->unsignedBigInteger('recipient_user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('recipient_user_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
