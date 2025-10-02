<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Packaging extends Model
{
    use HasTranslations;


    protected $fillable = ['packaging'];


    protected $translatable = ['packaging'];


    protected $casts = ['packaging'];

    
}
