<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
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
       
            // check auth user role (I don't know how you can implement this for yourself, this is just for me)
            If(Auth::check() && Auth::user()->isSuperAdmin()) {
                return $next($request);
              } else {
                abort(403, 'Unauthorized action.');
              }
              
       
    }
}
