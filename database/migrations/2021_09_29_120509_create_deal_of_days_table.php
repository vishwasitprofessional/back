<?php

use Database\Seeders\DealOfDayssSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealOfDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_of_days', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pro_id')->unsigned()->default(0);
            $table->enum('status',['active', 'inactive'])->default('inactive');
            $table->tinyInteger('is_deleted')->default(0)->comment='0=not-delete,1-delete';
            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });

        // $seeder = new DealOfDayssSeeder();
        // $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_of_days');
    }
}
