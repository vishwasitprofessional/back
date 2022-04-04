<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVarientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_varients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pro_id')->unsigned()->default(0);
            $table->bigInteger('cat_id')->unsigned()->default(0);
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->string('slug',250);
            $table->string('title', 200)->nullable();
            $table->double('price',8,2)->default(0);
            $table->double('sale_price',8,2)->default(0);
            $table->integer('quantity')->default(0);
            $table->string('gross_weight', 200)->nullable();
            $table->string('dimensions', 500)->nullable();
            $table->string('image_url',250)->nullable();
            $table->float('discount')->default(0)->nullable();
            $table->integer('no_of_sale')->default(0);
            $table->enum('status', ['show', 'hide']);
            $table->tinyInteger('is_deleted')->default(0)->comment='0=not-delete,1-delete';

            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
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
        Schema::dropIfExists('product_varients');
    }
}
