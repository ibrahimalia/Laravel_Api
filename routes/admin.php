<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Secret\SecretApiController;
use Illuminate\Support\Facades\Route;

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

/*     api/auth/admin/      */
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth/admin'

], function ($router) {

    //need type in header user or admin
    Route::post('login',[adminController::class,'login']);
    Route::post('register', [adminController::class,'register']);
    Route::post('send_email', [AuthController::class,'sendEmail']);
    Route::post('reset_password', [AuthController::class,'resetPassword']);

});
/*     api/admin/      */
Route::group([

    'prefix' => 'admin',
    'middleware' => ['api','auth:api-admin','verify:api-admin'],


], function ($router) {

    Route::get('testadmin',[SecretApiController::class,'indexAdmin'] );
    Route::post('logout', [adminController::class,'logout']);
    Route::post('verify_email', [adminController::class,'verifyEmail']);
    //need type in header user or admin and code in email
    Route::post('confirm_verify_email', [adminController::class,'confirmVerifyEmail']);
    Route::put('change_password', [adminController::class,'changePassword']);
    Route::put('change_info', [adminController::class,'changeInformation']);


});
