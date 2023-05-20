<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tblCustomer;
use App\Models\tblSysToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class tblCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_customers')   
        ->get(); 
    
           return response()->json(['status'=> true,
                                    'data'=>$data]);
        //
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
        
        $data = new tblCustomer;
        $data->code = Str::uuid()->toString();
        $data->title = $request ->title;
        $data->firstName =$request ->firstName; 
        $data->lastName = $request ->lastName;
        $data->email = $request ->email;
        $data->password = sha1($request->password);
        $data->dateOfBirth = Carbon::now();
        $data->mobileNum = $request ->mobileNum;
        $data->billingAdd1 ='';
        $data->billingAdd2 ='';
        $data->billingCity ='';
        $data->billingPostcode = '';
        $data->billingCountry = '';
        $data->imagePath = '';
        $data->cusIP = '';
        $data->lastVisit = Carbon::now();
        $data->isActive = 'Y';
        $data->isBlocked = 'N';
        $data->shippingAdd1 = '';
        $data->shippingAdd2 = '';
        $data->shippingCity = '';
        $data->shippingPostcode = '';
        $data->shippingCountry = '';

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
        $data = tblCustomer::findOrFail($id);
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
        $data =  tblCustomer ::find($id);
        $data->title = $request ->title;
        $data->firstName =$request ->firstName; 
        $data->lastName = $request ->lastName;
        $data->email = $request ->email;
        $data->password = sha1($request->password);
        $data->dateOfBirth = $request ->dateOfBirth;
        $data->mobileNum = $request ->mobileNum;
        $data->billingAdd1 = $request ->billingAdd1;
        $data->billingAdd2 = $request ->billingAdd2;
        $data->billingCity = $request ->billingCity;
        $data->billingPostcode = $request ->billingPostcode;
        $data->billingCountry = $request ->billingCountry;
        $data->imagePath = $request ->imagePath;
        $data->coverImagePath = $request ->coverImagePath;
        $data->cusIP = $request ->cusIP;
        $data->lastVisit = $request ->lastVisit;
        $data->isActive = $request ->isActive;
        $data->isBlocked = $request ->isBlocked;
        $data->shippingAdd1 = $request ->shippingAdd1;
        $data->shippingAdd2 = $request ->shippingAdd2;
        $data->shippingCity = $request ->shippingCity;
        $data->shippingPostcode = $request ->shippingPostcode;
        $data->shippingCountry = $request ->shippingCountry;
        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        //
    }
    public function updateUserInfo(Request $request, $id){
        $data =  tblCustomer ::find($id);
        $data->title = $request ->title;
        $data->firstName =$request ->firstName; 
        $data->lastName = $request ->lastName;
        $data->email = $request ->email;
        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        //
    }
    public function updateContactInfo(Request $request, $id){
        $data =  tblCustomer ::find($id);
        $data->dateOfBirth = $request ->dateOfBirth;
        $data->mobileNum = $request ->mobileNum;
        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        //
    }
    public function updateBillingInfo(Request $request, $id){
        $data =  tblCustomer ::find($id);
        $data->billingAdd1 = $request ->billingAdd1;
        $data->billingAdd2 = $request ->billingAdd2;
        $data->billingCity = $request ->billingCity;
        $data->billingPostcode = $request ->billingPostcode;
        $data->billingCountry = $request ->billingCountry;
        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        //
    }
    public function updateShippingInfo(Request $request, $id){
        $data =  tblCustomer::find($id);
        $data->shippingAdd1 = $request->shippingAdd1;
        $data->shippingAdd2 = $request->shippingAdd2;
        $data->shippingCity = $request->shippingCity;
        $data->shippingPostcode = $request->shippingPostcode;
        $data->shippingCountry = $request->shippingCountry;
        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        //
    }
    public function updateProfile(Request $request, $id){
        $data =  tblCustomer ::find($id);
        $data->imagePath = $request->imagePath;
        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        
        // return $request;
    }
  
    public function updateProfileCover(Request $request, $id){
        $data =  tblCustomer ::find($id);
        $data->coverImagePath = $request->coverImagePath;
        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        
        // return $request;
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = tblCustomer::findOrFail($id);
        $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);     
        //
    }
    public function CustomerImg(Request $request) {
        if ($request->hasFile('imgPath'))
        {
            $file      = $request->file('imgPath');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            // $picture   = date('His').'-'.$filename;
            $picture =  $request['code'];
            //move image to public/img folder
            $file->move(public_path('img/customer'), $picture);
            return response()->json(["message" => "Image Uploaded Succesfully"]);
        }
        else
        {
            return response()->json(["message" => "Select image first."]);
        }
      }
      public function CustomerCoverImg(Request $request) {
        if ($request->hasFile('imgPath'))
        {
            $file      = $request->file('imgPath');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            // $picture   = date('His').'-'.$filename;
            $picture =  $request['code'];
            //move image to public/img folder
            $file->move(public_path('img/customerCover'), $picture);
            return response()->json(["message" => "Image Uploaded Succesfully"]);
        }
        else
        {
            return response()->json(["message" => "Select image first."]);
        }
      }

      public function emailLogin(Request $request)
      {
          // Get user record
          $user = tblCustomer::where('email', $request->get('email'))->where('password', sha1($request->get('password')))->first();
   
          if($user == null) {
            return response()->json(['status' => false,
            'message' => "User Not Found!",'data'=>$user],404); 
            }
            return response()->json([
                'access_token' => Str::uuid()->toString(),
                'token_type' => 'bearer',
                'user' => $user,
                'status'=>true
            ]);    
        }
      public function SendForgotPasswordMailCustomer($email)
        {
        $data = DB::table("tbl_customers")
        ->where('email',$email)
        ->get();
         //return $data;
         if(tblCustomer::where('email', '=', ($email))->exists()) {
            if (App::environment('production', 'local')) {
                        Mail::to($email)->send(new \App\Mail\ForgotPasswordFront($data[0]));
            }
            return response()->json(['message'=> "Reset password email successfully sent to your email account"],200);
          }
          else{
            return response()->json(['message'=> "The email does not exist"],200);

          }
    }
    public function resetPasswordCustomer(Request $request) {
        // find email
        $userData = tblCustomer::where('code',$request->code)->first();
        // update password
        // return $userData;
        $data =  tblCustomer::find($userData->custId);
        $data->password = sha1($request->password);
        $data->save();
        // $userData->update([
        //   'password'=>Hash::make($request->password)
        // ]);
        if (App::environment('production', 'local')) {
            Mail::to($userData->email)->send(new \App\Mail\PasswordResetSuccessFront($userData));
        }
        // remove verification data from db
        //$this->updatePasswordRow($request)->delete();
        // reset password response
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$userData],201); 
    } 
   public function filterCustomer($searchText){
        return response()->json(tblCustomer::where('firstName','like',"%{$searchText}%")
        ->get(),200);
    } 
}
