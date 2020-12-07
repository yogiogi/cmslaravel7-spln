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

class Perubahandaya extends Controller
{
  public function save(Request $request){
    $nama_konsumen = $request->input('nama_konsumen');
    $ktp = $request->input('ktp');
    $alamat = $request->input('alamat');
    $provinsi = $request->input('provinsi');
    $kabupaten = $request->input('kabupaten');
    $telp = $request->input('telp');
    $email = $request->input('email');

    $layanan = $request->input('layanan');
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
        'nama_konsumen'=>$nama_konsumen,
        'ktp'=>$ktp,
        'alamat'=>$alamat,
        'provinsi'=>$provinsi,
        'kabupaten'=>$kabupaten,
        'telp'=>$telp,
        'email'=>$email,
        'sifat_instalasi'=>$layanan,
        'daya_baru'=>$dayabaru,
        'daya_lama'=>$dayalama,
        'slo'=>$slo,
        'gil'=>$gil,
        'ujl'=>$ujl,

        'biaya'=>$biaya,
        'ppn'=>$ppn,
        'ppj'=>$ppj,
        'materai'=>$materai,
        'total'=>$total,
        'status'=>$status,
      );

      // Insert
      $value = perubahandaya_model::insertData($data);
      if($value){
        Session::flash('message','Insert successfully.');
      }else{
        Session::flash('message','Username already exists.');
      }
    return redirect()->action('Home@index');
  }

  public function perhitungan(Request $request){
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

    $dayaubah = $dayabaru-$dayalama;
    $jumlah_biaya = $dayaubah*$biaya;
    $ppn = $ppn*$jumlah_biaya;
    $ppj= $ppj*$jumlah_biaya;
    $total = $jumlah_biaya+$slo+$gil+$ujl+$ppn+$ppj+$materai;

      $data= [
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
