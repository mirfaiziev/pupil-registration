<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SuggestName extends Model
{
    protected $primaryKey = 'name';
    public $timestamps = false;
    public $incrementing = false;
}