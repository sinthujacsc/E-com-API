<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sale_details', function (Blueprint $table) {
            $table->bigIncrements('tranId');
            $table->unsignedBigInteger('itemId');//
            $table->double('SQty'); //
            $table->double('freeQty');//0
            $table->double('unitPrice');//single piece
            $table->double('totalAmount');
            $table->double('selling');//unitprice
            $table->double('cost');//0
            $table->double('lineDis');//0
            $table->double('lineDisAmount');//0
            $table->double('lineVatAmount');//0
            $table->string('isReturn',3)->default('');//no
            $table->double('costOfSale');//0
            $table->unsignedBigInteger('saleBriefId');//1
            $table->foreign('saleBriefId')->references('billId')->on('tbl_sale_briefs')->onDelete('cascade');
            $table->string('serialNo',50)->default('');
            $table->date('expiryDate');
            $table->string('batchNo',20)->default('');
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
        Schema::dropIfExists('tbl_sale_details');
    }
}
