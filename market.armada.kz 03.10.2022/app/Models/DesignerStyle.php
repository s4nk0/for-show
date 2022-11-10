<?php

namespace App\Models;

use App\Traits\AddEdit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignerStyle extends Model
{
    use HasFactory;
    use AddEdit;

    protected $fillable = [
        'title','color'
    ];
    public function designerPoject()
    {
        return $this->hasMany(DesignerProject::class);
    }
}
