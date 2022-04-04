<?php

use Database\Seeders\UsersSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::defaultStringLength(191);         
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 200);
            $table->string('contact', 20);
            $table->enum('user_type', ['user', 'admin', 'vendor']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('approved_status', ['unapproved', 'approved'])->default('unapproved');
           //start for merchant registeration fields
            $table->string('firm_name', 250)->nullable();
            $table->enum('firm_type', ['','Propreitor','Partnership','Trust','society'])->nullable();
            $table->string('firm_address', 250)->nullable();
            $table->string('contact_person_name', 250)->nullable();
            $table->string('contact_person_no', 250)->nullable();
            $table->string('pan_no', 250)->nullable();
            $table->string('address_proof_image', 250)->nullable();
            $table->string('godown_address', 250)->nullable();
            $table->string('nature_of_business', 250)->nullable();
            $table->string('product_type', 250)->nullable();
            $table->string('brand_name', 250)->nullable();
            $table->string('firm_registration_no', 250)->nullable();
            $table->dateTime('date_of_registration')->nullable();
            $table->string('fssai_lic_no', 250)->nullable();
            $table->string('gst_no', 250)->nullable();
            $table->string('year_of_establishment', 250)->nullable();
            $table->string('bank_account_name', 250)->nullable();
            $table->string('bank_account_no', 250)->nullable();
            $table->string('bank_name', 250)->nullable();
            $table->string('bank_branch_name', 250)->nullable();
            $table->string('bank_ifsc_code', 250)->nullable();
            $table->string('cancelled_cheque', 250)->nullable();
            //end for merchant registeration fields
            $table->tinyInteger('is_deleted')->default(0)->comment='0=not-delete,1-delete';
            $table->rememberToken();
            $table->timestamps();
        });
        
        // $seeder = new UsersSeeder();
        // $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
