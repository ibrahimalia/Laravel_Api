<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Mail\OrderStarted;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    use GeneralTraits;

    public function start(Request $request){

        Mail::to("abrahimalia27@gmail.com")->send(new OrderStarted("Ibrahim"));
        return $this->returnSuccess(200,"start");

    }
    public function shipped(){
        Mail::to("abrahimalia27@gmail.com")->send(new OrderShipped("Ibrahim"));
        return $this->returnSuccess(200,"shipped");

    }
}
