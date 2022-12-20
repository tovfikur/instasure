<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class IsChildDealer
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
        if (Auth::check() && (Auth::user()->user_type == 'child_dealer')) {
            return $next($request);
        }
        else{
            session(['link' => url()->current()]);
            //return redirect()->route('admin.login');
            abort(404);
        }
    }
}
