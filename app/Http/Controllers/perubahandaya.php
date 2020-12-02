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

class perubahandaya extends Controller
{
    public function savePerubahandaya(Request $request){
        if ($request->input('submit') != null ){
            $nama_konsumen = $request->input('nama_konsumen');
            $ktp = $request->input('nomer_ktp');
            $alamat = $request->input('alamat');
            $provinsi = $request->input('provincy');
            $kabupaten = $request->input('city');
            $telp = $request->input('telepon_pemohon');
            $email = $request->input('email_konsumen');

            $sifat_instalasi = $request->input('sifat_instalasi');
            $dayabaru = $request->input('dayabaru');
            $dayalama = $request->input('dayalama');
            $biaya = $request->input('biaya');
            $ujl = $request->input('ujl');
            $slo = $request->input('slo');
            $gil = $request->input('ppn');
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
                        'sifat_instalasi'=>$sifat_instalasi,
                        'daya_baru'=>$dayabaru,
                        'daya_lama'=>$dayalama,
                        'biaya'=>$biaya,
                        'ujl'=>$ujl,
                        'slo'=>$slo,
                        'gil'=>$gil,
                        'ppn'=>$ppn,
                        'ppj'=>$ppj,
                        'token'=>$token,
                        'materai'=>$materai,
                        'total'=>$total,
                        'status'=>$status,
                    );

                    Session::flash('message','Insert successfully.');
                }else{
                    Session::flash('message','Username already exists.');
                }

                // Insert
                $value = perubahandaya_model::insertData($data);
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
