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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('sku',60)->unique();
            $table->string('barcode',60)->unique()->nullable();
            $table->string('name',200);
            $table->string('slug',220)->unique();
            $table->string('short_description',500);
            $table->text('long_description');
            $table->string('seo_title',200)->nullable();
            $table->string('seo_description',300)->nullable();
            $table->decimal('price',10,2);
            $table->decimal('discount_price',10,2)->nullable();
            $table->decimal('vat_rate',5,2);
            $table->enum('status',['draft','published','archived']);
            $table->boolean('has_variants');
            $table->integer('stock')->nullable();
            $table->integer('min_stock_level')->nullable();
            $table->boolean('is_new');
            $table->boolean('is_bestseller');
            $table->boolean('is_featured');
            $table->boolean('is_campaign');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade');
            $table->foreign('brand_id')->on('brands')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
