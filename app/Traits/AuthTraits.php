<?php
namespace App\Traits;

use App\Mail\OrderShipped;
use App\Models\Admin;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

trait AuthTraits
{
    public function validateEmail($email,$type){
        if ($type == 'admin') {
            return !! Admin::where("email",$email)->first();
        }
        return !! User::where("email",$email)->first();
    }
    //
    public static function send($email){
       $token=self::createToken($email);
       Mail::to($email)->send(new OrderShipped($token));
    }
    //
    public static function createToken($email){

      $oldToken=DB::table("password_resets")->where("email",$email)->first();
      if ($oldToken){
        return $oldToken->token;
    }
      $token= self::random(60);
      self::saveToken($email,$token);
      return $token;
    }
    //
     public static function saveToken($email,$token){

        DB::table("password_resets")->insert([
            "email"=>$email,
            "token"=>$token,
            "created_at"=>Carbon::now()
        ]);

     }
    //
    public static function random(int $number):string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $number; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
    //
    public static function validateEmailAndToken($email , $token){
        return !! DB::table('password_resets')->where([
          'email'=>$email,
          'token'=>$token
        ])->first();
    }
    public static function saveNewPassword($email, $newPassword, $type){
        if ($type == 'admin') {

            Admin::where('email',$email)->update(['password'=>Hash::make($newPassword)]);
        }else{

            User::where('email',$email)->update(['password'=>Hash::make($newPassword)]);
        }

        // DB::table('password_resets')->where('email',$email)->delete();
    }

    public static function saveConfirmVerifyEmail($email,$type){
        if ($type == 'admin') {

            Admin::where('email',$email)->update(['email_verified_at'=>Carbon::now()]);
        }else if ($type == 'user'){

            User::where('email',$email)->update(['email_verified_at'=>Carbon::now()]);
        }else{
            return response()->json(['massege'=>'type not correct... try admin or user only'],500);
        }

        DB::table('password_resets')->where('email',$email)->delete();

    }
    public function changeInformationPerson( $user, $request,$type){
         $email=!$request->email ? $user->email : $request->email;
         $name=!$request->name ? $user->name : $request->name ;
         if ($type == 'admin') {
            Admin::where('email',$user->email)->update([
                'name'=>$name,
                'email'=>$email
            ]);

         }else if($type == 'user'){

            User::where('email',$user->email)->update([
                'name'=>$name,
                'email'=>$email
            ]);
         }
    }
    public function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
        ]);
    }
}
