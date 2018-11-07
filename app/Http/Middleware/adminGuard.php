<?php

namespace App\Http\Middleware;

use Closure;

class adminGuard
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
        if (!auth('admin')->check()){
            return redirect('login');
        } elseif (auth('admin')->user()->status != 1) {
            return redirect('logout');
        }
        return $next($request);
    }
}
