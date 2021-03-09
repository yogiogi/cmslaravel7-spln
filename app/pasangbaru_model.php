<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pasangbaru_model extends Model
{
    protected $table = 'pasang_baru';
    public $timestamps = true;

    protected $fillable = [
        'nama_konsumen', 'ktp', 'alamat', 'provinsi', 'kabupaten', 'telp', 'whatsapp', 'email', 'sifat_instalasi', 'biaya', 'daya', 'slo', 'gil', 'ujl', 'ppn', 'ppj', 'token', 'materai', 'total'
    ];

    public static function insertData($data)
    {
        DB::table('pasang_baru')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('pasang_baru')
            ->join('provinces', 'provinces.id', '=', 'pasang_baru.provinsi', 'LEFT')
            ->join('regencies', 'regencies.id', '=', 'pasang_baru.kabupaten', 'LEFT')
            ->join('districts', 'districts.id', '=', 'pasang_baru.kecamatan', 'LEFT')
            ->join('villages', 'villages.id', '=', 'pasang_baru.desa', 'LEFT')
            ->select('pasang_baru.*', 'provinces.name as prov', 'regencies.name as kab', 'districts.name as kec', 'villages.name as desa')
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
}
