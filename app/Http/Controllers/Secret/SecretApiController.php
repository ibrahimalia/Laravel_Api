<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Flight;
use App\Models\User;
use App\Traits\GeneralTraits;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class SecretApiController extends Controller
{
    use GeneralTraits;
   /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }
       public function indexUser(){
           
           return Auth::user();
        }
        public function indexAdmin(){
           return Auth::user();
       }

}
