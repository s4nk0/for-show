<?php

namespace App\Http\Middleware;

use App\Http\Services\ProductService;
use Closure;
use Illuminate\Http\Request;

class IsProductInDiscountZone
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        if (!$this->service->isProductInDiscountZone($id)) {
            return $next($request);
        }
        return back()->with('error', 'Доступ запрещён');

    }
}
