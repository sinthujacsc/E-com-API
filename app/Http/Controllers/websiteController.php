<?php

namespace App\Http\Controllers;

use App\Models\tblProduct;
use App\Models\tblProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class websiteController extends Controller
{
    public function getSubCategoryById($id)
    {
        return response()->json(DB::table('tbl_products')
        ->join('tbl_sub_categories','tbl_sub_categories.custId','=','tbl_products.subCategory_id')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->select('tbl_sub_categories.custId','tbl_sub_categories.nameOf',DB::raw("COUNT(tbl_sub_categories.custId) as count"))
        ->where('tbl_major_categories.code',$id)
        ->groupBy('tbl_sub_categories.custId','tbl_sub_categories.nameOf')
        ->get(), 200);
    }
    public function getBrandById($id)
    {
        return response()->json(DB::table('tbl_products')
        ->join('tbl_brands','tbl_brands.custId','=','tbl_products.brand_id')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->select('tbl_brands.custId','tbl_brands.nameOf',DB::raw("COUNT(tbl_brands.custId) as count"))
        ->where('tbl_major_categories.code',$id)
        ->groupBy('tbl_brands.custId','tbl_brands.nameOf')
        ->get(), 200);
        
    }
    public function getPriceRange($id)
    {
        return response()->json(DB::table('tbl_products')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->select(DB::raw("max(tbl_products.price) as maxPrice"),DB::raw("min(tbl_products.price) as minPrice"))
        ->where('tbl_major_categories.code',$id)
        ->get(), 200);
    }
    public function getProductsByCategory($id)
    {
        return response()->json(DB::table('tbl_products')
        ->join('tbl_sub_categories','tbl_sub_categories.custId','=','tbl_products.subCategory_id')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->select('tbl_products.*','tbl_sub_categories.nameOf as subCategoryName')
        ->where('tbl_major_categories.code',$id)
        ->get(), 200);
    }
    public function getProductImageByCode($code)
    {        
        $data = tblProduct::with('tbl_product_images')
        ->whereHas('tbl_major_categories', function ($query) use($code) {
            $query->where('tbl_major_categories.code',$code);
        })
        ->pluck('custId');   
        $data1 = tblProduct::with('tbl_product_images')
        ->where('mainCategory_id',$data)
        ->get();
        return response()->json(['status'=> true,'data'=>$data1]);        
    }
    public function getProductBySubCategory(Request $request)
    {
        return response()->json(DB::table('tbl_products')
        ->join('tbl_brands','tbl_brands.custId','=','tbl_products.brand_id')
        ->join('tbl_sub_categories','tbl_sub_categories.custId','=','tbl_products.subCategory_id')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->select('tbl_products.*')
        ->where('tbl_major_categories.code',$request->code)
        ->whereBetween('tbl_products.price',[$request->low,$request->high])
        ->whereIn('tbl_sub_categories.custId',explode(',',$request->subCategory_id))
        ->get(), 200);
    }  
    public function getProductBySubCategoryBrand(Request $request)
    {
        return response()->json(DB::table('tbl_products')
        ->join('tbl_brands','tbl_brands.custId','=','tbl_products.brand_id')
        ->join('tbl_sub_categories','tbl_sub_categories.custId','=','tbl_products.subCategory_id')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->select('tbl_products.*')
        ->where('tbl_major_categories.code',$request->code)
        ->whereBetween('tbl_products.price',[$request->low,$request->high])
        ->whereIn('tbl_sub_categories.custId',explode(',',$request->subCategory_id))
        ->whereIn('tbl_brands.custId',explode(',',$request->brand_id))
        ->get(), 200);
    }  
    public function getProductByBrand(Request $request)
    {
        return response()->json(DB::table('tbl_products')
        ->join('tbl_brands','tbl_brands.custId','=','tbl_products.brand_id')
        ->join('tbl_sub_categories','tbl_sub_categories.custId','=','tbl_products.subCategory_id')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->select('tbl_products.*')
        ->where('tbl_major_categories.code',$request->code)
        ->whereBetween('tbl_products.price',[$request->low,$request->high])
        ->whereIn('tbl_brands.custId',explode(',',$request->brand_id))
        ->get(), 200);
    }  

    public function getProductByPrice(Request $request)
    {
        return response()->json(DB::table('tbl_products')
        ->join('tbl_major_categories','tbl_major_categories.custId','=','tbl_products.mainCategory_id')
        ->select('tbl_products.*')
        ->where('tbl_major_categories.code',$request->code)
        ->whereBetween('tbl_products.price',[$request->low,$request->high])
        ->get(), 200); 
    }
    
    public function getProductByCode($code){
        $data1 = tblProduct::with('tbl_product_images')
        ->where('code',$code)
        ->get();
        return response()->json(['status'=> true,'data'=>$data1]);
        // return response()->json(DB::table('tbl_products')
        // ->select('tbl_products.*')
        // ->where('tbl_products.code',$code)
        // ->get(), 200); 
    }
    //
}
