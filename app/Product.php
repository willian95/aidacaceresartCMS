<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    public function productFormatSizes(){
        return $this->hasMany(ProductFormatSize::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
