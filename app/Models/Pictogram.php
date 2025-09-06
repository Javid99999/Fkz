<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Pictogram extends Model
{
    use HasTranslations;


    protected $fillable = [
        'name',
        'code',
        'symbol'
    ];



    protected $translatable = [
        'name'
    ];



    protected $casts = [
        'name' => 'array',
    ];
}
