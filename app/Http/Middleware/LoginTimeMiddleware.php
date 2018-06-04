<?php

namespace App\Http\Middleware;

use Closure;

class LoginTimeMiddleware
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
        // is authenticated?
        // is logged in?
        // request has disposition, 
            // log out previous session
            // log in with the new disposition
        return $next($request);
    }
}
