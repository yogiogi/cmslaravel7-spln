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
use App\pemohon_model;
use App\resource_model;

class Instalasi extends Controller
{
  public function save(Request $request){
    $nama_konsumen = $request->input('nama_konsumen');
    $ktp = $request->input('ktp');
    $alamat = $request->input('alamat');
    $provinsi = $request->input('provinsi');
    $kabupaten = $request->input('kabupaten');
    $telp = $request->input('telp');
    $email = $request->input('email');

    $biaya = $request->input('biaya');
    $titik_lampu = $request->input('lampu');
    $titik_saklar = $request->input('saklar');
    $titik_stop_kontak = $request->input('stopkontak');
    $ppn = $request->input('ppn');
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
      'biaya'=>$biaya,
      'titik_lampu'=>$titik_lampu,
      'titik_saklar'=>$titik_saklar,
      'titik_stop_kontak'=>$titik_stop_kontak,
      'ppn'=>$ppn,
      'ppj'=>$ppj,
      'materai'=>$materai,
      'total'=>$total,
      'status'=>$status,
    );   

    // Insert
    $value = Instalasi_model::insertData($data);
    if($value){
      Session::flash('message','Insert successfully.');
    }else{
      Session::flash('message','Username already exists.');
    }
    return redirect()->action('Home@index');
  }

  public function perhitungan(Request $request){
    $model = new resource_model();

    $titik_lampu = $request->lampu;
    $titik_saklar = $request->saklar;
    $titik_stop = $request->stopkontak;

    $produk = $model->variablePerhitungan(7);
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $biaya = $produk->biaya;
    $materai = $produk->materai;

    $jumlah_titik = $titik_lampu + $titik_saklar + $titik_stop;
    $jumlah_biaya = $jumlah_titik*$biaya;
    $ppn = $ppn*$jumlah_biaya;
    $ppj= $ppj*$jumlah_biaya;
    $total = $jumlah_biaya+$ppn+$ppj+$materai;

      $data= [
        'biaya' => $jumlah_biaya,
        'ppn' => $ppn,
        'ppj' => $ppj,
        'materai' => $materai,
        'total' => $total,
    ];
      return response()->json($data);
  }
}
