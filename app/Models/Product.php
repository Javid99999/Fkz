<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;


    protected $fillable = [
        'name',
        'cas_number',
        'description',
        'packaging',
        'country_id',
        'category_id'
    ];


    protected $translatable = ['name','description','packaging'];


    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'packaging' => 'array',
    ];






    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('detailfoto')
            ->useDisk('public');

        $this->addMediaCollection('vitrin')
            ->singleFile()
            ->useDisk('public');
    }


    public function registerMediaConversions(?Media $media = null): void
    {
        // Detail foto boyutu
        // $this->addMediaConversion('detail')
        //      ->width(432)
        //      ->height(432)
        //      ->performOnCollections('detailfoto');
        $this->addMediaConversion('detail')
                ->width(432)
                ->height(432)
                ->sharpen(10)
                ->quality(90)
                ->performOnCollections('detailfoto');

        // Vitrin boyutu
        $this->addMediaConversion('vitrin-thumb')  // 'vitrin' yerine 'vitrin-thumb'
                ->width(348)
                ->height(192)
                ->sharpen(10) 
                ->quality(90)
                ->performOnCollections('vitrin');
    }



    public function imageUrl(string $collectionName = 'vitrin', string $conversionName = ''): ?string
    {
        $media = $this->getFirstMedia($collectionName);

        if (!$media) {
            return null;
        }

        if ($conversionName && $media->hasGeneratedConversion($conversionName)) {
            return $media->getUrl($conversionName);
        }

        return $media->getUrl();
    }//$this->imageUrl('vitrin', 'vitrin-thumb');

    // Detail: çoklu foto
    public function imageUrls(string $collectionName = 'detailfoto', string $conversionName = ''): array
    {
        return $this->getMedia($collectionName)
            ->map(function ($media) use ($conversionName) {
                if ($conversionName && $media->hasGeneratedConversion($conversionName)) {
                    return $media->getUrl($conversionName);
                }
                return $media->getUrl();
            })
            ->toArray();
    }
    //$this->imageUrls('detail', 'detail');



    // public function imageUrl(string $collectionName = 'vitrin', string $conversionName = ''): ?string
    // {
    //     $media = $this->getFirstMedia($collectionName);

    //     if (!$media) {
    //         return null;
    //     }

    //     if ($conversionName && $media->hasGeneratedConversion($conversionName)) {
    //         return $media->getUrl($conversionName);
    //     }

    //     return $media->getUrl();
    // }

    /// Kullanim  $imageVitrin = $model->imageUrl('vitrin', 'vitrin-thumb');
    ///           $imageDetail = $model->imageUrl('detailfoto', 'detail');


    public function getVitrinImageAttribute()
    {
        $media = $this->getFirstMedia('vitrin');
        return $media ? $media->getUrl('vitrin-thumb') : null;
    }

    // Detail fotoları almak için  
    public function getDetailImagesAttribute()
    {
        $media = $this->getMedia('detailfoto');
        
        if ($media->isEmpty()) {
            return collect([]); // Boş collection döner
        }
        
        return $media->map(function ($media) {
            return $media->getUrl('detail');
        });
    }




    public function productPropertyValuess()
    {
        return $this->hasMany(ProductPropertyValue::class);
    }


    // Dur hele
    public function productPropertyValues()
    {
        return $this->belongsToMany(
            Property::class,
            'product_property_values',
            'product_id',
            'property_id',
        )
        ->withPivot('value', 'numeric', 'value_parse_type','unit_id');
    }


    public function units()
    {
        return $this->belongsToMany(Unit::class, 'product_property_values', 'product_id', 'unit_id');
    }


    public function statements()
    {
        return $this->belongsToMany(
            Statement::class, 
            'product_statements', 
            'product_id', 
            'statement_id')
                ->withPivot('id'); // product_statement tablosundaki id-yi cekmek ucun
    }

    public function Pstatements()
    {
        return $this->hasManyThrough(
            Statement::class,
            ProductStatement::class,
            'product_id',    // ProductStatement.product_id
            'id',            // Statement.id
            'id',            // Product.id
            'statement_id'   // ProductStatement.statement_id
        );
    }


    // public function productStatements()
    // {
    //     return $this->hasMany(ProductStatement::class);
    // }
    public function productStatements()
    {
        return $this->hasMany(ProductStatement::class)->with([
            'statement',
            'securecodes' => fn($q) => $q->orderBy('id')
        ])->orderBy('id'); // statement sırası
    }


    // Pivot üzerinden securecodes’u almak için helper
    public function statementsWithSecurecodes()
    {
        return $this->statements->map(function ($statement) {
            $pivot = $statement->pivot; // ProductStatement pivot modeli

            return [
                'id' => $statement->id,
                'name' => $statement->name,
                'securecodes' => $pivot ? $pivot->securecodes : collect(),
            ];
        });
    }

    


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }






    public function productClassifications()
    {
        return $this->belongsToMany(Classification::class,'product_classifications')
            ->withPivot('risk_level_id');
    }



    public function getNameEnAttribute()
    {
        return $this->name['en'] ?? null;
    }

    public function getNameAzAttribute()
    {
        return $this->name['az'] ?? null;
    }











    
    public function getNameTrAttribute()
    {
        return $this->name['tr'] ?? null;
    }

    public function getNameRuAttribute()
    {
        return $this->name['ru'] ?? null;
    }


    public function getNameChAttribute()
    {
        return $this->name['zhcn'] ?? null;
    }


}
