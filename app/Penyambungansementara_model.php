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
            ->select('penyambungan_sementara.*', 'provinces.name as prov', 'regencies.name as kab', 'districts.name as kec', 'villages.name as desa')
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
}
