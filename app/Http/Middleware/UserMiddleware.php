<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) 
        {
            if(Auth::user()->profile==0)
            {
                return Redirect::to('/user/profile')->with('message','Please update your profile');
            }
             return $next($request);
        }

        return Redirect::to('/');

    }
}
