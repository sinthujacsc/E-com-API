<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tblBrand;
use Illuminate\Support\Str;

class tblBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_brands')   
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
        $data = new tblBrand;
        $data->code = Str::uuid()->toString();
        $data->nameOf = $request ->nameOf;
        $data->isActive = $request ->isActive;
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
        $data = tblBrand::findOrFail($id);
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
        $data =  tblBrand ::find($id);
        $data->nameOf = $request ->nameOf;
        $data->isActive = $request ->isActive;
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
        $data = tblBrand::findOrFail($id);
       $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }
    public function selectBrand()
    {
        return response()->json(DB::table('tbl_brands')
        ->select('tbl_brands.custId as id','tbl_brands.nameOf as description')
        ->orderByDesc('tbl_brands.custId')
        ->get(),200);
    }
    public function filterBrand($searchText){
        return response()->json(tblBrand::where('nameOf','like',"%{$searchText}%")
        ->get(),200);
    }
   
}