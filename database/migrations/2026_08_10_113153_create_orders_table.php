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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number',30)->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('guest_name',150)->nullable();
            $table->string('guest_email',150)->nullable();
            $table->string('guest_phone',20)->nullable();
            $table->json('shipping_address_snapshot');
            $table->json('billing_address_snapshot')->nullable();
            $table->enum('payment_method',['cod','bank','transfer']);
            $table->enum('status',['pending','confirmed','preparing','shipped','completed','cancelled']);
            $table->decimal('subtotal',10,2);
            $table->decimal('discount_total',10,2)->nullable();
            $table->decimal('vat_total',10,2);
            $table->decimal('grand_total',10,2);
            $table->text('customer_note')->nullable();
            $table->text('admin_note')->nullable();
            $table->string('shipping_tracking_number',60)->nullable();
            $table->string('contract_version_accepted',20);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
