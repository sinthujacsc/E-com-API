<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMajorCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_major_categories', function (Blueprint $table) {
            $table->bigIncrements('custId');
            $table->string('code',50)->default('');
            $table->string('nameOf',200)->default('');
            $table->string('icon',200)->default('');
            $table->string('imgPath',500)->default('');
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
        Schema::dropIfExists('tbl_major_categories');
    }
}
