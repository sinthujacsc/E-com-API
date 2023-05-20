<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function index()
    {
        $data = DB::table('users')   
        ->get(); 
    
           return response()->json(['status'=> true,
                                    'data'=>$data]);
        //
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return response()->json($data, 200);
        //
    }

    public function update(Request $request, $id)
    {
        $data =  User::find($id);
        $data->name = $request ->name;
        $data->email = $request ->email;
        $data->imgPath = $request ->imgPath;
        
        $data->save();  
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$data],201); 
        //
    }
    public function UserImg(Request $request) {
        if ($request->hasFile('imgPath'))
        {
            $file      = $request->file('imgPath');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            // $picture   = date('His').'-'.$filename;
            $picture =  $request['code'];
            //move image to public/img folder
            $file->move(public_path('img/user'), $picture);
            return response()->json(["message" => "Image Uploaded Succesfully"]);
        }
        else
        {
            return response()->json(["message" => "Select image first."]);
        }
      }

      public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

       return response()->json(['status' => true,
       'message' => "Data Deleted Successfully",'data'=>$data],204);     
        //
    }
    //
    public function SendForgotPasswordMail($email)
    {
        $data = DB::table("users")
        ->where('email',$email)
        ->get();
         //return $data;
         if (User::where('email', '=', ($email))->exists()) {
            if (App::environment('production', 'local')) {
                        Mail::to($email)->send(new \App\Mail\ForgotPassword($data[0]));
            }
            return response()->json(['message'=> "Reset password email successfully sent to your email account"],200);
          }
          else{
            return response()->json(['message'=> "The email does not exist"],200);

          }
    }
   
    public function resetPassword(Request $request) {
        // find email
        $userData = User::where('code',$request->code)->first();
        // update password
        // return $userData;
        $data =  User::find($userData->id);
        $data->password = Hash::make($request->password);
        $data->save();
        // $userData->update([
        //   'password'=>Hash::make($request->password)
        // ]);
        if (App::environment('production', 'local')) {
            Mail::to($userData->email)->send(new \App\Mail\PasswordResetSuccess($userData));
        }
        // remove verification data from db
        //$this->updatePasswordRow($request)->delete();
        // reset password response
        return response()->json(['status' => true,
        'message' => "Data Updated Successfully",'data'=>$userData],201); 
    } 
    public function filterUser($searchText){
        return response()->json(User::where('name','like',"%{$searchText}%")
        ->get(),200);
    }
}