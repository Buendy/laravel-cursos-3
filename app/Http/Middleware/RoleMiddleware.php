<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(auth()->user()->role_id !== (int)$role){
            return redirect('/');
            //abort(401, __('auth.role_middleware'));
        }
        return $next($request);
    }
}
