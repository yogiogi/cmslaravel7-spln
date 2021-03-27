<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\pendaftaranslo_model;
use App\resource_model;

class Pendaftaranslo extends Controller
{
  // Tambah
  public function save(Request $request)
  {
    $model = new resource_model();
    $id_layanan = $model->generateIdLayanan('011', $request->input('kabupaten'));
    $id_transaksi = $model->generateIdTansaksi('011');

    $nama_konsumen = $request->input('nama_konsumen');
    $ktp = $request->input('ktp');
    $telp = $request->input('telp');
    $whatsapp = $request->input('whatsapp');
    $alamat = $request->input('alamat');
    $provinsi = $request->input('provinsi');
    $kabupaten = $request->input('kabupaten');
    $kecamatan = $request->input('kecamatan');
    $desa = $request->input('desa');
    $email = $request->input('email');

    $instalasi = $request->input('instalasi');

    $dayalama = $request->input('dayalama');
    $djklama = $request->input('nomer_djk');

    $daya = $request->input('dayabaru');
    $badan_usaha = $request->input('badan_usaha');

    $biaya = $request->input('biaya');
    $slo = $request->input('slo');
    $gil = $request->input('gil');
    $ppn = $request->input('ppn');
    $ppj = $request->input('ppj');
    $materai = $request->input('materai');
    $total = $request->input('total');
    $status = 0;

    $data = [
      'id_layanan' => $id_layanan,
      'id_transaksi' => $id_transaksi,
      'kode_layanan' => '011',
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
      'instalasi' => $instalasi,
      'daya' => $daya,
      'badan_usaha' => $badan_usaha,
      'status' => $status,

      'biaya' => $biaya,
      'slo' => $slo,
      'gil' => $gil,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
    ];

    if ($instalasi == 2) {
      $data = [
        'id_layanan' => $id_layanan,
        'id_transaksi' => $id_transaksi,
        'kode_layanan' => '011',
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
        'instalasi' => $instalasi,
        'dayalama' => $dayalama,
        'daya' => $daya,
        'djklama' => $djklama,
        'badan_usaha' => $badan_usaha,
        'status' => $status,

        'biaya' => $biaya,
        'slo' => $slo,
        'gil' => $gil,
        'ppn' => $ppn,
        'ppj' => $ppj,
        'materai' => $materai,
        'total' => $total,
      ];
    }

    $value = pendaftaranslo_model::insertData($data);
    if ($value) {
      return response($id_layanan);
    } else {
      Session::flash('message', 'Username already exists.');
    }
  }

  public function statusslo(Request $request)
  {
    if (Session()->get('username') == "") {
      return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
    }
    DB::table('kategori_produk')->where('id', $request->id_pendaftaran)->update([
      'tgl_approve'   => $request->urutan,
      'status'            => $request->keterangan
    ]);
    return redirect('admin/kategori_produk')->with(['sukses' => 'Data telah diupdate']);
  }


  public function perhitungan(Request $request)
  {
    $model = new resource_model();

    $dayalama = $request->dayalama;
    $dayabaru = $request->dayabaru;

    $produk = $model->variablePerhitungan(10);
    $slo = $produk->slo;
    $gil = $produk->gil;
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $biaya = $produk->biaya;
    $materai = $produk->materai;

    $dayanilai = abs($dayalama - $dayabaru);
    $slo = $slo * $dayanilai;
    $gil = $gil * $dayanilai;
    $jumlah_biaya = $slo + $gil;
    $ppn = $ppn * $jumlah_biaya;
    $ppj = $ppj * $jumlah_biaya;
    $total = $jumlah_biaya + $ppn + $ppj + $materai;

    $data = [
      'biaya' => $jumlah_biaya,
      'slo' => $slo,
      'gil' => $gil,
      'ppn' => $ppn,
      'ppj' => $ppj,
      'materai' => $materai,
      'total' => $total,
    ];
    return response()->json($data);
  }

  // public function cetak($slug_produk)
  // {
  //   $daftarslo          = DB::table('pendaftaran_slo')->first();
  //   $model              = new Produk_model();
  //   $produk             = $model->read($slug_produk);
  //   $gambar             = $model->gambar($produk->id_produk);
  //   $produk_all         = $model->kategori_produk($produk->id_kategori_produk);
  //   $kategori_produk    = $model->detail_kategori_produk($produk->id_kategori_produk);

  //   $data = array(
  //     'title'             => $produk->nama_produk,
  //     'deskripsi'         => $produk->nama_produk,
  //     'keywords'          => $produk->nama_produk,
  //     'site'              => $site,
  //     'produk'            => $produk,
  //     'gambar'            => $gambar,
  //     'gambar2'           => $gambar,
  //     'produk_all'        => $produk_all,
  //     'kategori_produk'   => $kategori_produk,
  //   );
  //   $config = [
  //     'format' => 'A4-P', // Landscape
  //     // 'margin_top' => 0
  //   ];
  //   $pdf = PDF::loadview('produk/cetak', $data, [], $config);
  //   // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
  //   $nama_file = $produk->nama_produk . '.pdf';
  //   return $pdf->stream($nama_file, 'I');
  // }
}
