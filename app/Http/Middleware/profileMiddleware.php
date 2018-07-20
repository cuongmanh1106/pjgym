<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class profileMiddleware
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
        if(Auth::check() && Auth::user()->permission_id == 4) {
            return $next($request);    
        } else {
            $request->session()->flash('alert-warning','You dont have permission to do that action!!!');
            return redirect()->route('home');
        }
        
    }
}
