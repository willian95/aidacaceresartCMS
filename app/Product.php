<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    public function productFormatSizes(){
        return $this->hasMany(ProductFormatSize::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
