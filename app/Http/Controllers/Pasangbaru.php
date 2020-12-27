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

use App\pasangbaru_model;
use App\resource_model;
use App\pemohon_model;
use Illuminate\Support\Str;

class Pasangbaru extends Controller
{
    public function save(Request $request){
      $sifat_instalasi = $request->input('layanan');
      $kodelayanan = DB::table('variabel_perhitungan')
      ->select('variabel_perhitungan.*')
      ->where('variabel_perhitungan.id', $sifat_instalasi)
      ->first()->{'unique_id'};

      $nama_konsumen = $request->input('nama_konsumen');
      $alamat = $request->input('alamat');
      $provinsi = $request->input('provinsi');
      $kabupaten = $request->input('kabupaten');
      $ktp = $request->input('ktp');
      $telp = $request->input('telp');
      $email = $request->input('email');

      $biaya = $request->input('biaya');
      $daya = $request->input('daya');
      $token = $request->input('token');
      $slo = $request->input('slo');
      $gil = $request->input('gil');
      $ujl = $request->input('ujl');
      $ppn = $request->input('ppn');
      $ppj = $request->input('ppj');
      $materai = $request->input('materai');
      $total = $request->input('total');
      $status = 0;
      $uniqid = Str::random(5);

      $id_layanan = $kodelayanan.''. $uniqid.''.$request->input('city');
      $data = array(
        'id_layanan'=>$id_layanan,
        'nama_konsumen'=>$nama_konsumen,
        'ktp'=>$ktp,
        'alamat'=>$alamat,
        'provinsi'=>$provinsi,
        'kabupaten'=>$kabupaten,
        'telp'=>$telp,
        'email'=>$email,
        'sifat_instalasi'=>$sifat_instalasi,
        'biaya'=>$biaya,
        'daya'=>$daya,
        'token'=>$token,
        'slo'=>$slo,
        'gil'=>$gil,
        'ujl'=>$ujl,
        'ppn'=>$ppn,
        'ppj'=>$ppj,
        'materai'=>$materai,
        'total'=>$total,
        'status'=>$status,
      );
      
      // Insert
      $value = pasangbaru_model::insertData($data);
      if($value){
        Session::flash('message','Insert successfully.');
      }else{
        Session::flash('message','Username already exists.');
      }
      return redirect()->action('Home@index');
    }

    public function perhitungan(Request $request){
      $model = new resource_model();

      $tokennilai = $request->token;
      $dayanilai = $request->daya;
      $layanan = $request->layanan;

      $produk = $model->variablePerhitungan($layanan);

      $slo = $produk->slo;
      $gil = $produk->gil;
      $ujl = $produk->ujl;
      $ppn = $produk->PPN;
      $ppj = $produk->PPJ;
      $biaya = $produk->biaya;
      $materai = $produk->materai;
  
      $jumlah_biaya = $dayanilai*$biaya;
      $ppn = $ppn*$jumlah_biaya;
      $ppj= $ppj*$jumlah_biaya;
      $total = $jumlah_biaya+$slo+$gil+$ujl+$ppn+$ppj+$tokennilai+$materai;
  
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
