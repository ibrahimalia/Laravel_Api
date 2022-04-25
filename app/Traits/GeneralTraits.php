<?php
namespace App\Traits;

use Exception;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

trait GeneralTraits
{
 public function returnError($status,$msg){
    return response()->json([
        "status" => $status,
        "message" => $msg
    ]);
 }
 public function returnData($status,$value){
    return response()->json([
        "status" => $status,
        "message" => $this->successMessage,
        "data" => $value
    ]);
 }
 public function returnSuccess($status,$msg){
    return response()->json([
        "status" => $status,
        "message" => $msg,
    ]);
 }
 
}


