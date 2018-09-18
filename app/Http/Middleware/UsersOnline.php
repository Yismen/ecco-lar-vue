<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class UsersOnline
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
        if (auth()->check()) {
            Cache::put('online-user-' . auth()->user()->id, true, 10);
        }
        return $next($request);
    }
}
