<?php

namespace App\Core;

use App\Traits\AuthTraits;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class UserType {

    use GeneralTraits,AuthTraits;

    abstract function login();
    //
    abstract function register(Request $request);
    //
    public static function logout(Request $request){
        //first way
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
        //secound way
        // $token = $request->header('auth-token');
        // if (! $token) {
        //  return self::returnError('500','something is wrong');
        // }
        // JWTAuth::setToken($token)->invalidate();
        //  return self::returnSuccess("200","logut success");
    }
    //
    public static function sendEmail(Request $request){

        if (! self::validateEmail($request->email,$request->header('type'))) {
            return  self::returnError(400,"Not Found Email in Our Database");
        }

        self::send($request->email);
        return  self::returnSuccess(200,"success send Email");

    }

    public static function verifyEmail(){

        $email=Auth::user()->email;
        self::send($email);
        return  self::returnSuccess(200,"success send Email");

    }
    //

    public static function confirmVerifyEmail(Request $request){
        $email=Auth::user()->email;
        if (! self::validateEmailAndToken($email,$request->token)) {

            return  self::returnError("something error ... email or token not correct",500);
      }
      self::saveConfirmVerifyEmail($email,$request->header('type'));
       return self::returnSuccess("success verify email",200);
    }
    //

    public static function resetPassword(Request $request){

        if (! self::validateEmailAndToken($request->email,$request->token)) {

            return  self::returnError("something error ... email or token not correct",500);
      }
      self::saveNewPassword($request->email,$request->password,$request->header('type'));
       return self::returnSuccess("success update new password",200);
    }

    public function changePassword(Request $request){
        $email = Auth::user()->email;
        $this->saveNewPassword($email,$request->password,$request->header('type'));
        return $this->returnSuccess(200,"success update password");
    }
    //
    public function changeInformation(Request $request){
        $user = Auth::user();
        $this->changeInformationPerson($user,$request,$request->header('type'));
        return $this->returnSuccess(200,"success update Inforamtion");

    }



}

