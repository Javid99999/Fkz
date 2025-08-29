<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskLevel extends Model
{
    protected $fillable = ['risk'];

    protected $translatable = ['risk'];


    protected $casts = ['risk' => 'array'];

}
