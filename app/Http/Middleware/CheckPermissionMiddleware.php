<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissionMiddleware
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
        //current user
        if(!check_user_permission($request)){
            abort(403,"Forbidden access!");
        }

        return $next($request);
    }
}
