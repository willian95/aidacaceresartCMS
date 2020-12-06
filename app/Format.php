<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Format extends Model
{

    use SoftDeletes;

    public function productFormatSizes(){
        return $this->hasMany(ProductFormatSize::class);
    }
}
