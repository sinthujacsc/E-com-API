<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\tblMajorCategoryController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
// header('Access-Control-Allow-Credentials: true');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::get('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::get('/profile', [JWTController::class, 'profile']);    
});
//Major Category
Route::apiResource('/major-category', 'App\Http\Controllers\tblMajorCategoryController');
Route::post('/upload-maincategory', 'App\Http\Controllers\tblMajorCategoryController@mainCategoryImg');
Route::get('/get-top-category', 'App\Http\Controllers\tblMajorCategoryController@getTopEight');


//sub category
Route::apiResource('/sub-category', 'App\Http\Controllers\tblSubCategoryController');
Route::post('/upload-subcategory', 'App\Http\Controllers\tblSubCategoryController@subCategoryImg');

//scale
Route::apiResource('/scale', 'App\Http\Controllers\tblScaleController');

//product
Route::apiResource('/product', 'App\Http\Controllers\tblProductController');
Route::post('/upload-product', 'App\Http\Controllers\tblProductController@productImg');

//getproductbycode
Route::get('/product-by-code/{id}', 'App\Http\Controllers\tblProductController@getProductByCode');

//customer
Route::apiResource('/customer', 'App\Http\Controllers\tblCustomerController');
Route::post('/upload-customer', 'App\Http\Controllers\tblCustomerController@customerImg');
Route::patch('/update-userinfo/{id}', 'App\Http\Controllers\tblCustomerController@updateUserInfo');
Route::patch('/update-contactinfo/{id}', 'App\Http\Controllers\tblCustomerController@updateContactInfo');
Route::patch('/update-billinginfo/{id}', 'App\Http\Controllers\tblCustomerController@updateBillingInfo');
Route::patch('/update-shippinginfo/{id}', 'App\Http\Controllers\tblCustomerController@updateShippingInfo');
Route::patch('/update-profile/{id}', 'App\Http\Controllers\tblCustomerController@updateProfile');
Route::patch('/update-profile-cover/{id}', 'App\Http\Controllers\tblCustomerController@updateProfileCover');
Route::post('/upload-customer-cover', 'App\Http\Controllers\tblCustomerController@customerCoverImg');

//customer login
Route::post('/customer-login', 'App\Http\Controllers\tblCustomerController@emailLogin');
Route::get('/send-forgot-password-mail-customer/{id}', 'App\Http\Controllers\tblCustomerController@SendForgotPasswordMailCustomer');
Route::post('/reset-password-customer', 'App\Http\Controllers\tblCustomerController@resetPasswordCustomer');

//systoken customer
Route::apiResource('/systoken-customer', 'App\Http\Controllers\tblSysTokenCustomerController');
Route::post('/check-token-availability-customer', 'App\Http\Controllers\tblSysTokenCustomerController@removeDuplicateToken');
Route::post('/delete-system-token-customer', 'App\Http\Controllers\tblSysTokenCustomerController@deleteSystemToken');
Route::post('/validate-system-token-customer', 'App\Http\Controllers\tblSysTokenCustomerController@validateSystemToken');
Route::post('/token-delete-by-userid-customer', 'App\Http\Controllers\tblSysTokenCustomerController@tokenDeleteByUserId');


//user image
Route::post('/upload-user', 'App\Http\Controllers\UserController@userImg');
Route::apiResource('/user', 'App\Http\Controllers\UserController');
Route::get('/send-forgot-password-mail/{id}', 'App\Http\Controllers\UserController@SendForgotPasswordMail');
Route::post('/reset-password', 'App\Http\Controllers\UserController@resetPassword');

//systoken
Route::apiResource('/systoken', 'App\Http\Controllers\tblSysTokenController');
Route::post('/check-token-availability', 'App\Http\Controllers\tblSysTokenController@removeDuplicateToken');
Route::post('/delete-system-token', 'App\Http\Controllers\tblSysTokenController@deleteSystemToken');
Route::post('/validate-system-token', 'App\Http\Controllers\tblSysTokenController@validateSystemToken');
Route::post('/token-delete-by-userid', 'App\Http\Controllers\tblSysTokenController@tokenDeleteByUserId');

//activity log
Route::apiResource('/activity-log', 'App\Http\Controllers\ActivityLogController');

//customer enquiry
Route::apiResource('/customer-enquiry', 'App\Http\Controllers\tblCustomerEnquiryController');

//faq
Route::apiResource('/faq', 'App\Http\Controllers\tblFaqController');
Route::apiResource('/faq-category', 'App\Http\Controllers\tblFaqCategoryController');

//faq for front
Route::get('/faq-category-front', 'App\Http\Controllers\tblFaqCategoryController@indexFront');

//company
Route::apiResource('/company', 'App\Http\Controllers\tblCompanyController');
Route::post('/upload-logo', 'App\Http\Controllers\tblCompanyController@LogoImg');

//website
Route::get('/get-subcategory-by-id/{id}', 'App\Http\Controllers\websiteController@getSubCategoryById');
Route::get('/get-brand-by-id/{id}', 'App\Http\Controllers\websiteController@getBrandById');
Route::get('/get-price-range/{id}', 'App\Http\Controllers\websiteController@getPriceRange');
Route::get('/get-product-by-category/{id}', 'App\Http\Controllers\websiteController@getProductsByCategory');
Route::get('/get-product-image-by-code/{id}', 'App\Http\Controllers\websiteController@getProductImageByCode');
Route::post('/get-product-by-subcategory', 'App\Http\Controllers\websiteController@getProductBySubCategory');
Route::post('/get-product-by-subcategory-brand', 'App\Http\Controllers\websiteController@getProductBySubCategoryBrand');
Route::post('/get-product-by-brand', 'App\Http\Controllers\websiteController@getProductByBrand');
Route::post('/get-product-by-price', 'App\Http\Controllers\websiteController@getProductByPrice');
Route::get('/get-product-by-code/{id}', 'App\Http\Controllers\websiteController@getProductByCode');

//brand
Route::apiResource('/brand', 'App\Http\Controllers\tblBrandController');

//select
Route::get('/select-maincategory', 'App\Http\Controllers\tblMajorCategoryController@selectMainCate');
Route::get('/select-subcategory', 'App\Http\Controllers\tblSubCategoryController@selectSubCate');
Route::get('/select-scale', 'App\Http\Controllers\tblScaleController@selectScale');
Route::get('/select-brand', 'App\Http\Controllers\tblBrandController@selectBrand');

//search
Route::get('/filter-maincategory/{id}', 'App\Http\Controllers\tblMajorCategoryController@filterMainCategory');
Route::get('/filter-subcategory/{id}', 'App\Http\Controllers\tblSubCategoryController@filterSubCategory');
Route::get('/filter-scale/{id}', 'App\Http\Controllers\tblScaleController@filterScale');
Route::get('/filter-brand/{id}', 'App\Http\Controllers\tblBrandController@filterBrand');
Route::get('/filter-product/{id}', 'App\Http\Controllers\tblProductController@filterProduct');
Route::get('/filter-customer/{id}', 'App\Http\Controllers\tblCustomerController@filterCustomer');
Route::get('/filter-user/{id}', 'App\Http\Controllers\tblUserController@filterUser');
Route::get('/filter-activity/{id}', 'App\Http\Controllers\ActivityLogController@filterActivity');
Route::get('/filter-customer-enquiry/{id}', 'App\Http\Controllers\tblCustomerEnquiryController@filterCustomerEnquiry');
Route::get('/filter-faq/{id}', 'App\Http\Controllers\tblFaqController@filterFaq');
Route::get('/filter-faq-category/{id}', 'App\Http\Controllers\tblFaqCategoryController@filterFaqCategory');

//productImage
Route::apiResource('/product-image', 'App\Http\Controllers\tblProductImageController');
Route::post('/upload-product-color-image', 'App\Http\Controllers\tblProductImageController@productColorImage');
Route::get('/image-by-product/{id}', 'App\Http\Controllers\tblProductImageController@getImageByProductId');
Route::get('/delete-image/{id}', 'App\Http\Controllers\tblProductImageController@deleteImage');

//shipping type
Route::apiResource('/shipping-type', 'App\Http\Controllers\ShippingTypeController');

//saleBrief
Route::apiResource('/sale-brief', 'App\Http\Controllers\tblSaleBriefController');
Route::apiResource('/sale-detail', 'App\Http\Controllers\SaleDetailController');
Route::get('/get-order-by-cust/{id}', 'App\Http\Controllers\tblSaleBriefController@getOrderByCustID');
Route::get('get-products/{id}','App\Http\Controllers\tblSaleBriefController@getProductSaleBrief');
Route::get('get-popular', 'App\Http\Controllers\SaleDetailController@getPopularProduct');
Route::get('get-recent', 'App\Http\Controllers\tblProductController@getRecentProductsPerMainCategory');
