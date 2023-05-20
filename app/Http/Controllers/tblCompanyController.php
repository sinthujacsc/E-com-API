<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tblCompany;
use Illuminate\Support\Str;

class tblCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_companies')   
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
        $data = new tblCompany;
        $data->code = Str::uuid()->toString();
        $data->nameOf = $request ->nameOf;
        $data->logo =$request->logo;
        $data->add1 =$request->add1;
        $data->add2 =$request->add2;
        $data->city =$request->city;
        $data->state =$request->state;
        $data->zipcode =$request->zipcode;
        $data->message =$request->message;
        $data->tel1 =$request->tel1;
        $data->tel2 =$request->tel2;
        $data->tel3 =$request->tel3;
        $data->email =$request->email;
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
        $data = tblCompany::findOrFail($id);
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
        $data =  tblCompany ::find($id);
        $data->nameOf = $request ->nameOf;
        $data->logo =$request->logo;
        $data->add1 =$request->add1;
        $data->add2 =$request->add2;
        $data->city =$request->city;
        $data->state =$request->state;
        $data->zipcode =$request->zipcode;
        $data->message =$request->message;
        $data->tel1 =$request->tel1;
        $data->tel2 =$request->tel2;
        $data->tel3 =$request->tel3;
        $data->email =$request->email;
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
        $data = tblCompany::findOrFail($id);
       $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }
    public function LogoImg(Request $request) {
        if ($request->hasFile('logo'))
        {
            $file      = $request->file('logo');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            // $picture   = date('His').'-'.$filename;
            $picture =  $request['code'];
            //move image to public/img folder
            $file->move(public_path('img/company'), $picture);
            return response()->json(["message" => "Image Uploaded Succesfully"]);
        }
        else
        {
            return response()->json(["message" => "Select image first."]);
        }
      }
}