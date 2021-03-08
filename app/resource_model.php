<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class resource_model extends Model
{
    public function provinsi()
    {
        $query = DB::table('provinces')
            ->get();
        return $query;
    }

    public function getprovinsi($id)
    {
        $query = DB::table('provinces')
            ->select('provinces.*')
            ->where('provinces.id', $id)
            ->orderBy('id','ASC')
            ->first();
        return $query;
    }

    public function getcity($id)
    {
        $query = DB::table('regencies')
            ->select('regencies.*')
            ->where('regencies.id', $id)
            ->orderBy('id','ASC')
            ->first();
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
            ->orderBy('daya','ASC')
            ->get();
        return $query;
    }

    public function dayaId($id)
    {
        $query = DB::table('list_daya')
            ->select('list_daya.*')
            ->where('list_daya.id', $id)
            ->orderBy('id','ASC')
            ->first();
        return $query;
    }

    public function sifat_instalasi()
    {
        $query = DB::table('sifat_instalasi')
            ->get();
        return $query;
    }

    public function getSifatInstalasi($id)
    {
        $query = DB::table('sifat_instalasi')
            ->select('sifat_instalasi.*')
            ->where('sifat_instalasi.id', $id)
            ->orderBy('id','ASC')
            ->first();
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

    
    public function varLayanan()
    {
        $query = DB::table('variabel_perhitungan')
            ->get();
        return $query;
    }

    public function pilihLayanan()
    {
        $query = DB::table('variabel_perhitungan')
                 ->select('variabel_perhitungan.*')
                 ->whereBetween('id', array(3, 5))
                 ->get();
        return $query;
    }

    public function jenisMCB()
    {
        $query = DB::table('jenis_box')
            ->get();
        return $query;
    }

    public function token()
    {
        $query = DB::table('token')
            ->get();
        return $query;
    }

    public function tokenId($id)
    {
        $query = DB::table('token')
            ->select('token.*')
            ->where('token.id', $id)
            ->first();
        return $query;
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }


    function generateIdLayanan($kodelayanan, $kodeKabupaten)
    {
      $datetime = Carbon::now()->format('dmyHis');
      
      $id_layanan = $datetime . '' . $kodelayanan . '' . $kodeKabupaten;
      return  $id_layanan;
    }
  
    function generateIdTansaksi($kodelayanan)
    {  
      $date = Carbon::now()->format('dmy');
      $uniqid = Str::random(4);
      $id_transaksi = $uniqid . '' . $kodelayanan . '' . $date;
      return  $id_transaksi;
    }
}
