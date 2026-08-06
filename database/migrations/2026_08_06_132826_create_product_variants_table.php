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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('sku',60)->unique();
            $table->string('color',50)->nullable();
            $table->string('size',30)->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->decimal('discount_price',10,2)->nullable();
            $table->integer('stock');
            $table->integer('min_stock_level')->nullable();
            $table->string('image_path',255)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id')->on('products')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
