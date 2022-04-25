<?php

namespace App\Core;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends UserType{

    //
    public  function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth("api")->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

    }
    //
    public function register(Request $request){

        $user = ModelsUser::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)

        ]);
        $login=$this->login();
        return $login;


    }

}
