<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        /*$user = $request->user();
        if ($user && $user->role === "admin") {
            return $next($request);
        }
        return redirect()->route('login.api');*/

        return $next($request);
    }
}
