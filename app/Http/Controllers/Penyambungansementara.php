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
use Carbon\Carbon;

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
    $id_pelanggan = $request->input('id_pelanggan');
    $no_meter = $request->input('nomer_meter');
    $durasi = $request->input('durasi');
    $biaya = $request->input('biaya');

    $ppn = $request->input('ppn');
    $ppj = $request->input('ppj');
    $materai = $request->input('materai');
    $total = $request->input('total');
    $jammulai = $request->input('jammulai');
    $tanggal_nyala = $request->input('tanggal_nyala');

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
      'id_pelanggan' => $id_pelanggan,
      'no_meter' => $no_meter,
      'durasi' => $durasi,
      'tanggal_nyala' => $tanggal_nyala,
      'jammulai' => $jammulai,
      'biaya' => $biaya,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
      'status' => $status,
    );

    $value = Penyambungansementara_model::insertData($data);
    if ($value) {
      return response($id_layanan);
    } else {
      Session::flash('message', 'Username already exists.');
    }
  }

  public function perhitungan(Request $request)
  {
    $model = new resource_model();
    // $produk = $model->variablePerhitungan(6);
    $produk = $model->nilaiSambungSementara();

    $durasi = $request->durasi;

    $biaya = $produk->biaya;
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $materai = $produk->materai;

    $jumlah_biaya = $durasi * $biaya;
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
