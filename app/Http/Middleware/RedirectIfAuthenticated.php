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
        if(!Auth::check()) {
            return $next($request);
        } else {
            if ($this->naoPossuiLojaSelecionada()) {
                return redirect('/select_store');
            } else {
                return $next($request);
            }
        }
    }

    public function naoPossuiLojaSelecionada()
    {
        if (Auth::user()->remember_token == null ||
            Auth::user()->last_remember_token == null || 
            Auth::user()->remember_token != Auth::user()->last_remember_token) {
            return true;
        }
        return false;
    }
}
