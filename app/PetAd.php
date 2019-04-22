<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetAd extends Model
{
    public function comments()
    {
        return $this->hasMany('App\PetAdComment');
    }
}
