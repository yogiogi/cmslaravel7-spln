<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class kabupaten_model extends Model
{
    public function provinces()
    {
        return $this->belongsTo('App\provinsi_model');
    }
}