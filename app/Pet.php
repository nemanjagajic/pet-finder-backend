<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'description', 'latitude', 'longitude', 'street', 'name', 'country', 'city'
    ];

    public function comments()
    {
        return $this->hasMany('App\PetComment');
    }
}
