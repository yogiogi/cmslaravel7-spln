<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\pemohon_model;
use App\resource_model;
use Illuminate\Support\Str;

class Pemohon extends Controller
{
    public function save_pemohon(Request $request)
    {
      //kodekuhusus+idkabupaten+uniquecode
        $nama_konsumen = $request->input('nama_konsumen');
        $ktp = $request->input('nomer_ktp');
        $alamat = $request->input('alamat');
        $provinsi = $request->input('provincy');
        $kabupaten = $request->input('city');
        $telp = $request->input('telepon_pemohon');
        $whatsapp = $request->input('whatsapp');
        $email = $request->input('email_konsumen');
    
        if($nama_konsumen !='' && $ktp !='' && $alamat != ''){
            $data = array(
              'id_layanan'=>$id_layanan,
              'nama_konsumen'=>$nama_konsumen,
              'ktp'=>$ktp,
              'alamat'=>$alamat,
              'provinsi'=>$provinsi,
              'kabupaten'=>$kabupaten,
              'telp'=>$telp,
              'whatsapp'=>$whatsapp,
              'email'=>$email,
            );
            
            error_log('submit data.');

            // Insert
            $value = null;
            $user = User::where('ktp', '=', $request->input('nomer_ktp'))->first();
            if ($user === null) {
              $user = pemohon_model::insertData($data);
              Session::flash('message','Insert successfully.');
            }else{
              Session::flash('message','Username already exists.');
            }

            return $user;
        }

        return redirect()->action('Home@index');
    }
}
