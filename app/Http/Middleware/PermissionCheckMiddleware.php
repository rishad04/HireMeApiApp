<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PermissionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,  $permission)
    {

        // dd(Auth::user()->role?->permissions);

        if (Auth::check() && in_array($permission, Auth::user()->role?->permissions)) {
            return $next($request);
        }
        // show user is not allowed code 403
        abort(403);
    }
}
