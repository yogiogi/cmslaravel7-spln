<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class resource_model extends Model
{
    public function provinsi()
    {
        $query = DB::table('provinces')
            ->get();
        return $query;
    }

    public function layanan()
    {
        $query = DB::table('produk_layanan')
            ->get();
        return $query;
    }

    public function daya()
    {
        $query = DB::table('list_daya')
            ->get();
        return $query;
    }

    public function sifat_instalasi()
    {
        $query = DB::table('sifat_instalasi')
            ->get();
        return $query;
    }

    public function variablePerhitungan($id)
    {
        $query = DB::table('variabel_perhitungan')
            ->select('variabel_perhitungan.*')
            ->where('variabel_perhitungan.id',$id)
            ->orderBy('id','DESC')
            ->first();
        return $query;
    }

    public function token()
    {
        $query = DB::table('token')
            ->get();
        return $query;
    }
}
