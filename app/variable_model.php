<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class variable_model extends Model
{
    // kode_transaksi
    public function variable($id_variable)
    {
        $query = DB::table('variabel_perhitungan')
            ->where('id', $id_variable)
            ->select('variabel_perhitungan.*')
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
    // Main Setting
    public function listing()
    {
        $query = DB::table('variabel_perhitungan')
            ->select('*')
            ->orderBy('id', 'DESC')
            ->first();
        return $query;
    }


    public function listVariable($tblVar)
    {
        $query = DB::table($tblVar)
            ->select('*')
            ->first();
        return response()->json($query);
    }

    // kode_transaksi
    public function semua($table)
    {
        $query = DB::table($table)
            ->select('*')
            ->orderBy('daya', 'DESC')
            ->get();
        return $query;
    }
}
