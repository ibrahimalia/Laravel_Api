<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$guard= null)
    {
        $user=null;
        if ($guard) {
            auth()->shouldUse($guard);
            $user= JWTAuth::parseToken()->authenticate();
            if (!$user->email_verified_at) {
                return response()->json(['status'=>401,'massege'=>'need to verify email'],401);
            }
        }else{
            return response()->json(['massege'=>'enter guard with middleware'],500);
        }

        return $next($request);
    }
}
