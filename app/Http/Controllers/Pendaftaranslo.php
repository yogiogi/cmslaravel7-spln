<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Pendaftaranslo_model;
use Illuminate\Support\Str;

class Pendaftaranslo extends Controller
{
    // Tambah
    public function saveSLO(Request $request){
      $kodelayanan = DB::table('variabel_perhitungan')
            ->select('variabel_perhitungan.*')
            ->where('variabel_perhitungan.id', '1')
            ->first()->{'unique_id'};

      // $id_unique = unique_code(4);
      $uniqid = Str::random(5);

      $id_layanan = $kodelayanan.''. $uniqid.''.$request->input('city');
      //kodekuhusus+idkabupaten+uniquecode
      if ($request->input('submit') != null ){
            $nama_konsumen = $request->input('nama_konsumen');
            $ktp = $request->input('nomer_ktp');
            $alamat = $request->input('alamat');
            $provinsi = $request->input('provincy');
            $kabupaten = $request->input('city');
            $telp = $request->input('telepon_pemohon');
            $email = $request->input('email_konsumen');
            $instalasi = $request->input('sifat_instalasi');

            $dayalama = $request->input('dayalama');
            $djklama = $request->input('nomer_djk');

            $daya = $request->input('dayabaru');
            $badan_usaha = $request->input('nama_badan');
            $status = 0;
    
            if($nama_konsumen !='' && $ktp !='' && $alamat != ''){
            if($instalasi == 2){
                $data = array(
                    'id_layanan'=>$id_layanan,
                    'nama_konsumen'=>$nama_konsumen,
                    'ktp'=>$ktp,
                    'alamat'=>$alamat,
                    'provinsi'=>$provinsi,
                    'kabupaten'=>$kabupaten,
                    'telp'=>$telp,
                    'email'=>$email,
                    'instalasi'=>$instalasi,
                    'dayalama'=>$dayalama,
                    'daya'=>$daya,
                    'djklama'=>$djklama,
                    'badan_usaha'=>$badan_usaha,
                    'status'=>$status,
                );
            } else {
                $data = array(
                    'id_layanan'=>$id_layanan,
                    'nama_konsumen'=>$nama_konsumen,
                    'ktp'=>$ktp,
                    'alamat'=>$alamat,
                    'provinsi'=>$provinsi,
                    'kabupaten'=>$kabupaten,
                    'telp'=>$telp,
                    'email'=>$email,
                    'instalasi'=>$instalasi,
                    'daya'=>$daya,
                    'badan_usaha'=>$badan_usaha,
                    'status'=>$status,
                );
            }
            
                error_log('submit data.');

                // Insert
                $value = Pendaftaranslo_model::insertData($data);
                if($value){
                  Session::flash('message','Insert successfully.');
                }else{
                  Session::flash('message','Username already exists.');
                }
             }
          }
        return redirect()->action('Home@index');
      }

    public function statusslo(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        DB::table('kategori_produk')->where('id',$request->id_pendaftaran)->update([
            'tanggal_approve'   => $request->urutan,
            'status'            => $request->keterangan
        ]);
        return redirect('admin/kategori_produk')->with(['sukses' => 'Data telah diupdate']);
    }

   


}