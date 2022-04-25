<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Schema\Grammars\ChangeColumn;
use Illuminate\Http\Request;

class CheckPassword
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $password = "pAhmliTsJ7dNpHEUyd9jWt1lkSROtx5";
        if ($request->input("api_password") !==$password) {
            return response()->json(["msg" => "Unauthorized"]);
        }
        return $next($request);
    }
}
