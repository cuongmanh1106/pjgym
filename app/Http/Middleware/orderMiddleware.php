<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class orderMiddleware
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
        if(Auth::check() && Auth::user()->permission_id==4){
            return $next($request);
        } else {
            $request->session()->flash('alert-warning','Please Login First!!!');
            return back();
        }
    }
}
