<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\pasangbaru_model;
use App\resource_model;

class Pasangbaru extends Controller
{
  public function save(Request $request)
  {
    $sifat_instalasi = $request->input('layanan');
    $layanan = "021";

    if ($sifat_instalasi == 2) {
      $layanan = "022";
    }

    $model = new resource_model();
    $id_layanan = $model->generateIdLayanan($layanan, $request->input('kabupaten'));
    $id_transaksi = $model->generateIdTansaksi($layanan);

    $nama_konsumen = $request->input('nama_konsumen');
    $alamat = $request->input('alamat');
    $provinsi = $request->input('provinsi');
    $kabupaten = $request->input('kabupaten');
    $kecamatan = $request->input('kecamatan');
    $desa = $request->input('desa');
    $ktp = $request->input('ktp');
    $telp = $request->input('telp');
    $whatsapp = $request->input('whatsapp');
    $email = $request->input('email');

    $biaya = $request->input('biaya');
    $daya = $request->input('daya');
    $token = $request->input('token');
    $slo = $request->input('slo');
    $gil = $request->input('gil');
    $ujl = $request->input('ujl');
    $ppn = $request->input('ppn');
    $ppj = $request->input('ppj');
    $materai = $request->input('materai');
    $total = $request->input('total');
    $status = 0;

    $data = array(
      'id_layanan' => $id_layanan,
      'id_transaksi' => $id_transaksi,
      'kode_layanan' => $layanan,
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
      'sifat_instalasi' => $sifat_instalasi,
      'biaya' => $biaya,
      'daya' => $daya,
      'token' => $token,
      'slo' => $slo,
      'gil' => $gil,
      'ujl' => $ujl,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
      'status' => $status,
    );

    // Insert
    $value = pasangbaru_model::insertData($data);
    if ($value) {
      Session::flash('message', 'Insert successfully.');
    } else {
      Session::flash('message', 'Username already exists.');
    }
    return redirect()->action('Home@index');
  }

  public function perhitungan(Request $request)
  {
    $model = new resource_model();

    $tokennilai = $request->token;
    $dayanilai = $request->daya;
    $layanan = $request->layanan;

    $produk = $model->variablePerhitungan($layanan);

    $slo = $produk->slo;
    $gil = $produk->gil;
    $ujl = $produk->ujl;
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $biaya = $produk->biaya;
    $materai = $produk->materai;

    $jumlah_biaya = $dayanilai * $biaya;
    $ppn = $ppn * $jumlah_biaya;
    $ppj = $ppj * $jumlah_biaya;
    $total = $jumlah_biaya + $slo + $gil + $ujl + $ppn + $ppj + $tokennilai + $materai;

    $data = [
      'biaya' => $jumlah_biaya,
      'slo' => $slo,
      'gil' => $gil,
      'ujl' => $ujl,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
    ];
    return response()->json($data);
  }
}
