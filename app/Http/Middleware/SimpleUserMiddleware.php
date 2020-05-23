<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SimpleUserMiddleware
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
        if(auth::user()->emp_type == 3 || auth::user()->emp_type == 2 || auth::user()->emp_type == 1){
            return $next($request);
          }
            return redirect('/admin/unauthorized')->with('fail','You have not simple-user access');
    }
}
