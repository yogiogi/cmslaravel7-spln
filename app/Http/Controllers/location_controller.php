<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class location_controller extends Controller
{
    public function getprovinces()
    {
        $provinces = DB::table('provinces')->pluck("name","id");
        return view('home/pendaftaranslo',compact('provinces'));
    }

    public function getKabupaten($id) 
    {        
        $regencies = DB::table("regencies")->where("province_id",$id)->pluck("name","id");
        return json_encode($states);
    }
}