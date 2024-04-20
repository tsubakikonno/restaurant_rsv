<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$guards)
{
    if (count($guards) > 0) {
        if ($guards[0] === 'manager' && !Auth::guard('manager')->check()) {
            return redirect('/managers/login');
        } elseif ($guards[0] === 'web' && !Auth::guard()->check()) {
            return redirect('/login');
        }
    }

    return $next($request);
}

}
