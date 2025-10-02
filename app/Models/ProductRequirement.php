<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRequirement extends Model
{
    protected $fillable = [
        'product_id',
        'requirement_id'
    ];



    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
    
}
