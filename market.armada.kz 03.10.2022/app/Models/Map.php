<?php

namespace App\Models;

use App\Traits\AddEdit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    use AddEdit;

    protected $table = 'new_maps';
    public $incrementing = false;
    protected $primaryKey = 'map_polygon_id';

    protected $fillable = [
        'store_id',
        'map_polygon_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault(['id'=>9999999,'title'=>'<span class="text-danger font-weight-bold">Нет данных!!!</span>']);
    }
}
