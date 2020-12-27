<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\pengaduanteknis_model;
use Illuminate\Support\Str;

class Pengaduanteknis extends Controller
{
    public function save(Request $request){
      $kodelayanan = DB::table('variabel_perhitungan')
      ->select('variabel_perhitungan.*')
      ->where('variabel_perhitungan.id', '9')
      ->first()->{'unique_id'};

      $nama_konsumen = $request->input('nama_pemohon');
      $ktp = $request->input('nomer_ktp');
      $alamat = $request->input('alamat');
      $provinsi = $request->input('provinsi');
      $kabupaten = $request->input('city');
      $telp = $request->input('telepon');
      $email = $request->input('email_konsumen');

      $keterangan = $request->input('keterangan');
      $status = 0;
      $uniqid = Str::random(5);
      $id_layanan = $kodelayanan.''. $uniqid.''.$request->input('city');
    
      //generateid = kodelayanan + wilayah + randomnumber + autoincrement
      $data = array(
        'id_layanan'=>$id_layanan,
        'nama_konsumen'=>$nama_konsumen,
        'ktp'=>$ktp,
        'alamat'=>$alamat,
        'provinsi'=>$provinsi,
        'kabupaten'=>$kabupaten,
        'telp'=>$telp,
        'email'=>$email,
        'keterangan'=>$keterangan,
        'status'=>$status,
      );      

      // Insert
      $value = pengaduanteknis_model::insertData($data);
      if($value){
        Session::flash('message','Insert successfully.');
      }else{
        Session::flash('message','Username already exists.');
      }    
      return redirect()->action('Home@index');
    }
}
