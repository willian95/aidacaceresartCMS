<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    protected $table="countries";

    public function users(){
        return $this->hasMany(User::class);
    }

    public function guestUsers(){
        return $this->hasMany(GuestUser::class);
    }

}
