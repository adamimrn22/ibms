<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->roles->pluck('name')[0] === 'Super Admin'){
                    return redirect()->intended('/superadmin/dashboard');
                 }else if(Auth::user()->roles->pluck('name')[0] === 'Admin') {
                   return redirect()->intended('/admin/dashboard');
                 }else if(Auth::user()->roles->pluck('name')[0] === 'User') {
                    return redirect()->intended('/user');
                 }else {
                     abort(response('Unauthorized', 401));
                 }
            }
        }

        return $next($request);
    }
}
