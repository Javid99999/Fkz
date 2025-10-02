<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Experrtise extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;



    protected $translatable = [
        'name',
        'description',
        'about',
    ];

    protected $fillable = [
        'name',
        'description',
        'about',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'about' => 'array'
    ];



    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('expertise')
            ->useDisk('public');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('exper')
            ->width(652)
            ->height(320)
            ->sharpen(10)
            ->quality(90)
            ->performOnCollections('expertise');
    }

    /**
     * Tek resim için URL döndürür.
     * Varsayılan olarak 'certification' collection ve 'certi' conversion kullanır.
     */
    public function mediaUrls(string $collectionName = 'expertise', ?string $conversion = 'exper'): ?string
    {
        $first = $this->getMedia($collectionName)->first();
        return $first ? $first->getUrl($conversion) : null;
    }
}
