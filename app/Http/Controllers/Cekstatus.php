<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\nav_model;

class cekstatus extends Controller
{
    public function getCekstatus(Request $request)
    {
        $cekstatus = DB::table($request->layanan)
        ->where("id_layanan",$request->id_layanan)
        ->pluck("name","id");
        return response()->json($cekstatus);
    }
}