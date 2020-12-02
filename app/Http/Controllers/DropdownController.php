<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class DropdownController extends Controller
{
    
    public function index()
    {
        $provinces = DB::table("provinces")->pluck("name","id");
        return view('index',compact('provinces'));
    }

    public function getCityList(Request $request)
    {
    	$cities = DB::table("regencies")
        ->where("province_id",$request->province_id)
        ->pluck("name","id");
        return response()->json($cities);
    }
}