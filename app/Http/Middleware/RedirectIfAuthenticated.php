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
                switch (auth()->user()->role_id) {
                    case 1:
                        return redirect('/dashboard-admin');
                    case 2:
                        return redirect('/dashboard-kabeng');
                    case 3:
                        return redirect('/dashboard-departemen');
                    case 4:
                        return redirect('/dashboard-kemenpro');
                    case 5:
                        return redirect('/dashboard-pegawai');
                    case 6:
                        return redirect('/dashboard-user')->with('user', auth()->user());
                }
            }
        }

        return $next($request);
    }
}
