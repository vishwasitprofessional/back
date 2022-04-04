<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
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
            $table->bigInteger('order_id')->unsigned()->default(0);
            $table->integer('varient_id')->unsigned()->default(0);
            $table->bigInteger('vendor_id')->unsigned()->default(0);
            $table->double('price', 8,2);
            $table->integer('quantity');
            $table->double('amount', 8,2);
            $table->double('tax_amount', 8,2)->nullable();
            $table->double('discount', 8,2)->nullable();
            $table->decimal('gst_in_percentage', 10, 2)->default(0)->nullable();
            $table->double('gst', 8,2)->default(0)->nullable();
            $table->double('cgst', 8,2)->default(0)->nullable();
            $table->double('sgst', 8,2)->default(0)->nullable();
            $table->enum('order_status',['', 'completed', 'canceled'])->default('');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('varient_id')->references('id')->on('product_varients')->onDelete('cascade');
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
        Schema::dropIfExists('order_items');
    }
}
