<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
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

        if (!Auth::guard($guard)->check()) {
            return redirect('/');
        }

        if (auth()->user()->user_type == 'admin') {
            return $next($request);
        }

        Auth::guard($guard)->logout();

        return redirect('/');
    }
}
