<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->bigInteger('user_id')->unsigned()->default(0);
            $table->bigInteger('address_id')->unsigned()->default(0);
            $table->string('tracking_no',200);
            $table->string('tracking_msg',500)->nullable();
            $table->string('payment_mode');
            $table->string('payment_id',20)->nullable();
            $table->double('total_amount', 8,2)->nullable();
            $table->double('total_gst', 8,2)->nullable();
            $table->double('total_cgst', 8,2)->nullable();
            $table->double('total_sgst', 8,2)->nullable();
            $table->double('shipping_cost', 8,2)->nullable();
            $table->double('grand_amount', 8,2)->nullable();
            $table->enum('payment_status',['pending', 'approved', 'declined', 'refunded'])->default('pending');
            $table->string('payment_details',255)->nullable();
            $table->enum('order_status',['pending', 'completed', 'canceled'])->default('pending');
            $table->enum('status',['pending', 'accepted', 'canceled'])->default('pending');
            $table->string('cancel_reason',500)->nullable();
            $table->tinyInteger('notify')->default(0);
            $table->tinyInteger('is_deleted')->default(0)->comment='0=not-delete,1-delete';
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('shipping_addresses')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
