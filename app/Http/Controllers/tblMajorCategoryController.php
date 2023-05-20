<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tblMajorCategory;
use Illuminate\Support\Str;



class tblMajorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_major_categories')   
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
        $data = new tblMajorCategory;
        $data->code = Str::uuid()->toString();
        $data->nameOf = $request ->nameOf;
        $data->icon = $request ->icon;

        $data->imgPath =$request ->imgPath; 
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
        $data = tblMajorCategory::findOrFail($id);
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
        $data =  tblMajorCategory ::find($id);
        $data->nameOf = $request ->nameOf;
        $data->icon = $request ->icon;

        $data->imgPath = $request ->imgPath;
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
        $data = tblMajorCategory::findOrFail($id);
       $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }
    public function mainCategoryImg(Request $request) {
        if ($request->hasFile('imgPath'))
        {
            $file      = $request->file('imgPath');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            // $picture   = date('His').'-'.$filename;
            $picture =  $request['code'];
            //move image to public/img folder
            $file->move(public_path('img/mainCategory'), $picture);
            return response()->json(["message" => "Image Uploaded Succesfully"]);
        }
        else
        {
            return response()->json(["message" => "Select image first."]);
        }
      }
      public function getTopEight(){
        $data = DB::table('tbl_major_categories')->orderBy('nameOf', 'desc')->take(8)->get();
        return response()->json($data, 200);

      }
      public function selectMainCate()
      {
          return response()->json(DB::table('tbl_major_categories')
          ->select('tbl_major_categories.custId as id','tbl_major_categories.nameOf as description')
          ->orderByDesc('tbl_major_categories.custId')
          ->get(),200);
      }
    public function filterMainCategory($searchText){
        return response()->json(tblMajorCategory::where('nameOf','like',"%{$searchText}%")
        ->get(),200);
    }
}