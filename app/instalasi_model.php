<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class instalasi_model extends Model
{
    protected $table = 'instalasi';
    public $timestamps = true;

    protected $fillable = [
        'id_pemohon', 'biaya', 'titik_lampu', 'titik_saklar', 'titik_stop_kontak', 'ppn', 'ppj', 'materai', 'total'
    ];

    public static function insertData($data)
    {
        DB::table('instalasi')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('instalasi')
            ->join('provinces', 'provinces.id', '=', 'instalasi.provinsi', 'LEFT')
            ->join('regencies', 'regencies.id', '=', 'instalasi.kabupaten', 'LEFT')
            ->join('districts', 'districts.id', '=', 'instalasi.kecamatan', 'LEFT')
            ->join('villages', 'villages.id', '=', 'instalasi.desa', 'LEFT')
            ->join('variabel_perhitungan as c', 'c.kode_layanan', '=', 'instalasi.kode_layanan', 'LEFT')
            ->select(
                'instalasi.*',
                'provinces.name as prov',
                'regencies.name as kab',
                'districts.name as kec',
                'villages.name as desa',
                'c.lampu as lampuc',
                'c.saklar as saklarc',
                'c.hargameter as hargameterc',
                'c.lampu as hargatitiklampu',
                'c.saklar as hargatitiksaklar',
                'c.stopkontak as hargatitikstopkontak',
                'c.materai as materaic',
                'c.ppn as ppnc',
                'c.ppj as ppjc',
                'c.biaya as biayac'
            )
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
}
