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
            ->join('produk_layanan', 'produk_layanan.id', '=', 'penyambungan_sementara.sifat_instalasi', 'LEFT')
            ->join('variabel_perhitungan as c', 'c.kode_layanan', '=', 'penyambungan_sementara.kode_layanan', 'LEFT')
            ->join('konfirmasi as d', 'd.id_transaksi', '=', 'penyambungan_sementara.id_transaksi', 'LEFT')
            ->join('rekening as e', 'e.id_rekening', '=', 'd.id_rekening', 'LEFT')
            ->select(
                'penyambungan_sementara.*',
                'provinces.name as prov',
                'regencies.name as kab',
                'districts.name as kec',
                'villages.name as desa',
                'produk_layanan.layanan as jenislayanan',
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
