<?php

namespace App\Http\Middleware;

use Closure;

class checkRole
{
    /*
     * Check if user has the correct permissions to enter the given route
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() === null) {
            return abort(401);
        }

        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || ! $roles) {
            return $next($request);
        }

        return abort(401);
    }
}
