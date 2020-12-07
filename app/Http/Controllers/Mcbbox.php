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

use App\mcbbox_model;
use App\pemohon_model;
use App\resource_model;

class Mcbbox extends Controller
{
  public function save(Request $request){
    $nama_konsumen = $request->input('nama_konsumen');
    $alamat = $request->input('alamat');
    $provinsi = $request->input('provinsi');
    $kabupaten = $request->input('kabupaten');
    $ktp = $request->input('ktp');
    $telp = $request->input('telp');
    $email = $request->input('email');
    
    $grup_mcb = $request->input('grup_mcb');
    $biaya = $request->input('biaya');
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
      'grup_mcb'=>$grup_mcb,
      'ppn'=>$ppn,
      'ppj'=>$ppj,
      'materai'=>$materai,
      'total'=>$total,
      'status'=>$status,
    );

    // Insert
    $value = mcbbox_model::insertData($data);
    if($value){
      Session::flash('message','Insert successfully.');
    }else{
      Session::flash('message','Username already exists.');
    }
    return redirect()->action('Home@index');
  }  

  public function perhitungan(Request $request){
    $model = new resource_model();
    $produk = $model->variablePerhitungan(6);
    $mcb_box = $request->grup_mcb;
    $biaya = $produk->biaya;
    $ppn = $produk->PPN;
    $ppj = $produk->PPJ;
    $materai = $produk->materai;

    $jumlah_biaya = $mcb_box*$biaya;
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
