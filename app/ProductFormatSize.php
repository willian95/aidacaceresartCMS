<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFormatSize extends Model
{
    
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function format(){
        return $this->belongsTo(Format::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

}
