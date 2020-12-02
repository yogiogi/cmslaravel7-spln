<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class provinsi_model extends Model
{
    protected $guarded = [];
    public function subcategories(){
        return $this->hasMany('App\Provinsi', 'id');
    }
}