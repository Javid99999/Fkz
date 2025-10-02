<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Pictogram extends Model
{
    use HasTranslations;


    protected $translatable = [
        'name'
    ];
    
    protected $fillable = [
        'name',
        'code',
        'symbol'
    ];



    



    protected $casts = [
        'name' => 'array',
    ];
}
