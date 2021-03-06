<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class konfirmasi_model extends Model
{
    protected $table = 'pasang_baru';
    public $timestamps = true;

    protected $fillable = [
        'nama_konsumen', 'ktp', 'alamat', 'provinsi', 'kabupaten', 'telp', 'whatsapp', 'email', 'sifat_instalasi', 'biaya', 'daya', 'slo', 'gil', 'ujl', 'ppn', 'ppj', 'token', 'materai', 'total'
    ];

    public static function insertData($data)
    {
        DB::table('konfirmasi')->insert($data);
        return 1;
    }

    public function semua()
    {
        $query = DB::table('pendaftaran_slo')
            ->join('provinces', 'provinces.id', '=', 'pasang_baru.provinsi', 'LEFT')
            ->join('regencies', 'regencies.id', '=', 'pasang_baru.kabupaten', 'LEFT')
            ->join('districts', 'districts.id', '=', 'pasang_baru.kecamatan', 'LEFT')
            ->join('villages', 'villages.id', '=', 'pasang_baru.desa', 'LEFT')
            ->join('list_daya as a', 'a.id', '=', 'pasang_baru.daya', 'LEFT')
            ->join('variabel_perhitungan as c', 'c.kode_layanan', '=', 'pasang_baru.kode_layanan', 'LEFT')
            ->select(
                'pasang_baru.*',
                'provinces.name as prov',
                'regencies.name as kab',
                'districts.name as kec',
                'villages.name as desa',
                'a.daya as daya',
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

    public static function getValue($idTransaksi, $layanan)
    {
        $result = DB::table($layanan)
            ->select('*')
            ->where('id_transaksi', $idTransaksi)
            ->where('status_bayar', 0)
            ->orderBy('id_transaksi', 'DESC')
            ->first();

        // if ($result == null) {
        //     $result = "Data tidak ditemukan";
        // }
        return $result;
    }
}
