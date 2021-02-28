<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cekstatus_model extends Model
{
    protected $table = 'instalasi';
    public $timestamps = true;
    
    public function semua()
    {
        $query = DB::table('instalasi')
            ->select('instalasi.*')
            ->orderBy('id','DESC')
            ->get();
        return $query;
    }

    public function getCekstatus($idlayanan, $layanan)
    {
        $query = DB::table($layanan)
            ->select('*')
            ->where('id_layanan', $idlayanan)
            ->orderBy('id_layanan','DESC')
            ->first();
        return $query;
    }

    public function singlelist($idlayanan, $layanan)
    {
        $query = DB::table($layanan)
            ->select('*')
            ->where('id_layanan', $idlayanan)
            ->orderBy('id','DESC')
            ->first();
        return $query;
    }
}