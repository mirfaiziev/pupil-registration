<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;

    public function pupils()
    {
        $this->belongsToMany('App\Model\Pupil');
    }
}