<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetAdComment extends Model
{
    public function petAd()
    {
        $this->belongsTo('App\PetAd');
    }
}
