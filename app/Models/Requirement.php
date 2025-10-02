<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Requirement extends Model
{

    use HasTranslations;
    
    protected $fillable = ['name','description'];


    protected $translatable = ['description'];


    protected $casts = [
        'description' => 'array'
    ];


    // Product.php
    public function getDescriptionTrAttribute()
    {
        return $this->getTranslation('description', 'tr', false) 
            ?? $this->description; // fallback otomatik alır
    }



}
