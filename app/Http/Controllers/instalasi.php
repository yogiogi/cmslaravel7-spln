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

use App\instalasi_model;
use App\pemohon_model;

class instalasi extends Controller
{
    public function saveInstalasi(Request $request){
        if ($request->input('submit') != null ){
            $nama_konsumen = $request->input('nama_konsumen');
            $ktp = $request->input('nomer_ktp');
            $alamat = $request->input('alamat');
            $provinsi = $request->input('provincy');
            $kabupaten = $request->input('city');
            $telp = $request->input('telepon_pemohon');
            $email = $request->input('email_konsumen');

            $biaya = $request->input('biaya');
            $titik_lampu = $request->input('titik_lampu');
            $titik_saklar = $request->input('titik_saklar');
            $titik_stop_kontak = $request->input('titik_stop_kontak');
            $ppn = $request->input('ppn');
            $ppj = $request->input('ppj');
            $materai = $request->input('materai');
            $total = $request->input('total');
            $status = 1;
    
            if($nama_konsumen !='' && $ktp !='' && $alamat != ''){
                $data_pemohon = array(
                    'nama_konsumen'=>$nama_konsumen,
                    'ktp'=>$ktp,
                    'alamat'=>$alamat,
                    'provinsi'=>$provinsi,
                    'kabupaten'=>$kabupaten,
                    'telp'=>$telp,
                    'email'=>$email
                );
                $valueId = pemohon_model::insertData($data_pemohon);
                
                if($valueId){
                    $data = array(
                        'id_pemohon'=>$valueId,
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

                    Session::flash('message','Insert successfully.');
                }else{
                    Session::flash('message','Username already exists.');
                }

                // Insert
                $value = instalasi_model::insertData($data);
                if($value){
                  Session::flash('message','Insert successfully.');
                }else{
                  Session::flash('message','Username already exists.');
                }
             }
          }
        return redirect()->action('Home@index');
      }
}
