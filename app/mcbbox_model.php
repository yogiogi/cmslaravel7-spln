<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class mcbbox_model extends Model
{
    protected $table = 'mcb_box';
    public $timestamps = true;

    protected $fillable = [
        'id_pemohon', 'biaya', 'grup_mcb', 'ppn', 'ppj', 'materai', 'total'
    ];

    public static function insertData($data)
    {
        DB::table('mcb_box')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('mcb_box')
            ->join('provinces', 'provinces.id', '=', 'mcb_box.provinsi', 'LEFT')
            ->join('regencies', 'regencies.id', '=', 'mcb_box.kabupaten', 'LEFT')
            ->join('districts', 'districts.id', '=', 'mcb_box.kecamatan', 'LEFT')
            ->join('villages', 'villages.id', '=', 'mcb_box.desa', 'LEFT')
            ->join('jenis_box', 'jenis_box.id', '=', 'mcb_box.jenisbox', 'LEFT')
            ->join('variabel_perhitungan as c', 'c.kode_layanan', '=', 'mcb_box.kode_layanan', 'LEFT')
            ->select(
                'mcb_box.*',
                'provinces.name as prov',
                'regencies.name as kab',
                'districts.name as kec',
                'villages.name as desa',
                'jenis_box.jenis as jenis',
                'c.harga_mcb as mcbc',
                'c.harga_lnb as lnbc',
                'c.harga_mccb as mccbc',
                'c.harga_trafo as trafoc',
                'c.mdp as mdpc',
                'c.sdp as sdpc',
                'c.ppn as ppnc',
                'c.ppj as ppjc',
                'c.biaya as biayac',
                'c.slo as sloc',
                'c.gil as gilc'
            )
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
}
