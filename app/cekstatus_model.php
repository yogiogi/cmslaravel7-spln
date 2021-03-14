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
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }

    public function getCekstatus($idlayanan, $layanan)
    {
        $query = DB::table($layanan)
            ->select('*')
            ->where('id_layanan', $idlayanan)
            ->orderBy('id_layanan', 'DESC')
            ->first();
        return $query;
    }

    public function singlelist($idlayanan, $layanan)
    {
        if ($layanan == "pendaftaran_slo") {
            $query = DB::table('pendaftaran_slo')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'pendaftaran_slo.kode_layanan', 'LEFT')
                ->select('pendaftaran_slo.*', 'variabel_perhitungan.layanan as layanan')
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "pasang_baru") {
            $query = DB::table('pasang_baru')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'pasang_baru.kode_layanan', 'LEFT')
                ->select('pasang_baru.*', 'variabel_perhitungan.layanan as layanan')
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "perubahan_daya") {
            $query = DB::table('perubahan_daya')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'perubahan_daya.kode_layanan', 'LEFT')
                ->select('perubahan_daya.*', 'variabel_perhitungan.layanan as layanan')
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "penyambungan_sementara") {
            $query = DB::table('penyambungan_sementara')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'penyambungan_sementara.kode_layanan', 'LEFT')
                ->select('penyambungan_sementara.*', 'variabel_perhitungan.layanan as layanan')
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "instalasi") {
            $query = DB::table('instalasi')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'instalasi.kode_layanan', 'LEFT')
                ->select('instalasi.*', 'variabel_perhitungan.layanan as layanan')
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "mcb_box") {
            $query = DB::table('mcb_box')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'mcb_box.kode_layanan', 'LEFT')
                ->select('mcb_box.*', 'variabel_perhitungan.layanan as layanan')
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "pengaduan_teknis") {
            $query = DB::table('pengaduan_teknis')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'pengaduan_teknis.kode_layanan', 'LEFT')
                ->select('pengaduan_teknis.*', 'variabel_perhitungan.layanan as layanan')
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        }

        return $query;
    }
}
