<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductsRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentRepository implements ProductsRepository {

    public function search(string $query = ''): Collection
    {
        return Product::query()
            ->where('origin', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }
}
