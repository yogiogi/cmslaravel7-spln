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

use App\pengaduanteknis_model;
use App\pemohon_model;

class Pengaduanteknis extends Controller
{
    public function save(Request $request){
      $nama_konsumen = $request->input('nama_pemohon');
      $ktp = $request->input('nomer_ktp');
      $alamat = $request->input('alamat');
      $provinsi = $request->input('provinsi');
      $kabupaten = $request->input('city');
      $telp = $request->input('telepon');
      $email = $request->input('email_konsumen');

      $keterangan = $request->input('keterangan');
      $status = 0;
    
      //generateid = kodelayanan + wilayah + randomnumber + autoincrement
      $data = array(
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
