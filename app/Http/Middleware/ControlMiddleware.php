<?php

namespace App\Http\Middleware;

use Closure;

class ControlMiddleware
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
        if (!\Session::get('username'))
        {
            return redirect('/control/login');
        }
        return $next($request);
    }
}
