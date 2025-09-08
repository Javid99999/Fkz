<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Securecode extends Model
{
    use HasTranslations;

    protected $translatable = ['description'];


    protected $fillable = ['code', 'description', 'product_statement_id'];



    protected $casts = [
        'description' => 'array'
    ];




    public function productStatement()
    {
        return $this->belongsTo(ProductStatement::class, 'product_statement_id');
    }







    // public function getDescriptionEnAttribute(): string
    // {
    //     return $this->getTranslation('description', 'en');
    // }

    // public function getDescriptionTrAttribute(): string
    // {
    //     return $this->getTranslation('description', 'tr');
    // }

    
}
