<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSaleBriefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sale_briefs', function (Blueprint $table) {
            $table->bigIncrements('billId');
            $table->date('dateOn');
            $table->string('billNo',20)->default('');
            $table->unsignedBigInteger('custId');
            $table->string('firstName',75)->default('');
            $table->string('lastName',95)->default('');
            $table->string('companyName',95)->default('');
            $table->string('email',100)->default('');
            $table->string('billingAdd1',255)->default('');
            $table->string('billingAdd2',255)->default('');
            $table->string('billingCity',255)->default('');
            $table->string('billingPostcode',255)->nullable('');
            $table->string('billingCountry',255)->default('');
            $table->string('shippingFirstName',255)->default('');
            $table->string('shippingLastName',255)->default('');
            $table->string('shippingMobileNum',255)->default('');
            $table->string('shippingEmail',255)->default('');
            $table->string('shippingCompany',255)->default('');
            $table->string('shippingAdd1',255)->default('');
            $table->string('shippingAdd2',255)->default('');
            $table->string('shippingCity',255)->default('');
            $table->string('shippingPostcode',255)->nullable('');
            $table->string('shippingCountry',255)->default('');
            $table->string('discriptionOf',255)->default('');
            $table->double('grossTotal');
            $table->double('netTotal');
            $table->double('CNAmount');
            $table->double('totalPaid');
            $table->double('manAmount');
            $table->double('netAmount');
            $table->decimal('cashTendered',19,4)->default(0); 
            $table->double('balance');
            $table->dateTime('performedOn');
            $table->unsignedBigInteger('userId');
            $table->string('userName',50)->default('');
            $table->unsignedBigInteger('compId');
            $table->string('compName',50)->default('');
            $table->string('isDeleted',5)->default('N');
            $table->unsignedBigInteger('delUserId');
            $table->string('delUserName',50)->default('');
            $table->unsignedBigInteger('delCompId');
            $table->string('delCompName',50)->default('');
            $table->string('isActive',5)->default('Y');
            $table->double('disRate');
            $table->double('disAmout');
            $table->double('vatRate');
            $table->double('vatAmount');
            $table->unsignedBigInteger('stockRoomId');
            $table->string('systemRefNo',200)->default('');
            $table->date('dueDate');
            $table->string('mobileNum',15)->default('');
            $table->double('CSHPaidOn');
            $table->double('CHQPaidOn');
            $table->double('CCSPaidOn');
            $table->double('CREPaidOn');
            $table->string('MOP',10)->default('');
            $table->string('tranCode',10)->default('');
            $table->string('nameOf',100)->default('');
            $table->decimal('advanceAmount',19,4)->default(0); 
            $table->decimal('dueAmount',19,4)->default(0); 
            $table->decimal('refundedAmount',19,4)->default(0); 
            $table->string('isPaused',5)->default('N');
            $table->string('isExchangeBill',5)->default('N');
            $table->decimal('exchangeAmount',19,4)->default(0); 
            $table->unsignedBigInteger('CCNBillId');
            $table->unsignedBigInteger('saleBillId');
            $table->unsignedBigInteger('cusBranchId');
            $table->unsignedBigInteger('salesRepId');
            $table->string('salesRepName',100)->default('');
            $table->unsignedBigInteger('waiterId');
            $table->unsignedBigInteger('tableId');
            $table->unsignedBigInteger('maxGuest');
            $table->double('serPer');
            $table->string('status');
            $table->string('paymentStatus');
            $table->unsignedBigInteger('serviceId');

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
        Schema::dropIfExists('tbl_sale_briefs');
    }
}
