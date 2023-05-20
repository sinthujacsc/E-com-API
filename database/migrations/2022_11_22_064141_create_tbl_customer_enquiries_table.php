<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCustomerEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('email',100);
            $table->string('subject',150);
            $table->string('message',500);
            $table->string('phone',15);
            $table->string('isViewed',10)->default('Y');
            $table->rememberToken();
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
        Schema::dropIfExists('tbl_customer_enquiries');
    }
}
