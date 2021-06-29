<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Managerlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   
	
	public function handle($request, Closure $next, $guard = null)
{


    if (Auth::guard('manager')->check()) {
	       return $next($request); 	
           
    }else{
		return $next($request); 	//return redirect('/adminlogin');
	}

   
}
}
