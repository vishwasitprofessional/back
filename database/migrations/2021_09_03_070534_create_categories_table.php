<?php

use Database\Seeders\CategoriesSeeder;
use Database\Seeders\ProductsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title',250);
            $table->string('slug',250)->unique();
            $table->boolean('is_parent')->default(true);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('description',10000)->nullable();
            $table->string('image_url1',250)->nullable();
            $table->string('image_url2',250)->nullable();
            $table->string('image_url3',250)->nullable();
            $table->string('image_url4',250)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->tinyInteger('is_deleted')->default(0)->comment='0=not-delete,1-delete';
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->timestamps();
        });

        // $seeder = new CategoriesSeeder();
        // $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
