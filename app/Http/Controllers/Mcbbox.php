<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\mcbbox_model;
use App\resource_model;

class Mcbbox extends Controller
{
  public function save(Request $request)
  {
    $model = new resource_model();
    $id_layanan = $model->generateIdLayanan("061", $request->input('kabupaten'));

    $id_transaksi = $model->generateIdTansaksi("061");

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

    $jenisbox = $request->input('jenisbox');
    $grup_mcb = $request->input('grup_mcb');
    $grup_lnb = $request->input('grup_lnb');
    $grup_mccb = $request->input('grup_mccb');
    $grup_trafo = $request->input('grup_trafo');
    $mdp = $request->input('mdp');
    $sdp = $request->input('sdp');

    $biayamcb = $request->input('biayamcb');
    $biayalnb = $request->input('biayalnb');
    $biayamccb = $request->input('biayamccb');
    $biayatrafo = $request->input('biayatrafo');
    $biayamdp = $request->input('biayamdp');
    $biayasdp = $request->input('biayasdp');
    $biaya = $request->input('biaya');

    $ppn = $request->input('ppn');
    $ppj = $request->input('ppj');
    $materai = $request->input('materai');
    $total = $request->input('total');
    $status = 0;

    $data = array(
      'id_layanan' => $id_layanan,
      'id_transaksi' => $id_transaksi,
      'kode_layanan' => '061',
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
      'jenisbox' => $jenisbox,
      'grup_mcb' => $grup_mcb,
      'grup_lnb' => $grup_lnb,
      'grup_mccb' => $grup_mccb,
      'grup_trafo' => $grup_trafo,
      'mdp' => $mdp,
      'sdp' => $sdp,

      'biaya_mcb' => $biayamcb,
      'biaya_lnb' => $biayalnb,
      'biaya_mccb' => $biayamccb,
      'biaya_trafo' => $biayatrafo,
      'biayamdp' => $biayamdp,
      'biayasdp' => $biayasdp,
      'biaya' => $biaya,

      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
      'status' => $status,
    );

    $value = mcbbox_model::insertData($data);
    if ($value) {
      return response($id_layanan);
    } else {
      Session::flash('message', 'Username already exists.');
    }
  }

  public function perhitungan(Request $request)
  {
    $mcb_box = $request->grup_mcb;
    $lnb_box = $request->grup_lnb;
    $lnb_box = $request->grup_lnb;
    $mccb_box = $request->grup_mccb;
    $trafo = $request->grup_trafo;

    $model = new resource_model();
    $produk = $model->variablePerhitungan(8);

    $harga_mcb =  $produk->harga_mcb;
    $harga_lnb =  $produk->harga_lnb;
    $harga_mccb =  $produk->harga_mccb;
    $harga_trafo =  $produk->harga_trafo;

    $mdp = $request->mdp;
    $harga_mdp = 0;
    if ($mdp != null) {
      $harga_mdp =  $produk->mdp;
    }

    $sdp = $request->sdp;
    $harga_sdp = 0;
    if ($sdp != null) {
      $harga_sdp =  $produk->sdp;
    }

    $biayainstall = $produk->biaya;
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $materai = $produk->materai;

    $harga_mcb = $harga_mcb * $mcb_box;
    $harga_lnb = $harga_lnb * $lnb_box;
    $harga_mccb = $harga_mccb * $mccb_box;
    $harga_trafo = $harga_trafo * $trafo;

    $jumlah_biaya = $harga_mcb + $harga_lnb + $harga_mccb + $harga_mdp + $harga_sdp +  $harga_trafo + $biayainstall;
    $ppn = $ppn * $jumlah_biaya;
    $ppj = $ppj * $jumlah_biaya;
    $total = $jumlah_biaya + $ppn + $ppj + $materai;

    $data = [
      'harga_mcb' => $harga_mcb,
      'harga_lnb' => $harga_lnb,
      'harga_mccb' => $harga_mccb,
      'harga_trafo' => $harga_trafo,
      'harga_mdp' => $harga_mdp,
      'harga_sdp' => $harga_sdp,
      'mdp' => $mdp,
      'sdp' => $sdp,
      'biaya' => $biayainstall,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
    ];
    return response()->json($data);
  }
}
