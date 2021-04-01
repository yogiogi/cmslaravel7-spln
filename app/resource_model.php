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
            ->orderBy('id', 'ASC')
            ->first();
        return $query;
    }

    public function getcity($id)
    {
        $query = DB::table('regencies')
            ->select('regencies.*')
            ->where('regencies.id', $id)
            ->orderBy('id', 'ASC')
            ->first();
        return $query;
    }

    public function getdistrict($id)
    {
        $query = DB::table('districts')
            ->select('districts.*')
            ->where('districts.id', $id)
            ->orderBy('id', 'ASC')
            ->first();
        return $query;
    }

    public function getvillage($id)
    {
        $query = DB::table('villages')
            ->select('villages.*')
            ->where('villages.id', $id)
            ->orderBy('id', 'ASC')
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
            ->orderBy('daya', 'ASC')
            ->get();
        return $query;
    }

    public function dayaId($id)
    {
        $query = DB::table('list_daya')
            ->select('list_daya.*')
            ->where('list_daya.id', $id)
            ->orderBy('id', 'ASC')
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
            ->orderBy('id', 'ASC')
            ->first();
        return $query;
    }

    public function variablePerhitungan($id)
    {
        $query = DB::table('variabel_perhitungan')
            ->select('variabel_perhitungan.*')
            ->where('variabel_perhitungan.id', $id)
            ->orderBy('id', 'DESC')
            ->first();
        return $query;
    }

    public function varLayanan()
    {
        $query = DB::table('variabel_perhitungan')
            ->get();
        return $query;
    }

    public function getLayanannya($table)
    {
        $query = DB::table($table)
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

    public function layananUbah()
    {
        $query = DB::table('layanan_ubah')
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

    function getProvName($kodeProv)
    {
        $query = DB::table('provinces')
            ->select('provinces.*')
            ->where('provinces.id', $kodeProv)
            ->orderBy('id', 'DESC')
            ->first();
        return $query;
    }
    function getKabName($kodeKabupaten)
    {
        $query = DB::table('regencies')
            ->select('regencies.*')
            ->where('id', $kodeKabupaten)
            ->first();
        return $query;
    }

    function getKecName($kodeKecamatan)
    {
        $query = DB::table('districts')
            ->select('districts.*')
            ->where('districts.id', $kodeKecamatan)
            ->first();
        return $query;
    }

    function getDesaName($kodeDesa)
    {
        $query = DB::table('villages')
            ->select('villages.*')
            ->where('villages.id', $kodeDesa)
            ->first();
        return $query;
    }


    // function getNilaiVar($table)
    // {
    //     $query = DB::table('var_pendaftaran_slo')
    //         ->select('var_pendaftaran_slo.*')
    //         ->first();
    //     return $query;
    // }

    // public function nilaiVar($table)
    // {
    //     $query = DB::table('var_pendaftaran_slo')
    //         ->select('id', 'daya')
    //         ->first();
    //     return $query;
    // }


    public function nilaiSLO()
    {
        $query = DB::table('var_pendaftaran_slo')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->get();
        return $query;
    }

    public function getNilaiSLO($daya)
    {
        $query = DB::table('var_pendaftaran_slo')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->where('daya', $daya)
            ->first();
        return $query;
    }

    public function nilaiPasangPasca()
    {
        $query = DB::table('var_pasang_baru_pascabayar')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->get();
        return $query;
    }

    public function getNilaiPasangPasca($daya)
    {
        $query = DB::table('var_pasang_baru_pascabayar')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->where('daya', $daya)
            ->first();
        return $query;
    }

    public function nilaiPasangPra()
    {
        $query = DB::table('var_pasang_baru_prabayar')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->get();
        return $query;
    }

    public function getNilaiPasangPra($daya)
    {
        $query = DB::table('var_pasang_baru_prabayar')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->where('daya', $daya)
            ->first();
        return $query;
    }

    public function nilaiUbahPraPra()
    {
        $query = DB::table('var_perubahan_daya_pra_pra')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->get();
        return $query;
    }

    public function getNilaiUbahPraPra($daya)
    {
        $query = DB::table('var_perubahan_daya_pra_pra')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->where('id', $daya)
            ->first();
        return $query;
    }
    public function nilaiUbahPascaPasca()
    {
        $query = DB::table('var_perubahan_daya_pasca_pasca')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->get();
        return $query;
    }

    public function getNilaiUbahPascaPasca($daya)
    {
        $query = DB::table('var_perubahan_daya_pasca_pasca')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->where('id', $daya)
            ->first();
        return $query;
    }

    public function nilaiUbahPraPasca()
    {
        $query = DB::table('var_perubahan_daya_pra_pasca')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->get();
        return $query;
    }

    public function getNilaiUbahPraPasca($daya)
    {
        $query = DB::table('var_perubahan_daya_pra_pasca')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->where('id', $daya)
            ->first();
        return $query;
    }

    public function nilaiInstalasi()
    {
        $query = DB::table('var_instalasi')
            ->select('id', 'daya', 'lampu', 'saklar', 'stopkontak', 'hargameter', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->first();
        return $query;
    }

    public function getNilaiInstalasi()
    {
        $query = DB::table('var_instalasi')
            ->select('id', 'daya', 'lampu', 'saklar', 'stopkontak', 'hargameter', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->first();
        return $query;
    }


    public function nilaiSambungSementara()
    {
        $query = DB::table('var_penyambungan_sementara')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->first();
        return $query;
    }

    public function getNilaiSambungSementara($daya)
    {
        $query = DB::table('var_penyambungan_sementara')
            ->select('id', 'daya', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->where('id', $daya)
            ->first();
        return $query;
    }

    public function nilaiMcbBox()
    {
        $query = DB::table('var_mcb_box')
            ->select('id', 'daya', 'harga_mcb', 'harga_lnb', 'harga_mccb', 'harga_trafo', 'mdp', 'sdp', 'slo', 'gil', 'ujl', 'materai', 'biaya', 'PPN', 'PPJ')
            ->first();
        return $query;
    }
}
