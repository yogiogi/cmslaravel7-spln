<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penyambungansementara_model extends Model
{
    protected $table = 'penyambungan_sementara';
    public $timestamps = true;

    protected $fillable = [
        'id_pemohon', 'jam_nyala', 'hari_nyala', 'biaya', 'ppn', 'ppj', 'materai', 'total'
    ];

    public static function insertData($data)
    {
        DB::table('penyambungan_sementara')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('penyambungan_sementara')
            ->join('provinces', 'provinces.id', '=', 'penyambungan_sementara.provinsi', 'LEFT')
            ->join('regencies', 'regencies.id', '=', 'penyambungan_sementara.kabupaten', 'LEFT')
            ->join('districts', 'districts.id', '=', 'penyambungan_sementara.kecamatan', 'LEFT')
            ->join('villages', 'villages.id', '=', 'penyambungan_sementara.desa', 'LEFT')
            ->join('produk_layanan', 'produk_layanan.id', '=', 'penyambungan_sementara.sifat_instalasi', 'LEFT')
            ->join('variabel_perhitungan as c', 'c.kode_layanan', '=', 'penyambungan_sementara.kode_layanan', 'LEFT')
            ->select(
                'penyambungan_sementara.*',
                'provinces.name as prov',
                'regencies.name as kab',
                'districts.name as kec',
                'villages.name as desa',
                'produk_layanan.layanan as jenislayanan',
                'c.ppn as ppnc',
                'c.ppj as ppjc',
                'c.biaya as biayac'
            )
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
}
