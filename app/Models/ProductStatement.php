<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductStatement extends Pivot
{

    protected $table = 'product_statements';
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
