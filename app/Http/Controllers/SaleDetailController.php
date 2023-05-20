<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\tblSaleDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_sale_details')   
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
        $data = new tblSaleDetail();
        $data->itemId = $request->itemId;
        $data->SQty = $request ->SQty;
        $data->freeQty = 0;
        $data->unitPrice = $request->unitPrice;
        $data->totalAmount = $request->totalAmount;
        $data->selling = $request->selling;
        $data->cost = 0;
        $data->lineDis = 0;
        $data->lineDisAmount = 0;
        $data->lineVatAmount = 0;
        $data->isReturn = 'No';
        $data->costOfSale = 0;
        $data->saleBriefId = $request->saleBriefId;
        $data->serialNo = '';
        $data->expiryDate =  Carbon::now()->toDateTimeString();
        $data->batchNo = '';  
        $data->save(); 
        return response()->json(['status' => true,
                                'message' => "Data Created Successfully",'data'=>$data],201); 
        //

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
        $data = tblSaleDetail::findOrFail($id);
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
        $data =  tblSaleDetail::find($id);
        $data->itemId = $request->itemId;
        $data->SQty = $request ->SQty;
        $data->freeQty =$request->freeQty;
        $data->unitPrice = $request->unitPrice;
        $data->totalAmount = $request->totalAmount;
        $data->selling = $request->selling;
        $data->cost =$request->cost;
        $data->lineDis =$request->lineDis;
        $data->lineDisAmount =$request->lineDisAmount;
        $data->lineVatAmount = $request->lineVatAmount;
        $data->isReturn = $request->isReturn;
        $data->costOfSale = $request->costOfSale;
        $data->saleBriefId = $request->saleBriefId;
        $data->serialNo = $request->serialNo;
        $data->expiryDate =  $request->expiryDate;
        $data->batchNo = $request->batchNo;  $data->save();  
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
        $data = tblSaleDetail::findOrFail($id);
        $data->delete();
 
        return response()->json(['status' => true,
        'message' => "Data Deleted Successfully",'data'=>$data],204);         //
        //
    }
    public function getPopularProduct() {
        $popular = DB::table('tbl_sale_details')
                    ->join('tbl_products', 'tbl_sale_details.itemId', '=', 'tbl_products.custId')
                    ->select('tbl_products.*', DB::raw('COUNT(tbl_sale_details.itemId) AS totalSales'), DB::raw('MAX(tbl_products.created_at) AS maxCreatedAt'))
                    ->groupBy('tbl_products.custId', 'tbl_products.code', 'tbl_products.nameOf', 'tbl_products.imgPath', 'tbl_products.isActive', 'tbl_products.price', 'tbl_products.mainCategory_id', 'tbl_products.subCategory_id', 'tbl_products.scale_id', 'tbl_products.brand_id', 'tbl_products.sku', 'tbl_products.discountRate', 'tbl_products.discountAmount', 'tbl_products.vatRate', 'tbl_products.vatAmount','tbl_products.qty','tbl_products.isNew','tbl_products.created_at','tbl_products.updated_at','tbl_products.description')
                    ->orderByDesc('totalSales')
                    ->take(40)
                    ->get();
    
        return response()->json(['status' => true, 'message' => "Data Retrieved Successfully", 'data' => $popular], 200);
    }
    
}
