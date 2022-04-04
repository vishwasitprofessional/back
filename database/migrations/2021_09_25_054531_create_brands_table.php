<?php

use Database\Seeders\BrandsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->string('slug',200)->unique();
            $table->string('image_url',250)->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->tinyInteger('is_deleted')->default(0)->comment='0=not-delete,1-delete';
            $table->timestamps();
        });
        
        // $seeder = new BrandsSeeder();
        // $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
