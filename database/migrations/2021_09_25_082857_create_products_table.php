<?php

use Database\Seeders\ProductsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->integer('varient_id')->unsigned()->default(0);
            $table->string('title', 200);
            // $table->string('slug', 200)->unique();
            $table->string('short_description', 2000)->nullable();
            $table->string('description', 10000)->nullable();
            $table->bigInteger('cat_id')->unsigned()->default(0);
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->decimal('gst_in_percentage', 10, 2)->default(0)->nullable();
            $table->string('code', 20)->nullable();
            $table->enum('status', ['show', 'hide']);
            $table->string('image_url1',250)->nullable();
            $table->string('image_url2',250)->nullable();
            $table->string('image_url3',250)->nullable();
            $table->string('image_url4',250)->nullable();
            $table->tinyInteger('is_deleted')->default(0)->comment='0=not-delete,1-delete';

            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->timestamps();
        });
        
        // $seeder = new ProductsSeeder();
        // $seeder->run();
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
}
