<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblSaleBrief extends Model
{
    use HasFactory;

    protected $table="tbl_sale_briefs";
    protected $primaryKey = 'billId';


    protected $fillable = [
        'dateOn',
        'billNo',
        'custId',
        'serviceId',
        'firstName',
        'lastName',
        'companyName',
        'billingAdd1',
        'billingAdd2',
        'billingCity',
        'billingPostcode',
        'billingCountry',
        'mobileNum',
        'email',
        'shippingFirstName',
        'shippingLastName',
        'shippingMobileNum',
        'shippingEmail',
        'shippingCompany',
        'shippingAdd1',
        'shippingAdd2',
        'shippingCity',
        'shippingPostcode',
        'shippingCountry',
        'discriptionOf',
        'grossTotal',
        'netTotal',
        'CNAmount',
        'totalPaid',
        'manAmount',
        'netAmount',
        'cashTendered',
        'balance',
        'performedOn',
        'userId',
        'userName',
        'compId',
        'compName',
        'isDeleted',
        'delUserId',
        'delUserName',
        'delCompId',
        'delCompName',
        'isActive',
        'disRate',
        'disAmout',
        'vatRate',
        'vatAmount',
        'stockRoomId',
        'systemRefNo',
        'dueDate',
        'CSHPaidOn',
        'CHQPaidOn',
        'CCSPaidOn',
        'CREPaidOn',
        'MOP',
        'tranCode',
        'nameOf',
        'advanceAmount',
        'dueAmount',
        'refundedAmount',
        'isPaused',
        'isExchangeBill',
        'exchangeAmount',
        'CCNBillId',
        'saleBillId',
        'cusBranchId',
        'salesRepId',
        'salesRepName',
        'waiterId',
        'tableId',
        'maxGuest',
        'serPer',
        'status',
        'paymentStatus'

    ];
    public function tblSaleDetail(){
        return $this->hasMany(tblSaleDetail::class, 'saleBriefId','billId');
    }
}
