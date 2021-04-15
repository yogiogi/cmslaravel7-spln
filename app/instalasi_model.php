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
            ->join('konfirmasi as d', 'd.id_transaksi', '=', 'instalasi.id_transaksi', 'LEFT')
            ->join('rekening as e', 'e.id_rekening', '=', 'd.id_rekening', 'LEFT')
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
                'c.biaya as biayac',


                'e.nomor_rekening as noreksplnd',
                'e.nama_bank as namabanksplnd',
                'e.atas_nama as atasnamasplnd',
                'd.cara_bayar as carabayard',
                'd.tgl_bayar as tgld',
                'd.bukti_bayar as buktid',
                'd.tgl_bayar as tglbayard',
                'd.jumlah_pembayaran as jmlpembayarand',
                'd.nama_pemilik_rek as namapemilikd',
                'd.nama_bank as namabankd',
                'd.nomor_rekening as norekd',
                'd.keterangan as keterangand'
            )
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }
}
