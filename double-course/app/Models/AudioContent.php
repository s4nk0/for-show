<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AudioContent extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'audio_contents';

    protected $fillable = [
        'subcategory_id',
        'path',
        'title',
        'description'
    ];

    protected $appends = [
        'length'
    ];

    protected $with = [
        'subcategory'
    ];

    public function getLengthAttribute(){
        $audio = new \wapmorgan\Mp3Info\Mp3Info($this->path, true);
        return intval(date("i", mktime(0, 0, intval($audio->duration))));
    }

    public function subcategory(){
        return $this->hasOne(Subcategory::class,'id','subcategory_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function affirmation_texts(){
        return $this->hasMany(AffirmationText::class,'content_id','id');
    }
}
