<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customers', function (Blueprint $table) {
            
            $table->bigIncrements('custId');
            $table->string('code',50)->default('');
            $table->string('title',200)->default('');
            $table->string('firstName',255)->default('');
            $table->string('lastName',255)->default('');
            $table->string('email',255)->default('');
            $table->string('password',250)->default('');
            $table->date('dateOfBirth')->nullable('')->default(null);
            $table->string('mobileNum',15)->default('');
            $table->string('billingAdd1',255)->default('');
            $table->string('billingAdd2',255)->default('');
            $table->string('billingCity',255)->default('');
            $table->string('billingPostcode',255)->nullable('');
            $table->string('billingCountry',255)->default('');
            $table->string('imagePath',255)->default('');
            $table->string('coverImagePath',255)->default('');
            $table->string('cusIP',100)->nullable('')->default('');
            $table->string('lastVisit',50)->nullable('')->default('');
            $table->string('isActive',3)->default('Y');
            $table->string('isBlocked',3)->default('N');
            $table->string('shippingAdd1',255)->default('');
            $table->string('shippingAdd2',255)->default('');
            $table->string('shippingCity',255)->default('');
            $table->string('shippingPostcode',255)->nullable('');
            $table->string('shippingCountry',255)->default('');
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
        Schema::dropIfExists('tbl_customers');
    }
}
