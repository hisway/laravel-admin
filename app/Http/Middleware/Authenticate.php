<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest($guard.'/login');
            }
        }
        if(Auth::guard($guard)->user()->is_super){
            return $next($request);
        }
        if($request->is('admin/*')){
            $permission = Route::currentRouteName();
            if(!Auth::guard($guard)->user()->can($permission)) {
                if($request->ajax() || $request->wantsJson()) {
                    return response('Permission denied.', 403);
                } else {
                    abort(403);
                }
            }
        }

        return $next($request);
    }
}
