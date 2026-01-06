<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = [
                            'image', 
                            'name', 
                            'description', 
                            'price', 
                            'category', 
                            'stock',
                            'created_by'
                         ];

    protected function category()    {
        return Attribute::make(
            get: fn ($value) => $value ?? 'Uncategorized',
        );
    }
}
