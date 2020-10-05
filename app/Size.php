<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    
    public function productFormatSizes(){
        return $this->hasMany(ProductFormatSize::class);
    }

}
