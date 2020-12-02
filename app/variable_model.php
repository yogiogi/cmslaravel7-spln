<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class variable_model extends Model
{
 // kode_transaksi
 public function variable($id_variable)
 {
     $query = DB::table('variable_perhitungan')
        ->where('id', $id_variable)
        ->select('variable_perhitungan.*')
        ->orderBy('id','DESC')
        ->get();
     return $query;
 }
}