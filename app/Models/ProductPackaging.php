<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPackaging extends Model
{
    

    protected $fillable = [
        'product_id',
        'packaging_id'
    ];


    public function packaging()
    {
        return $this->belongsTo(Packaging::class);
    }
}
