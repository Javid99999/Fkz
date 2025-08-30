<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Securecode extends Model
{
    

    protected $fillable = ['code', 'description', 'product_statement_id'];






    public function productStatement()
    {
        return $this->belongsTo(ProductStatement::class, 'product_statement_id');
    }
}
