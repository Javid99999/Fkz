<?php

namespace App\Models;

use App\Enum\ColorEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Term extends Model
{
    use HasTranslations;


    protected $fillable = [
        'name',
        'description',
        'color'
    ];

    protected $translatable = [
        'name',
        'description'
    ];


    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'color' => ColorEnum::class,
    ];
}
