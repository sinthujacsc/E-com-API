<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblCustomer;
use App\Models\tblSysTokenCustomer;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class tblSysTokenCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_sys_token_customers')   
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
        $data = new tblSysTokenCustomer;
        $data->token_number = $request ->token_number;
        $data->user_id =$request ->user_id; 
        $data->browser = $request ->browser;
        $data->ip_address = $request ->ip_address;

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
        $data = tblSysTokenCustomer::findOrFail($id);
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
        $data =  tblSysTokenCustomer ::find($id);
        $data->token_number = $request ->token_number;
        $data->user_id =$request ->user_id; 
        $data->browser = $request ->browser;
        $data->ip_address = $request ->ip_address;

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
        $data = tblSysTokenCustomer::findOrFail($id);
        $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }

    public function removeDuplicateToken(Request $request)
    {
        $userData = tblSysTokenCustomer::where('user_id',$request->user_id)
        ->where('browser',$request->browser)
        ->first();


        if($userData)
        {
            DB::table('tbl_sys_token_customers')
            ->where(['user_id'=>$request->user_id, 'browser'=>$request->browser])
            ->delete();
        }
         
        $data = new tblSysTokenCustomer;
        $data->token_number = $request ->token_number;
        $data->user_id =$request ->user_id; 
        $data->browser = $request ->browser;
        $data->ip_address = $request ->ip_address;

        $data->save(); 

        $user = tblCustomer::where('code', $request->user_id)->first();
        $user->update([
            'lastVisit' => Carbon::now()->toDateTimeString(),
            'lastVisit_ip' => $request->ip_address
        ]);

        return response()->json(['status' => true,
                                'message' => "Data Created Successfully",'data'=>$userData],201); 
        //
    }

    public function deleteSystemToken(Request $request)
    {
        DB::table('tbl_sys_token_customers')
            ->where(['user_id'=>$request->user_id, 'browser'=>$request->browser])
            ->delete();
    }
    public function tokenDeleteByUserId(Request $request)
    {
        DB::table('tbl_sys_token_customers')
            ->where(['user_id'=>$request->user_id])
            ->delete();
    }

    public function validateSystemToken(Request $request)
    {
        $userData = tblSysTokenCustomer::where('user_id',$request->user_id)
        ->where('browser',$request->browser)
        ->first();

        if($userData)
        {
            return response()->json(['status'=> true,
            'data'=>$userData]);
        }
        else{
            return response()->json(['status'=> false,
            'data'=>$userData]);
        }
    }
   
   
}