<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\Pendaftaranslo_model;

class Pendaftaranslo extends Controller{
    // Main page
    public function index()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $slodata = new Pendaftaranslo_model();
        $slo 	  = $slodata->semua();

        $data = array(  'title'             => 'Daftar SLO',
                        'slo'   => $slo,
                        'content'           => 'admin/pendaftaranslo/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Delete
    public function delete($id_slo)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        DB::table('pendaftaran_slo')->where('id',$id_slo)->delete();
        return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data telah dihapus']);
    }

     // Update
     public function update($id_slo)
     {
         if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
         DB::table('pendaftaran_slo')->where('id',$id_slo)->update([
            'status'      => '1',
            'tanggall_approve' => date("d/m/Y")
        ]);
         return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data berhasil di update']);
     }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_slo       = $request->id;
            for($i=0; $i < sizeof($id_slo);$i++) {
                DB::table('pendaftaran_slo')->where('id',$id_slo[$i])->delete();
            }
            return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data telah dihapus']);
        }elseif(isset($_POST['update'])) {
            $id_slo       = $request->id;
            for($i=0; $i < sizeof($id_slo);$i++) {
                DB::table('pendaftaran_slo')->where('id',$id_slo[$i])->update([
                    'id'    => $request->id
                ]);
            }
            return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data kategori telah diubah']);
        }
     }
}