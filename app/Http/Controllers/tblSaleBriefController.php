<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\tblSaleBrief;
use App\Models\tblSaleDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class tblSaleBriefController extends Controller
{
    
    public function index()
    {
        $data = DB::table('tbl_sale_briefs')   
        ->get(); 
    
           return response()->json(['status'=> true,
                                    'data'=>$data]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $latestOrder = tblSaleBrief::orderBy('created_at','DESC')->first();
        $data = new tblSaleBrief;
        $data->dateOn = Carbon::now()->toDateTimeString();
        $data->billNo = '#'.str_pad($latestOrder->billId + 1, 8, "0", STR_PAD_LEFT);;
        $data->custId = $request->custId;
        $data->firstName = $request ->firstName;
        $data->lastName = $request ->lastName;
        $data->mobileNum = $request->mobileNum;
        $data->serviceId = $request->serviceId;
        $data->email = $request->email;
        $data->companyName = '';
        $data->billingAdd1 = $request ->billingAdd1;
        $data->billingAdd2 = $request ->billingAdd2;
        $data->billingCity = $request ->billingCity;
        $data->billingPostcode = $request ->billingPostcode;
        $data->billingCountry = $request ->billingCountry;
        $data->shippingFirstName = $request ->shippingFirstName;
        $data->shippingLastName = $request ->shippingLastName;
        $data->shippingEmail = $request ->shippingEmail;
        $data->shippingCompany = '';
        $data->shippingMobileNum = $request ->shippingMobileNum;
        $data->shippingAdd1 = $request ->shippingAdd1;
        $data->shippingAdd2 = $request ->shippingAdd2;
        $data->shippingCity = $request ->shippingCity;
        $data->shippingPostcode = $request ->shippingPostcode;
        $data->shippingCountry = $request ->shippingCountry;
        $data->discriptionOf = '';//
        $data->grossTotal = $request ->grossTotal;
        $data->netTotal = $request ->netTotal;
        $data->CNAmount = 0;
        $data->totalPaid = $request ->totalPaid;
        $data->manAmount = $request ->manAmount;
        $data->netAmount = $request ->netAmount;
        $data->cashTendered = $request ->cashTendered;
        $data->balance = 0;
        $data->performedOn = Carbon::now()->toDateTimeString();//now date
        $data->userId = $request->custId;
        $data->userName = $request ->firstName .' '.$request ->lastName;
        $data->compId = $request->compId;
        $data->compName ='';
        $data->isDeleted = 'N';
        $data->delUserId = 0;
        $data->delUserName = '';
        $data->delCompId = 0;
        $data->delCompName ='';
        $data->isActive = 'Y';
        $data->disRate = 0;
        $data->disAmout = 0;
        $data->vatRate = 0;
        $data->vatAmount = 0;
        $data->stockRoomId = 1;
        $data->systemRefNo = Str::uuid()->toString();//GUID
        $data->dueDate = Carbon::now()->toDateTimeString();//now date
        $data->CSHPaidOn = 0;
        $data->CCSPaidOn = 0;
        $data->CHQPaidOn = 0;
        $data->CREPaidOn = 0;
        $data->MOP = 0;
        $data->tranCode = 'sale';
        $data->nameOf = '';
        $data->advanceAmount = 0;
        $data->dueAmount = 0;
        $data->refundedAmount = 0;
        $data->isPaused = 'N';
        $data->isExchangeBill ='N';
        $data->exchangeAmount = 0;
        $data->CCNBillId = 0;
        $data->saleBillId = 0;
        $data->cusBranchId = 0;
        $data->salesRepId = 0;
        $data->salesRepName = '';
        $data->waiterId = 0;
        $data->tableId = 0;
        $data->maxGuest = 0;
        $data->serPer = 0;
        $data->status = 'pending';
        $data->paymentStatus = $request->paymentStatus;

        $data->save(); 
        return response()->json(['status' => true,
                                'message' => "Data Created Successfully",'data'=>$data],201); 
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = tblSaleBrief::findOrFail($id);
        return response()->json($data, 200);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =  tblSaleBrief::find($id);
        $data->mobileNum = $request->mobileNum;
        $data->billingAdd1 = $request->billingAdd1;
        $data->billingAdd2 = $request->billingAdd2;
        $data->billingCity = $request->billingCity;
        $data->billingPostcode = $request->billingPostcode;
        $data->billingCountry = $request->billingCountry;
        $data->shippingAdd1 = $request->shippingAdd1;
        $data->shippingAdd2 = $request->shippingAdd2;
        $data->shippingCity = $request->shippingCity;
        $data->shippingPostcode = $request->shippingPostcode;
        $data->shippingCountry = $request->shippingCountry;
        $data->status = $request->status;
        $data->paymentStatus = $request->paymentStatus;

        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = tblSaleBrief::findOrFail($id);
       $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }
    public function filterOrder($searchText){
        return response()->json(tblSaleBrief::where('firstName','like',"%{$searchText}%")
        ->get(),200);
    } 
    public function getOrderByCustID($custId){
        $data = DB::table('tbl_sale_briefs') 
        ->where('custId', $custId)  
        ->get();  

        return response()->json(['status'=> true,
        'data'=>$data]);
    }
    public function getProductSaleBrief(Request $request, $saleBriefID)
{
    $saleDetails = tblSaleDetail::where('saleBriefId', $saleBriefID)
        ->with('Product')
        ->get();

    return response()->json([
        'saleDetails' => $saleDetails,
    ]);
}

}