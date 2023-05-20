<?php

namespace App\Http\Controllers;
use App\Models\tblCustomerEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;


class tblCustomerEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_customer_enquiries')
        ->orderBy('created_at','desc')   
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
        $data = new tblCustomerEnquiry;
        $data->name = $request ->name;
        $data->email = $request ->email;
        $data->phone = $request ->phone;
        $data->message = $request ->message;
        $data->subject = $request ->subject;
        $data->isViewed = 'N';
        $data->save(); 
        if (App::environment('production', 'local')) {
            Mail::to('sinthu96vijaya@gmail.com')->send(new \App\Mail\Contact($data));
        }
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
        $data = tblCustomerEnquiry::findOrFail($id);
        

        $data =  tblCustomerEnquiry ::find($id);
        $data->isViewed = 'Y';
        $data->save();
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
        $data =  tblCustomerEnquiry ::find($id);
        $data->name = $request ->name;
        $data->email = $request ->email;
        $data->phone = $request ->phone;
        $data->message = $request ->message;
        $data->subject = $request ->subject;
        $data->isViewed = $request ->isViewed;
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
        $data = tblCustomerEnquiry::findOrFail($id);
       $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }
    public function filterCustomerEnquiry($searchText){
        return response()->json(tblCustomerEnquiry::where('name','like',"%{$searchText}%")
        ->get(),200);
    } 
   
}