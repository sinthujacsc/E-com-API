<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_companies', function (Blueprint $table) {
            $table->bigIncrements('custId');
            $table->string('code',50)->default('');
            $table->string('nameOf',200)->default('');
            $table->string('add1',250)->default('');
            $table->string('add2',250)->default('');
            $table->string('city',250)->default('');
            $table->string('state',250)->default('');
            $table->string('zipcode',20)->default('');
            $table->string('message',500)->default('');
            $table->string('tel1',15)->default('');
            $table->string('tel2',15)->default('');
            $table->string('tel3',15)->default('');
            $table->string('email',50)->default('');
            $table->string('logo',50)->default('');
            $table->string('isActive',5)->default('Y'); 
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
        Schema::dropIfExists('tbl_companies');
    }
}
