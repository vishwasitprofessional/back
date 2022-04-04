<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->string('meta_description',1000)->nullable();
            $table->string('meta_keywords',1000)->nullable();
            $table->string('logo',200)->nullable();
            $table->string('favicon',200)->nullable();
            $table->string('address',200)->nullable();
            $table->string('razorpay_key',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('whatsapp_no',20)->nullable();
            $table->string('fax',200)->nullable();
            $table->string('footer',200)->nullable();
            $table->string('footer_url',200)->nullable();
            $table->string('facebook_url',200)->nullable();
            $table->string('instagram_url',200)->nullable();
            $table->string('linkedin_url',200)->nullable();
            $table->string('pinterest_url',200)->nullable();
            $table->string('youtube_url',200)->nullable();
            $table->bigInteger('cat_id')->unsigned()->default(0);
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('general_settings');
    }
}
