<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    public function school()
    {
        return $this->belongsTo('App\Model\School');
    }

    public function events()
    {
        return $this->belongsToMany('App\Model\Event');
    }
}