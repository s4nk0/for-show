<?php
namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ProductsRepository{
    public function search(string $query = ''): Collection;
}
