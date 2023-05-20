<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\tblProduct;


class tblProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = tblProduct::with(['tbl_major_categories','tbl_sub_categories','tbl_scales'])
        // ->get();
        return response()->json(DB::table('tbl_products')
        ->select('tbl_products.*','tbl_sub_categories.nameOf as subCategory','tbl_major_categories.nameOf as mainCategory')
        ->join('tbl_sub_categories','tbl_sub_categories.custId','=','tbl_products.subCategory_id')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->get(),200);
    
        //    return response()->json(['status'=> true,
                                    // 'data'=>$data]);
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
        $data = new tblProduct;
        $data->code = Str::uuid()->toString();
        $data->nameOf = $request ->nameOf;
        $data->imgPath =$request ->imgPath; 
        $data->isActive = $request ->isActive;
        $data->price = $request ->price;
        $data->mainCategory_id = $request ->mainCategory_id;
        $data->subCategory_id = $request ->subCategory_id;
        $data->scale_id = $request ->scale_id;
        $data->brand_id = $request ->brand_id;
        $data->sku = $request ->sku; //stock keeping unit
        $data->discountRate = $request ->discountRate;
        $data->discountAmount = $request ->discountAmount;
        $data->vatRate = $request ->vatRate;
        $data->vatAmount = $request ->vatAmount;
        $data->description = $request ->description;
        $data->qty = 0;
        $data->isNew = $request ->isNew;

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
        $data = tblProduct::findOrFail($id);
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
        $data =  tblProduct ::find($id);
        $data->nameOf = $request ->nameOf;
        $data->imgPath = $request ->imgPath;
        $data->description = $request ->description;
        $data->isActive = $request ->isActive;
        $data->price = $request ->price;
        $data->mainCategory_id = $request ->mainCategory_id;
        $data->subCategory_id = $request ->subCategory_id;
        $data->scale_id = $request ->scale_id;
        $data->brand_id = $request ->brand_id;
        $data->sku = $request ->sku; //stock keeping unit
        $data->discountRate = $request ->discountRate;
        $data->discountAmount = $request ->discountAmount;
        $data->vatRate = $request ->vatRate;
        $data->vatAmount = $request ->vatAmount;
        $data->isNew = $request ->isNew;
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
        $data = tblProduct::findOrFail($id);
       $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);         //
    }

    public function productImg(Request $request) {
        if ($request->hasFile('imgPath'))
        {
            $file      = $request->file('imgPath');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            // $picture   = date('His').'-'.$filename;
            $picture =  $request['code'];
            //move image to public/img folder
            $file->move(public_path('img/product'), $picture);
            return response()->json(["message" => "Image Uploaded Succesfully"]);
        }
        else
        {
            return response()->json(["message" => "Select image first."]);
        }
    }
    public function getProductByCode($code)
    {        
        $data = tblProduct::with(['tbl_major_categories','tbl_sub_categories','tbl_scales'])
        ->where('code',$code)
        ->get();    
        return response()->json(['status'=> true,'data'=>$data]);        
    }
    public function filterProduct($searchText){
        return response()->json(DB::table('tbl_products')
        ->select('tbl_products.*','tbl_sub_categories.nameOf as subCategory','tbl_major_categories.nameOf as mainCategory')
        ->join('tbl_sub_categories','tbl_sub_categories.custId','=','tbl_products.subCategory_id')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->where('tbl_products.nameOf','like',"%{$searchText}%")
        ->orWhere('tbl_major_categories.nameOf','like',"%{$searchText}%")
        ->orWhere('tbl_sub_categories.nameOf','like',"%{$searchText}%")
        ->get(),200);
    }

   
    public function getRecentProductsPerMainCategory() {
        $query = "
            SELECT CONCAT(
                '{\"mainCategoryName\":\"', mc.nameOf, '\",\"products\":[',
                GROUP_CONCAT(
                    CONCAT(
                        '{\"productId\":', p.custId,
                        ',\"productName\":\"', p.nameOf,
                        '\",\"productPrice\":', p.price,
                        ',\"productDescription\":\"', p.description,
                        '\",\"productImage\":\"', p.imgpath,
                        '\",\"createdAt\":\"', p.created_at, '\"}'
                    )
                    SEPARATOR ','
                ),
                ']}'
            ) AS mainCategory
            FROM tbl_products AS p
            INNER JOIN tbl_major_categories AS mc ON p.mainCategory_id = mc.custId
            INNER JOIN (
                SELECT mainCategory_id, created_at
                FROM tbl_products AS p1
                WHERE (
                    SELECT COUNT(*)
                    FROM tbl_products AS p2
                    WHERE p1.mainCategory_id = p2.mainCategory_id AND p1.created_at < p2.created_at
                ) < 10
            ) AS subquery ON p.mainCategory_id = subquery.mainCategory_id AND p.created_at = subquery.created_at
            GROUP BY mc.nameOf
            ORDER BY mc.nameOf
        ";
    
        $result = DB::select($query);
        $mainCategories = [];
    
        foreach ($result as $row) {
            $mainCategories[] = json_decode($row->mainCategory, true);
        }
    
        return response()->json(['status' => true, 'message' => "Data Retrieved Successfully", 'data' => $mainCategories], 200);
    }
    
    
}