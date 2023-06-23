<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if current logging in user is admin redirect to admin dashboard
        // else redirect to default user homepage
        
        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'super_admin') {
            return $next($request);
        }else {
            return redirect('/homepage');
        }
 
    }
}
