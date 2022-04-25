<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTraits;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class CheckToken
{
    use GeneralTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$guard=null)
    {
        $user= null;
        try {
         $user = $this->checkToken($request, $guard);

        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return $this->returnError("401","Invalid_Token");
            }else if($e instanceof TokenExpiredException){
                return $this->returnError("401","Expired_Token");
            }else{
                return $this->returnError("401","NotFound_Token");

            }
        } catch (\Throwable $th) {
            if ($th instanceof TokenInvalidException) {
                return $this->returnError("401","Invalid_Token");
            }else if($th instanceof TokenExpiredException){
                return $this->returnError("401","Expired_Token");
            }else{
                return $this->returnError("401","NotFound_Token");

            }

        }catch(TokenExpiredException $e){
            return $this->returnError("401","sddsd");

        }
        catch(JWTException $e){
            return $this->returnError("401","sddsdsddfdfbbbbsd");

        }

        if (!$user) {

            return $this->returnError("401","UnAuthorized");
        }
        return $next($request);
    }
    //
    public function checkToken(Request $request , string $guard){
        $user=null;
        if ($guard) {
            auth()->shouldUse($guard);
            $token= $request->header('auth-token');
            $request->headers->set('auth-token',(string)$token,true);
            $request->headers->set('Authorization','Bearer '.$token,true);
            $user= JWTAuth::parseToken()->authenticate();
        }

        return $user;
    }
}
