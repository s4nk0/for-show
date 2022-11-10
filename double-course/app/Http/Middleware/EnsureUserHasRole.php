<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserHasRole
{

    public function handle($request, Closure $next, ... $roles)
    {
        if (! $request->user()->hasRoles($roles)) {
            abort(403, 'Access is denied');
        }
        return $next($request);
    }

}
