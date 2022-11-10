<?php

namespace App\Http\Middleware;

use App\Models\Seller;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsSeller
{
    public function handle($request, Closure $next)
    {
        $auth_seller = Seller::where('email',Auth::user()->email) -> first();
        if(Auth::user() !== null and Auth::user()->role_id != User::USER or $auth_seller != null)
        {
            return $next($request);
        }
        return back()->withInput();
    }
}
