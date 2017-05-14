<?php

namespace ERP\Http\Middleware;

use Closure;

class ERPAuthMiddleware
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
        if(!session('user.account')){
            return redirect('/login');
            //return response(view('errors.503'));
        }
        return $next($request);
    }
}
