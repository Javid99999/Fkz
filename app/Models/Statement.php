<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Statement extends Model
{

    protected $fillable = ['name'];

    

    public function securee()
    {
        return $this->hasMany(Securecode::class);
    }


    public function productStatements()
    {
        return $this->hasMany(ProductStatement::class);
    }

    public function securecodes()
    {
        return $this->hasManyThrough(
            Securecode::class,
            ProductStatement::class,
            'statement_id',      // ProductStatement.statement_id
            'product_statement_id', // Securecode.product_statement_id
            'id',                // Statement.id
            'id'                 // ProductStatement.id
        );
    }


    public function productStatement()
    {
        return $this->hasMany(ProductStatement::class, 'statement_id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class, 
            'product_statement', 
            'statement_id',
             'product_id')
                ->withPivot('id'); // product_statement tablosundaki id-yi cekmek ucun
    }
}
