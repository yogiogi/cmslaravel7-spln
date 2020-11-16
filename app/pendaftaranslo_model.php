<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pendaftaran_model extends Model
{

    public function semua($token_transaksi)
    {
        $query = DB::table('pendaftaran_slo')
            ->select('pendaftaran_slo.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }

    public function status_daftar($status_daftar)
    {
        $query = DB::table('pendaftaran_slo')
            ->select('pendaftaran_slo.*')
            ->where('pendaftaran_slo.status',$status_daftar)
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }
}
