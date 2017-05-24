<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'city_id'];

    public function city()
    {
        return $this->belongsTo('App\Model\City');
    }
}