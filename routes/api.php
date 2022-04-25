<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Secret\SecretApiController;
use App\Http\Controllers\Services\DesignController;
use App\Http\Controllers\Upload\UploadContoller;
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

/*     api/auth/user      */

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth/user'

], function ($router) {
    //need type in header user or admin
    Route::post('login',[AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('send_email', [AuthController::class,'sendEmail']);
    Route::post('reset_password', [AuthController::class,'resetPassword']);


});

/*     api/user/      */
Route::get('testRepo', [DesignController::class,'index']);

Route::group([


    'prefix' => 'user',
    'middleware' => ['api','auth:api'], // use 'verify:api' middleware to verfiy email for user

], function ($router) {

    Route::get('testuser',[SecretApiController::class,'indexUser'] );

    //

    Route::post('logout', [AuthController::class,'logout']);
    Route::post('verify_email', [AuthController::class,'verifyEmail']);
    //need type in header user or admin and code in email
    Route::post('confirm_verify_email', [AuthController::class,'confirmVerifyEmail']);
    Route::put('change_password', [AuthController::class,'changePassword']);
    Route::put('change_info', [AuthController::class,'changeInformation']);

    //
    Route::post('designs', [UploadContoller::class,'upload']);



});

