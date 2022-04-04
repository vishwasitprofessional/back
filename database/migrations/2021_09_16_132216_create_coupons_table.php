<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('offer_name',200);
            $table->string('product_id')->default(0)->nullable();
            $table->string('coupon_code',20)->unique();
            $table->string('coupon_limit',20);
            $table->enum('coupon_type',['fixed', 'percent']);
            $table->string('coupon_price');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->enum('status',['active', 'disabled'])->default('active');
            $table->enum('visibility_status',['show', 'hide'])->default('show');
            $table->tinyInteger('is_deleted')->default(0)->comment='0=not-delete,1-delete';
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
        Schema::dropIfExists('coupons');
    }
}
