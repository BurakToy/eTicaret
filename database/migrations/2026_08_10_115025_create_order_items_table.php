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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->string('product_name_snapshot',200);
            $table->decimal('unit_price',10,2);
            $table->integer('quantity');
            $table->decimal('line_total',10,2);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('order_id')->
                on('orders')->
                references('id')->onDelete('cascade');
            $table->foreign('product_id')->
                on('products')->
                references('id')->onDelete('cascade');
            $table->foreign('variant_id')->
                on('product_variants')->
                references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
