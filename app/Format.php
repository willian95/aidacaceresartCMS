<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{

    public function productFormatSizes(){
        return $this->hasMany(ProductFormatSize::class);
    }
}
