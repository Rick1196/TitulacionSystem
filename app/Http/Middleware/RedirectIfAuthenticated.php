<?php

namespace App\Http\Middleware;

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
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->hasRole('admin')){
                return redirect('admin');
            }elseif(Auth::user()->hasRole('tesista')){
                return redirect('tesista');
            }elseif(Auth::user()->hasRole('titulacion')){
                return redirect('titulacion');
            }elseif(Auth::user()->hasRole('sinodal')){
                return redirect('sinodal');
            }
            
        }

        return $next($request);
    }
}
