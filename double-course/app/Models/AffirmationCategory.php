<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffirmationCategory extends Model
{
    use HasFactory;

    protected $table ='affirmation_categories';

    protected $fillable = [
      'title',
        'icon'
    ];

    public function affirmation_texts(){
        return $this->hasMany(AffirmationText::class);
    }
}
