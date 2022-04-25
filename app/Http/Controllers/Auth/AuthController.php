<?php

namespace App\Http\Controllers\Auth;

use App\Core\FactoryType;
use App\Core\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;


//For User
class AuthController extends Controller
{

    public function sendEmail(Request $request){

        return UserType::sendEmail($request);
    }

   //
    public function resetPassword(Request $request){

        return UserType::resetPassword($request);
    }


    public function login(AuthRequest $request)
    {
        $type = FactoryType::factory((string)$request->header('type'));
        return $type->login();

    }

    public function register(Request $request){

        $type = FactoryType::factory((string)$request->header('type'));
        return $type->register($request);


    }
     //

    public function logout(Request $request)
    {
        return UserType::logout($request);

    }
    //

    public function verifyEmail(){
        return UserType::verifyEmail();
    }
    //

    public function confirmVerifyEmail(Request $request){
       return UserType::confirmVerifyEmail($request);
    }

    public function changePassword(Request $request){

        $type = FactoryType::factory((string)$request->header('type'));
        return $type->changePassword($request);
    }
    //
    public function changeInformation(Request $request){

        $type = FactoryType::factory((string)$request->header('type'));
        return $type->changeInformation($request);
    }

}
