<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class EleveMiddleware
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
        if (Auth::user()->role != 'eleve') {
            return redirect('login');
        }

        return $next($request);
    }
}
