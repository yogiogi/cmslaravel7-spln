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
            ->join('list_daya as a', 'a.id', '=', 'pasang_baru.daya', 'LEFT')
            ->join('variabel_perhitungan as c', 'c.kode_layanan', '=', 'pasang_baru.kode_layanan', 'LEFT')
            ->join('konfirmasi as d', 'd.id_transaksi', '=', 'pasang_baru.id_transaksi', 'LEFT')
            ->join('rekening as e', 'e.id_rekening', '=', 'd.id_rekening', 'LEFT')
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
                'c.gil as gilc',

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
