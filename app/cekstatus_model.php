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
        $result = DB::table($layanan)
            ->select('*')
            ->where('id_layanan', $idlayanan)
            ->orderBy('id_layanan', 'DESC')
            ->first();

        if ($result == null) {
            $result = "Data tidak ditemukan";
        }
        return $result;
    }

    public function singlelist($idlayanan, $layanan)
    {
        if ($layanan == "pendaftaran_slo") {
            $query = DB::table('pendaftaran_slo')
                ->join('provinces', 'provinces.id', '=', 'pendaftaran_slo.provinsi', 'LEFT')
                ->join('regencies', 'regencies.id', '=', 'pendaftaran_slo.kabupaten', 'LEFT')
                ->join('districts', 'districts.id', '=', 'pendaftaran_slo.kecamatan', 'LEFT')
                ->join('villages', 'villages.id', '=', 'pendaftaran_slo.desa', 'LEFT')
                ->join('list_daya as a', 'a.id', '=', 'pendaftaran_slo.daya', 'LEFT')
                ->join('list_daya as b', 'b.id', '=', 'pendaftaran_slo.dayalama', 'LEFT')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'pendaftaran_slo.kode_layanan', 'LEFT')
                ->select(
                    'pendaftaran_slo.*',
                    'provinces.name as prov',
                    'regencies.name as kab',
                    'districts.name as kec',
                    'villages.name as desa',
                    'a.daya as daya',
                    'b.daya as dayalama',
                    'variabel_perhitungan.layanan as layanan'
                )
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "pasang_baru") {
            $query = DB::table('pasang_baru')
                ->join('provinces', 'provinces.id', '=', 'pasang_baru.provinsi', 'LEFT')
                ->join('regencies', 'regencies.id', '=', 'pasang_baru.kabupaten', 'LEFT')
                ->join('districts', 'districts.id', '=', 'pasang_baru.kecamatan', 'LEFT')
                ->join('villages', 'villages.id', '=', 'pasang_baru.desa', 'LEFT')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'pasang_baru.kode_layanan', 'LEFT')
                ->select(
                    'pasang_baru.*',
                    'provinces.name as prov',
                    'regencies.name as kab',
                    'districts.name as kec',
                    'villages.name as desa',
                    'variabel_perhitungan.layanan as layanan'
                )
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "perubahan_daya") {
            $query = DB::table('perubahan_daya')
                ->join('provinces', 'provinces.id', '=', 'perubahan_daya.provinsi', 'LEFT')
                ->join('regencies', 'regencies.id', '=', 'perubahan_daya.kabupaten', 'LEFT')
                ->join('districts', 'districts.id', '=', 'perubahan_daya.kecamatan', 'LEFT')
                ->join('villages', 'villages.id', '=', 'perubahan_daya.desa', 'LEFT')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'perubahan_daya.kode_layanan', 'LEFT')
                ->select(
                    'perubahan_daya.*',
                    'provinces.name as prov',
                    'regencies.name as kab',
                    'districts.name as kec',
                    'villages.name as desa',
                    'variabel_perhitungan.layanan as layanan'
                )
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "penyambungan_sementara") {
            $query = DB::table('penyambungan_sementara')
                ->join('provinces', 'provinces.id', '=', 'penyambungan_sementara.provinsi', 'LEFT')
                ->join('regencies', 'regencies.id', '=', 'penyambungan_sementara.kabupaten', 'LEFT')
                ->join('districts', 'districts.id', '=', 'penyambungan_sementara.kecamatan', 'LEFT')
                ->join('villages', 'villages.id', '=', 'penyambungan_sementara.desa', 'LEFT')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'penyambungan_sementara.kode_layanan', 'LEFT')
                ->select(
                    'penyambungan_sementara.*',
                    'provinces.name as prov',
                    'regencies.name as kab',
                    'districts.name as kec',
                    'villages.name as desa',
                    'variabel_perhitungan.layanan as layanan'
                )
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "instalasi") {
            $query = DB::table('instalasi')
                ->join('provinces', 'provinces.id', '=', 'instalasi.provinsi', 'LEFT')
                ->join('regencies', 'regencies.id', '=', 'instalasi.kabupaten', 'LEFT')
                ->join('districts', 'districts.id', '=', 'instalasi.kecamatan', 'LEFT')
                ->join('villages', 'villages.id', '=', 'instalasi.desa', 'LEFT')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'instalasi.kode_layanan', 'LEFT')
                ->select(
                    'instalasi.*',
                    'provinces.name as prov',
                    'regencies.name as kab',
                    'districts.name as kec',
                    'villages.name as desa',
                    'variabel_perhitungan.layanan as layanan'
                )
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "mcb_box") {
            $query = DB::table('mcb_box')
                ->join('provinces', 'provinces.id', '=', 'mcb_box.provinsi', 'LEFT')
                ->join('regencies', 'regencies.id', '=', 'mcb_box.kabupaten', 'LEFT')
                ->join('districts', 'districts.id', '=', 'mcb_box.kecamatan', 'LEFT')
                ->join('villages', 'villages.id', '=', 'mcb_box.desa', 'LEFT')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'mcb_box.kode_layanan', 'LEFT')
                ->select(
                    'mcb_box.*',
                    'provinces.name as prov',
                    'regencies.name as kab',
                    'districts.name as kec',
                    'villages.name as desa',
                    'variabel_perhitungan.layanan as layanan'
                )
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        } else if ($layanan == "pengaduan_teknis") {
            $query = DB::table('pengaduan_teknis')
                ->join('provinces', 'provinces.id', '=', 'pengaduan_teknis.provinsi', 'LEFT')
                ->join('regencies', 'regencies.id', '=', 'pengaduan_teknis.kabupaten', 'LEFT')
                ->join('districts', 'districts.id', '=', 'pengaduan_teknis.kecamatan', 'LEFT')
                ->join('villages', 'villages.id', '=', 'pengaduan_teknis.desa', 'LEFT')
                ->join('variabel_perhitungan', 'variabel_perhitungan.kode_layanan', '=', 'pengaduan_teknis.kode_layanan', 'LEFT')
                ->select(
                    'pengaduan_teknis.*',
                    'provinces.name as prov',
                    'regencies.name as kab',
                    'districts.name as kec',
                    'villages.name as desa',
                    'variabel_perhitungan.layanan as layanan'
                )
                ->where('id_layanan', $idlayanan)
                ->orderBy('id', 'DESC')
                ->first();
        }

        return $query;
    }
}
