<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Unit extends Model
{
    use HasTranslations;

    protected $fillable = ['unit'];
    public $translatable = ['unit'];



    protected $casts = [
        'unit' => 'array',
    ];


    
}
