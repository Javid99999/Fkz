<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Facility extends Model implements HasMedia
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
        $this->addMediaCollection('facility')
            ->useDisk('public');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('faci')
            ->width(652)
            ->height(320)
            ->sharpen(10)
            ->quality(90)
            ->performOnCollections('facility');
    }

    /**
     * Tek resim için URL döndürür.
     * Varsayılan olarak 'certification' collection ve 'certi' conversion kullanır.
     */
    public function mediaUrls(string $collectionName = 'facility', ?string $conversion = 'faci'): ?string
    {
        $first = $this->getMedia($collectionName)->first();
        return $first ? $first->getUrl($conversion) : null;
    }


}
