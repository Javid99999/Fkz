<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{

    use HasTranslations;
    

    public $translatable = ['name'];

    protected $fillable = ['name', 'slug', 'parent_id'];



    protected $casts = [
        'name' => 'array',
    ];


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(){

        return $this->hasMany(Category::class, 'parent_id');

    }



    public function properties()
    {
        return $this->belongsToMany(Property::class, 'category_properties');
    }


















    protected static function booted()
    {
        static::saving(function ($category) {
            if (!empty($category->name['en'])) {
                $category->slug = Str::slug($category->name['en']);
            }
        });
    }








    // English
    public function getNameEnAttribute(): string
    {
        return $this->getTranslation('name', 'en');
    }

    // Turkish
    public function getNameTrAttribute()
    {
        return $this->getTranslation('name', 'tr');
    }


    // Azerbaijani
    public function getNameAzAttribute()
    {
        return $this->getTranslation('name', 'az');
    }

    // Russian
    public function getNameRuAttribute()
    {
        return $this->getTranslation('name', 'ru');
    }
    

    // Chine
    public function getNameChAttribute()
    {
        return $this->getTranslation('name', 'zhcn');
    }

}
