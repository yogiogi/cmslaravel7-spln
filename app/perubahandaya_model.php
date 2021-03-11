<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class perubahandaya_model extends Model
{
    protected $table = 'perubahan_daya';
    public $timestamps = true;

    protected $fillable = [
        'id_pemohon', 'sifat_instalasi', 'daya_baru', 'daya_lama', 'biaya',
        'ujl', 'slo', 'gil', 'ppn', 'ppj', 'materai', 'total'
    ];

    public static function insertData($data)
    {
        DB::table('perubahan_daya')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('perubahan_daya')
            ->join('provinces', 'provinces.id', '=', 'perubahan_daya.provinsi', 'LEFT')
            ->join('regencies', 'regencies.id', '=', 'perubahan_daya.kabupaten', 'LEFT')
            ->join('districts', 'districts.id', '=', 'perubahan_daya.kecamatan', 'LEFT')
            ->join('villages', 'villages.id', '=', 'perubahan_daya.desa', 'LEFT')
            ->select('perubahan_daya.*', 'provinces.name as prov', 'regencies.name as kab', 'districts.name as kec', 'villages.name as desa')
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
}
