<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\pengaduanteknis_model;

class Pengaduanteknis extends Controller{
    // Main page
    public function index()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $pengaduanteknisdata = new pengaduanteknis_model();
        $pengaduanteknis 	  = $pengaduanteknisdata->semua();

        $data = array(  'title'             => 'Penyambungan Sementara',
                        'pengaduanteknis'   => $pengaduanteknis,
                        'content'           => 'admin/pengaduanteknis/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Delete
    public function delete($id_ngadu)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        DB::table('pengaduan_teknis')->where('id',$id_ngadu)->delete();
        return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data telah dihapus']);
    }

     // Update
     public function update($id_ngadu, $aduan)
     {
         if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
         DB::table('pengaduan_teknis')->where('id',$id_ngadu)->update([
            'status'      => '1',
            'keterangan'  => $aduan,
            'tgl_approve' => date("d/m/Y")
        ]);
         return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data berhasil di update']);
     }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_ngadu       = $request->id;
            for($i=0; $i < sizeof($id_ngadu);$i++) {
                DB::table('pengaduan_teknis')->where('id',$id_ngadu[$i])->delete();
            }
            return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data telah dihapus']);
        }elseif(isset($_POST['update'])) {
            $id_ngadu       = $request->id;
            for($i=0; $i < sizeof($id_ngadu);$i++) {
                DB::table('pengaduan_teknis')->where('id',$id_ngadu[$i])->update([
                    'id'    => $request->id
                ]);
            }
            return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data di update']);
        }
     }
}