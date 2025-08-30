<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStatement extends Model
{
    protected $fillable = ['product_id', 'statements_id'];


    public function securecodes()
    {
        return $this->hasMany(Securecode::class,'product_statement_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function statement()
    {
        return $this->belongsTo(Statement::class, 'statement_id');
    }

}
