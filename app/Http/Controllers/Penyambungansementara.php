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

use App\Penyambungansementara_model;
use App\resource_model;
use App\pemohon_model;
use Illuminate\Support\Str;

class Penyambungansementara extends Controller
{
  public function save(Request $request)
  {
    $model = new resource_model();
    $id_layanan = $model->generateIdLayanan('041', $request->input('kabupaten'));
    $id_transaksi = $model->generateIdTansaksi('041');

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

    $jam_mulai = $request->input('jam_mulai');
    $hari_akhir = $request->input('hari_akhir');
    $hari_nyala = $request->input('hari_nyala');
    $biaya = $request->input('biaya');

    $ppn = $request->input('ppn');
    $ppj = $request->input('ppj');
    $materai = $request->input('materai');
    $total = $request->input('total');
    $status = 0;

    $data = array(
      'id_layanan' => $id_layanan,
      'id_transaksi' => $id_transaksi,
      'kode_layanan' => '041',
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
      'jam_mulai' => $jam_mulai,
      'hari_mulai' => $hari_mulai,
      'hari_akhir' => $hari_akhir,
      'hari_nyala' => $hari_nyala,
      'biaya' => $biaya,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
      'status' => $status,
    );

    $value = Penyambungansementara_model::insertData($data);
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
    $produk = $model->variablePerhitungan(6);
    $jam_mulai = $request->jam_mulai;
    $lama_hari = $request->lama_hari;

    $biaya = $produk->biaya;
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $materai = $produk->materai;

    $jumlah_biaya = $jam_nyala * $biaya;
    $ppn = $ppn * $jumlah_biaya;
    $ppj = $ppj * $jumlah_biaya;
    $total = $jumlah_biaya + $ppn + $ppj + $materai;

    $data = [
      'biaya' => $jumlah_biaya,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
    ];
    return response()->json($data);
  }
}
