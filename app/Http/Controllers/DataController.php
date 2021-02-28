<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataController extends Controller
{
    public function getCountries()
    {
        $countries = DB::table('provinces')->pluck("name","id");
        return view('home/pendaftaranslo',compact('provinces'));
    }

    public function getStates($id) 
    {
        $states = DB::table("regencies")->where("provinces_id",$id)->pluck("name","id");
        return json_encode($states);
    }
}