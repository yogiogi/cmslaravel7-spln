<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

use App\Instalasi_model;
use App\resource_model;

class Instalasi extends Controller
{
  public function save(Request $request)
  {
    $model = new resource_model();
    $id_layanan = $model->generateIdLayanan('051', $request->input('kabupaten'));
    $id_transaksi = $model->generateIdTansaksi('051');

    $nama_konsumen = $request->input('nama_konsumen');
    $ktp = $request->input('ktp');
    $alamat = $request->input('alamat');
    $provinsi = $request->input('provinsi');
    $kabupaten = $request->input('kabupaten');
    $kecamatan = $request->input('kecamatan');
    $desa = $request->input('desa');
    $telp = $request->input('telp');
    $whatsapp = $request->input('whatsapp');
    $email = $request->input('email');

    $biaya = $request->input('biaya');
    $titik_lampu = $request->input('lampu');
    $titik_saklar = $request->input('saklar');
    $titik_stop_kontak = $request->input('stopkontak');
    $meter_kabel = $request->input('meterkabel');

    $hargameter = $request->input('hargameter');
    $harga_titiklampu = $request->input('harga_titiklampu');
    $harga_titiksaklar = $request->input('harga_titiksaklar');
    $harga_titikstopkontak = $request->input('harga_titikstopkontak');

    $jenis_kabel = $request->input('jeniskabel');
    $ppn = $request->input('ppn');
    $ppj = $request->input('ppj');
    $materai = $request->input('materai');
    $total = $request->input('total');
    $status = 0;

    $data = array(
      'id_layanan' => $id_layanan,
      'id_transaksi' => $id_transaksi,
      'kode_layanan' => '051',
      'nama_konsumen' => $nama_konsumen,
      'ktp' => $ktp,
      'alamat' => $alamat,
      'provinsi' => $provinsi,
      'kabupaten' => $kabupaten,
      'kecamatan' => $kecamatan,
      'desa' => $desa,
      'telp' => $telp,
      'whatsapp' => $whatsapp,
      'email' => $email,
      'biaya' => $biaya,
      'titik_lampu' => $titik_lampu,
      'titik_saklar' => $titik_saklar,
      'titik_stop_kontak' => $titik_stop_kontak,
      'meter_kabel' => $meter_kabel,
      'biaya_meter_kabel' => $hargameter,
      'biaya_titik_lampu' => $harga_titiklampu,
      'biaya_titik_saklar' => $harga_titiksaklar,
      'biaya_titik_stop_kontak' => $harga_titikstopkontak,
      'jenis_kabel' => $jenis_kabel,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
      'status' => $status,
    );

    // Insert
    $value = Instalasi_model::insertData($data);
    if ($value) {
      return response($id_layanan);
    } else {
      Session::flash('message', 'Username already exists.');
    }
  }

  public function perhitungan(Request $request)
  {
    $model = new resource_model();

    $titik_lampu = $request->lampu;
    $titik_saklar = $request->saklar;
    $titik_stop = $request->stopkontak;
    $meter_kabel = $request->input('meterkabel');

    $produk = $model->variablePerhitungan(7);
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $biaya = $produk->biaya;
    $materai = $produk->materai;
    $hargameter = $produk->hargameter;

    $hargameter = $hargameter * $meter_kabel;
    $harga_titiklampu = $titik_lampu * $produk->lampu;
    $harga_titiksaklar = $titik_saklar * $produk->saklar;
    $harga_titikstopkontak = $titik_stop * $produk->stopkontak;

    $jumlah_titik = $titik_lampu + $titik_saklar + $titik_stop;
    $jumlah_biaya = $jumlah_titik * $biaya;
    $jumlah_biaya = $hargameter + $jumlah_biaya;

    $ppn = $ppn * $jumlah_biaya;
    $ppj = $ppj * $jumlah_biaya;
    $total = $jumlah_biaya + $ppn + $ppj + $materai;

    $data = [
      'biaya' => $jumlah_biaya,
      'hargameter' => $hargameter,
      'harga_titiklampu' => $harga_titiklampu,
      'harga_titiksaklar' => $harga_titiksaklar,
      'harga_titikstopkontak' => $harga_titikstopkontak,

      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
    ];
    return response()->json($data);
  }
}
