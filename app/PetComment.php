<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetComment extends Model
{
    public function pet()
    {
        $this->belongsTo('App\Pet');
    }
}
