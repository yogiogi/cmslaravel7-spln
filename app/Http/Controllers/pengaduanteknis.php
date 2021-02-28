<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\pengaduanteknis_model;
use App\resource_model;


class Pengaduanteknis extends Controller
{
  public function save(Request $request)
  {
    $model = new resource_model();
    $id_layanan = $model->generateIdLayanan("071", $request->input('desa'));
    $id_transaksi = $model->generateIdTansaksi("071");

    $nama_konsumen = $request->input('nama_pemohon');
    $ktp = $request->input('nomer_ktp');
    $alamat = $request->input('alamat');
    $provinsi = $request->input('provinsi');
    $kabupaten = $request->input('kabupaten');
    $kecamatan = $request->input('kecamatan');
    $desa = $request->input('desa');
    $telp = $request->input('telepon');
    $whatsapp = $request->input('whatsapp');
    $email = $request->input('email_konsumen');

    $keterangan = $request->input('keterangan');
    $status = 0;

    $data = array(
      'id_layanan' => $id_layanan,
      'id_transaksi' => $id_transaksi,
      'kode_layanan' => '071',
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
      'keterangan' => $keterangan,
      'status' => $status,
    );

    // Insert
    $value = pengaduanteknis_model::insertData($data);
    if ($value) {
      Session::flash('message', 'Insert successfully.');
    } else {
      Session::flash('message', 'Username already exists.');
    }
    return redirect()->action('Home@index');
  }
}
