<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pendaftaranslo_model extends Model
{
    protected $table = 'pendaftaran_slo';
    public $timestamps = true;

    protected $fillable = [
        'nama_konsumen', 'ktp', 'alamat', 'provinsi', 'kabupaten', 'telp', 'whatsapp', 'email', 'instalasi', 'daya', 'dayalama', 'djklama', 'badan_usaha', 'tgl_permohonan', 'tgl_approve'
    ];

    public static function getkonsumenData($id = 0)
    {
        if ($id == 0) {
            $value = DB::table('pendaftaran_slo')->orderBy('id', 'asc')->get();
        } else {
            $value = DB::table('pendaftaran_slo')->where('id', $id)->first();
        }
        return $value;
    }

    public static function getdaftarsloData($id)
    {
        $value = DB::table('pendaftaran_slo')->where('id', $id)->first();
        return $value;
    }

    public static function insertData($data)
    {
        DB::table('pendaftaran_slo')->insert($data);
        return 1;
    }

    // pendaftaranslo
    public function semua()
    {
        $query = DB::table('pendaftaran_slo')
            ->join('provinces', 'provinces.id', '=', 'pendaftaran_slo.provinsi', 'LEFT')
            ->join('regencies', 'regencies.id', '=', 'pendaftaran_slo.kabupaten', 'LEFT')
            ->join('districts', 'districts.id', '=', 'pendaftaran_slo.kecamatan', 'LEFT')
            ->join('villages', 'villages.id', '=', 'pendaftaran_slo.desa', 'LEFT')
            ->join('list_daya as a', 'a.id', '=', 'pendaftaran_slo.daya', 'LEFT')
            ->join('list_daya as b', 'b.id', '=', 'pendaftaran_slo.dayalama', 'LEFT')
            ->join('variabel_perhitungan as c', 'c.kode_layanan', '=', 'pendaftaran_slo.kode_layanan', 'LEFT')
            ->join('konfirmasi as d', 'd.id_transaksi', '=', 'pendaftaran_slo.id_transaksi', 'LEFT')
            ->join('rekening as e', 'e.id_rekening', '=', 'd.id_rekening', 'LEFT')
            ->select(
                'pendaftaran_slo.*',
                'provinces.name as prov',
                'regencies.name as kab',
                'districts.name as kec',
                'villages.name as desa',
                'a.daya as daya',
                'b.daya as dayalama',
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

    //singledata
    public static function singlelist($idlayanan)
    {
        $query = DB::table('pendaftaran_slo')
            ->select('pendaftaran_slo.*')
            ->where('pendaftaran_slo.id_layanan', $idlayanan)
            ->orderBy('id', 'DESC')
            ->first();
        return $query;
    }

    // pendaftaranslo
    public function status_pemesanan($status_pemesanan)
    {
        $query = DB::table('pendaftaran_slo')
            ->select('pendaftaran_slo.*')
            ->where('pendaftaran_slo.status', $status_pemesanan)
            ->orderBy('id', 'DESC')
            ->get();
        return $query;
    }

    // nomor_akhir
    public function nomor_akhir()
    {
        $query = DB::table('pendaftaran_slo')
            ->select('*')
            ->orderBy('id', 'DESC')
            ->first();
        return $query;
    }

    // nomor_akhir
    public function nomor_akhir_tanggal($tanggal_order)
    {
        $query = DB::table('pendaftaran_slo')
            ->select('*')
            ->where('tanggal_trx', $tanggal_order)
            ->orderBy('id', 'DESC')
            ->first();
        return $query;
    }
}
