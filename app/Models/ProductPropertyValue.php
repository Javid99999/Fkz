<?php

namespace App\Models;

use App\Enum\ValueParseType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductPropertyValue extends Model
{

    use HasTranslations;


    public $timestamps = false;

    protected $fillable = ['value', 'numeric', 'value_parse_type', 'product_id', 'property_id', 'unit_id'];



    protected $translatable = ['value'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    protected $casts = [
        'value' => 'array',
        'value_parse_type' => ValueParseType::class
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    






    protected static function boot()
    {
        parent::boot();

        static::saving(function ($pivot) {
            
            $type = $pivot->value_parse_type;
            

            if ($type->value === 'text') {
                $pivot->numeric = null;
            } elseif ($type->value === 'numeric') {
                // $pivot->value = null; // veya ['en' => null] eğer JSON
                $pivot->attributes['value'] = null;
            }
        });
    }


}
