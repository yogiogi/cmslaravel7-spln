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

use App\perubahandaya_model;
use App\pemohon_model;
use App\resource_model;
use Illuminate\Support\Str;

class Perubahandaya extends Controller
{
  public function save(Request $request)
  {
    $sifat_instalasi = $request->input('layanan');
    $layanan = '031';

    if ($sifat_instalasi == 2) {
      $layanan = '032';
    } else if ($sifat_instalasi == 3) {
      $layanan = '033';
    }

    $model = new resource_model();
    $id_layanan = $model->generateIdLayanan($layanan, $request->input('kabupaten'));
    $id_transaksi = $model->generateIdTansaksi($layanan);

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
    $no_meter = $request->input('no_meter');
    $peruntukan = $request->input('peruntukan');

    $dayabaru = $request->input('dayabaru');
    $dayalama = $request->input('dayalama');
    $biaya = $request->input('biaya');
    $ujl = $request->input('ujl');
    $slo = $request->input('slo');
    $gil = $request->input('gil');
    $ppn = $request->input('ppj');
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
      'id_pelanggan' => $id_pelanggan,
      'no_meter' => $no_meter,
      'peruntukan' => $peruntukan,
      'daya_baru' => $dayabaru,
      'daya_lama' => $dayalama,
      'slo' => $slo,
      'gil' => $gil,
      'ujl' => $ujl,

      'biaya' => $biaya,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
      'status' => $status,
    );

    // Insert
    $value = perubahandaya_model::insertData($data);
    if ($value) {
      Session::flash('message', 'Insert successfully.');
    } else {
      Session::flash('message', 'Username already exists.');
    }
    return redirect()->action('Home@index');
  }

  public function perhitungan(Request $request)
  {
    $layanan = $request->layanan;
    $dayalama = $request->dayalama;
    $dayabaru = $request->dayabaru;

    $model = new resource_model();
    $produk = $model->variablePerhitungan($layanan);

    $slo = $produk->slo;
    $gil = $produk->gil;
    $ujl = $produk->ujl;
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $biaya = $produk->biaya;
    $materai = $produk->materai;

    $dayaubah = $dayabaru - $dayalama;
    $jumlah_biaya = $dayaubah * $biaya;
    $ppn = $ppn * $jumlah_biaya;
    $ppj = $ppj * $jumlah_biaya;
    $total = $jumlah_biaya + $slo + $gil + $ujl + $ppn + $ppj + $materai;

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
