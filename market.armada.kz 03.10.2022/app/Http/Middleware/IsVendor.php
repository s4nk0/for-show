<?php

namespace App\Http\Middleware;

use App\Models\UserRole;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsVendor
{
    public function handle($request, Closure $next)
    {
        if(Auth::user() !== null and Auth::user()->role_id != UserRole::USER)
        {
            return $next($request);
        }
        return  back()->withInput();
    }
}
