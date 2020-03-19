<?php

namespace App\Http\Middleware;

use Closure;

class SpfAuth
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
        if (!session('store')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
