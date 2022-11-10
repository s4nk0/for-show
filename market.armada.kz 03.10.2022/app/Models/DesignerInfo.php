<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignerInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'description','years','user_id'
    ];

    public function designerStyles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(DesignerStyle::class);
    }
}
