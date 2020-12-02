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

use App\Penyambungansementara_model;
use App\resource_model;
use App\pemohon_model;

class Penyambungansementara extends Controller
{
    public function savePenyambungansementara(ClientRequest $request, Client $clien){
      
      if ($request->get('submit') != null ){
        // $nama_konsumen = $_GET['nama'];
        // $ktp = $_GET['ktp'];
        // $ktp = $_GET['ktp'];
        // $alamat = $_GET['alamat'];
        // $provinsi = $_GET['provinsi'];
        // $kabupaten = $_GET['kabupaten'];
        // $telp = $_GET['telp'];
        // $email = $_GET['email'];

        // $jam_nyala = $_GET['jam_nyala'];
        // $hari_nyala = $_GET['hari_nyala'];
        // $biaya = $_GET['biaya'];
        // $ppn = $_GET['ppn'];
        // $ppj = $_GET['ppj'];
        // $materai = $_GET['materai'];
        // $total = $_GET['total'];
        error_log('submit data.');

        $nama_konsumen = $request->nama_konsumen;
        $ktp = $request->nomer_ktp;
        $alamat = $request->alamat;
        $provinsi = $request->provinsi;
        $kabupaten = $request->kabupaten;
        $email = $request->email;

        // $jam_nyala = $request->get('jam_nyala');
        // $hari_nyala = $request->get('hari_nyala');
        // $biaya = $request->get('biaya');
        // $ppn = $request->get('ppn');
        // $ppj = $request->get('ppj');
        // $materai = $request->get('materai');
        // $total = $request->get('total');
        // $status = 1;

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
                
                // if($valueId){
                //     $data = array(
                //         'id_pemohon'=>$valueId,
                //         'jam_nyala'=>$jam_nyala,
                //         'hari_nyala'=>$hari_nyala,
                //         'biaya'=>$biaya,
                //         'ppn'=>$ppn,
                //         'ppj'=>$ppj,
                //         'materai'=>$materai,
                //         'total'=>$total,
                //         'status'=>$status,
                //     );
                //     $valueId = Penyambungansementara_model::insertData($data);

                //     Session::flash('message','Insert successfully.');
                // }else{
                //     Session::flash('message','Username already exists.');
                // }

                // // Insert
                // $value = penyambungansementara_model::insertData($data);
                if($valueId){
                  Session::flash('message','Insert successfully.');
                }else{
                  Session::flash('message','Username already exists.');
                }
             }
          }
        return redirect()->action('Home@index');
      }

  public function getValue(){
    $name = Input::get('name_by_user');
    return $name;
  }

  public function perhitungan(Request $request){
    $model = new resource_model();
    $produk             = $model->variablePerhitungan(6);
    // $variabel = $resource->variablePerhitungan(6);
    // if ($request->input('submit') != null ){
      $jam_nyala = $request->jam_nyala;
      $hari_nyala = $request->hari_nyala;
      $biaya = $produk->biaya;
      $ppn = $produk->PPN;
      $ppj = $produk->PPJ;
      $materai = $produk->materai;

      $jumlah_biaya = $jam_nyala*$hari_nyala*$biaya;
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
    // }
  }
}
