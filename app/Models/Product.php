<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;


    protected $translatable = ['name','description','packaging'];

    protected $fillable = [
        'name',
        'cas_number',
        'description',
        'packaging',
        'country_id',
        'category_id',
        'delivery_info_id'
    ];



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
        $this->addMediaCollection('pdfs')
              ->acceptsMimeTypes(['application/pdf']);
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
                ->fit(Fit::Max, 348, 192)
                ->sharpen(10) 
                ->quality(90)
                ->performOnCollections('vitrin');
    }



    // public function mediaUrls(string $collectionName = 'vitrin', string $conversionName = '', bool $multiple = false): string|array|null
    // {
    //     $mediaItems = $this->getMedia($collectionName);

    //     if ($mediaItems->isEmpty()) {
    //         return $multiple ? [] : null;
    //     }

    //     $urls = $mediaItems->map(function ($media) use ($conversionName) {
    //         if ($conversionName && $media->hasGeneratedConversion($conversionName)) {
    //             return $media->getUrl($conversionName);
    //         }
    //         return $media->getUrl();
    //     });

    //     return $multiple ? $urls->toArray() : $urls->first();
    // }

    


    public function mediaUrls(string $collectionName): string|array|null
    {
        $mediaItems = $this->getMedia($collectionName);

        if ($mediaItems->isEmpty()) {
            return $collectionName === 'detailfoto' ? [] : null;
        }

        // Vitrin için tek resim, detailfoto için tüm resimler
        if ($collectionName === 'vitrin') {
            return $mediaItems->first()->getUrl('vitrin-thumb');
        }

        if ($collectionName === 'detailfoto') {
            return $mediaItems->map(fn($media) => $media->getUrl('detail'))->toArray();
        }

        if($collectionName === 'pdfs'){
            return $mediaItems->map(fn($media) => [
                'url' => $media->getUrl(),
                'name' => $media->name,
            ])->toArray();
        }

        // Diğer koleksiyonlar için orijinal URL
        return $mediaItems->map(fn($media) => $media->getUrl())->toArray();
    }




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
    // }//$this->imageUrl('vitrin', 'vitrin-thumb');

    // // Detail: çoklu foto
    // public function imageUrls(string $collectionName = 'detailfoto', string $conversionName = ''): array
    // {
    //     return $this->getMedia($collectionName)
    //         ->map(function ($media) use ($conversionName) {
    //             if ($conversionName && $media->hasGeneratedConversion($conversionName)) {
    //                 return $media->getUrl($conversionName);
    //             }
    //             return $media->getUrl();
    //         })
    //         ->toArray();
    // }
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

    public function productClassification()
    {
        return $this->belongsToMany(
            Classification::class, 
            'product_classifications', 
            'product_id', 
            'classification_id'
        );
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


    public function productPictogram()
    {
        return $this->belongsToMany(
            Pictogram::class, 
            'product_pictograms', 
            'product_id', 
            'pictogram_id'
        );
    }


    // Pivot üzerinden securecodes’u almak için helper

    // bunu sile bilirim 
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




    public function deliveryMethods()
    {
        return $this->belongsToMany(DeliveryMethod::class, 'product_delivery_methods')
                    ->using(ProductDeliveryMethod::class)
                    ->withPivot([
                        'additional_cost', 
                        'currency', 
                        'estimated_days_min', 
                        'estimated_days_max', 
                        'custom_notes', 
                        'custom_attributes',
                        'availability_type',
                        'location_code',
                        'location_name',
                        'specific_details'
                    ]);
    }


    public function productDeliveryMethods()
    {
        return $this->hasMany(ProductDeliveryMethod::class);
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



    public function productCountryShipment():BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'product_countries');
    }

    public function productTerms():BelongsToMany
    {
        return $this->belongsToMany(Term::class,'product_terms');
    }


    public function requireDoc()
    {
        return $this->belongsToMany(Requirement::class, 'product_requirements');
    }

    public function productPackaging()
    {
        return $this->belongsToMany(Packaging::class, 'product_packagings');
    }

    public function deliverInfo()
    {
        return $this->belongsTo(DeliveryInfo::class, 'delivery_info_id');
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






    // protected static function booted()
    // {
    //     static::saved(function ($record) {
    //         // Eğer detailfoto var ve vitrin boşsa
    //         if ($record->hasMedia('detailfoto') && ! $record->hasMedia('vitrin')) {
    //             $first = $record->getFirstMedia('detailfoto');
    //             if ($first) {
    //                 $first->copy($record, 'vitrin');
    //             }
    //         }
    //     });
    // }


    // protected static function booted()
    // {
    //     static::saved(function ($record) {
    //         $detailPhotos = $record->getMedia('detailfoto');

    //         // Eğer detailfoto daha önce boşsa, yani ilk resim yüklenmişse
    //         if ($detailPhotos->count() === 1) {
    //             $latestDetail = $detailPhotos->first();

    //             // Vitrin koleksiyonunda resim varsa sil
    //             if ($record->hasMedia('vitrin')) {
    //                 $record->clearMediaCollection('vitrin');
    //             }

    //             // İlk detailfoto resmini vitrine kopyala
    //             $latestDetail->copy($record, 'vitrin');
    //         }
    //     });
    // }


    // protected static function booted()
    // {
    //     static::saved(function ($record) {
    //         $detailPhotos = $record->getMedia('detailfoto');

    //         // Vitrin koleksiyonunu temizle
    //         $record->clearMediaCollection('vitrin');

    //         if ($detailPhotos->isNotEmpty()) {
    //             // İlk detailfoto resmini vitrine kopyala
    //             $firstDetail = $detailPhotos->first();
    //             $firstDetail->copy($record, 'vitrin');
    //         }
    //     });
    // }

  

    protected static function booted()
    {

        static::saved(function ($record) {
            $detailPhotos = $record->getMedia('detailfoto');
            $firstDetail = $detailPhotos->first();

            $vitrin = $record->getFirstMedia('vitrin');

            if (!$firstDetail) {
                // Detailfoto boşsa vitrin temizle
                $record->clearMediaCollection('vitrin');
                return;
            }

            // Vitrin zaten ilk resim ile eşleşiyorsa bir şey yapma
            if ($vitrin && $vitrin->id === $firstDetail->id) {
                return;
            }

            // Vitrin farklıysa temizle ve ilk resmi kopyala
            $record->clearMediaCollection('vitrin');
            $firstDetail->copy($record, 'vitrin');
            
            
        });
        


    }





}
