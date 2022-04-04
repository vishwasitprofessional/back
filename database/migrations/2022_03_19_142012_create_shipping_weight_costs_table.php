<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingWeightCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_weight_costs', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->float('weight');
            $table->double('price',8,2);
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
        Schema::dropIfExists('shipping_weight_costs');
    }
}
