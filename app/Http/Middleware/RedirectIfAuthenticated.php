<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ((Auth::guard($guard)->check() && Auth::user()->user_type == 'admin') || Auth::guard($guard)->check() && Auth::user()->user_type == 'staff') {
            return redirect('/admin');
        } elseif (Auth::guard($guard)->check() && Auth::user()->user_type == 'customer') {
            return redirect('/dashboard');
        } elseif (Auth::guard($guard)->check() && Auth::user()->user_type == 'service_center') {
            return redirect('/serviceCenter');
        } elseif (Auth::guard($guard)->check() && Auth::user()->user_type == 'parent_dealer') {
            return redirect('/parentDealer');
        } elseif (Auth::guard($guard)->check() && Auth::user()->user_type == 'child_dealer') {
            return redirect('/childDealer');
        } else {
            return $next($request);
        }
    }
}
