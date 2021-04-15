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
            ->join('konfirmasi as d', 'd.id_transaksi', '=', 'pengaduan_teknis.id_transaksi', 'LEFT')
            ->join('rekening as e', 'e.id_rekening', '=', 'd.id_rekening', 'LEFT')
            ->select(
                'pengaduan_teknis.*',
                'provinces.name as prov',
                'regencies.name as kab',
                'districts.name as kec',
                'villages.name as desa',

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
