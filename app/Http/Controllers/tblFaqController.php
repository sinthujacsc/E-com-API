<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblFaq;
use Illuminate\Support\Facades\DB;



class tblFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_faqs')
            ->join('tbl_faq_categories', 'tbl_faqs.faqcategory_id', '=', 'tbl_faq_categories.custId')
            ->select('tbl_faqs.*', 'tbl_faq_categories.*')
            ->get();
        // $data = tblFaq::with(['tbl_faq_categories'])
        // ->get();
    
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
        $data = new tblFaq();
        $data->faqcategory_id = $request ->faqcategory_id;
        $data->question =$request ->question; 
        $data->answer = $request ->answer;
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
        $data = tblFaq::findOrFail($id);
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
        $data =  tblFaq ::find($id);
        $data->faqcategory_id = $request ->faqcategory_id;
        $data->question =$request ->question; 
        $data->answer = $request ->answer;
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
        $data = tblFaq::findOrFail($id);
        $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }
    public function filterFaq($searchText){
        $data = DB::table('tbl_faqs')
            ->join('tbl_faq_categories', 'tbl_faqs.faqcategory_id', '=', 'tbl_faq_categories.custId')
            ->select('tbl_faqs.*', 'tbl_faq_categories.*')
            ->where('question','like',"%{$searchText}%")
            ->get();
            
        // $data = tblFaq::with(['tbl_faq_categories'])
        // ->get();
    
           return response()->json(['status'=> true,
                                    'data'=>$data]);
        return response()->json(tblFaq::where('question','like',"%{$searchText}%")
        ->get(),200);
    } 
   
}