<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faqcategory_id');
            $table->foreign('faqcategory_id')->references('custId')->on('tbl_faq_categories')->onDelete('cascade');
            $table->string('question',500)->default('');
            $table->string('answer',1000)->default('');
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
        Schema::dropIfExists('tbl_faqs');
    }
}
