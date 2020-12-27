<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\Penyambungansementara_model;

class Penyambungansementara extends Controller{
    // Main page
    public function index()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $penyambungansementaradata = new Penyambungansementara_model();
        $penyambungansementara 	  = $penyambungansementaradata->semua();

        $data = array(  'title'             => 'Penyambungan Sementara',
                        'penyambungansementara'   => $penyambungansementara,
                        'content'           => 'admin/penyambungansementara/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Delete
    public function delete($id_sambung)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        DB::table('penyambungan_sementara')->where('id',$id_sambung)->delete();
        return redirect('admin/penyambungansementara')->with(['sukses' => 'Data telah dihapus']);
    }

     // Update
     public function update($id_sambung)
     {
        date_default_timezone_set('Asia/Jakarta');
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
         DB::table('penyambungan_sementara')->where('id',$id_sambung)->update([
            'status'      => '1',
            'tgl_approve' => now(),
            ]);
         return redirect('admin/penyambungansementara')->with(['sukses' => 'Data berhasil di update']);
     }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_perbuahan       = $request->id;
            for($i=0; $i < sizeof($id_perbuahan);$i++) {
                DB::table('penyambungan_sementara')->where('id',$id_perbuahan[$i])->delete();
            }
            return redirect('admin/penyambungansementara')->with(['sukses' => 'Data telah dihapus']);
        }elseif(isset($_POST['update'])) {
            $id_perbuahan       = $request->id;
            for($i=0; $i < sizeof($id_perbuahan);$i++) {
                DB::table('penyambungan_sementara')->where('id',$id_perbuahan[$i])->update([
                    'id'    => $request->id
                ]);
            }
            return redirect('admin/penyambungansementara')->with(['sukses' => 'Data di update']);
        }
     }
}