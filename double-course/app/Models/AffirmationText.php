<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffirmationText extends Model
{
    use HasFactory;

    protected $table = 'affirmation_texts';

    protected $fillable =[
        'content_id',
        'text',
        'delay',
    ];
}
