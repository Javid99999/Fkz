<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classification extends Model
{
    use HasTranslations;

    protected $fillable = ['name'];

    protected $translatable = ['name'];

    protected $casts = [
        'name' => 'array',
    ];
}
