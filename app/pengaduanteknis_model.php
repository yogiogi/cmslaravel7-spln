<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pengaduanteknis_model extends Model
{
    protected $table = 'pengaduan_teknis';
    public $timestamps = true;

    protected $fillable = [
        'id_pemohon', 'keterangan', 'biaya', 'status'
    ];

    public static function insertData($data)
    {
        DB::table('pengaduan_teknis')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('pengaduan_teknis')
            ->join('provinces', 'provinces.id', '=', 'pengaduan_teknis.provinsi', 'LEFT')
            ->join('regencies', 'regencies.id', '=', 'pengaduan_teknis.kabupaten', 'LEFT')
            ->join('districts', 'districts.id', '=', 'pengaduan_teknis.kecamatan', 'LEFT')
            ->join('villages', 'villages.id', '=', 'pengaduan_teknis.desa', 'LEFT')
            ->select('pengaduan_teknis.*', 'provinces.name as prov', 'regencies.name as kab', 'districts.name as kec', 'villages.name as desa')
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
}
