<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginMiddleware
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
        if(Auth::check() && Auth::user()->permission_id !=4){
            return redirect()->route('admin.chart.list');
        } else {
            Auth::logout();
            return $next($request);
        }
        
    }
}
