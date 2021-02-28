<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\perubahandaya_model;

class Perubahandaya extends Controller{
    // Main page
    public function index()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $perubahandayadata = new perubahandaya_model();
        $perubahandaya 	  = $perubahandayadata->semua();

        $data = array(  'title'             => 'Perubahan Daya',
                        'perubahandaya'   => $perubahandaya,
                        'content'           => 'admin/perubahandaya/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Delete
    public function delete($id_perubahan)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        DB::table('perubahan_daya')->where('id',$id_perubahan)->delete();
        return redirect('admin/perubahandaya')->with(['sukses' => 'Data telah dihapus']);
    }

     // Update
     public function update($id_perubahan)
     {
        date_default_timezone_set('Asia/Jakarta');
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
         DB::table('perubahan_daya')->where('id',$id_perubahan)->update([
            'status'      => '1',
            'tgl_approve' => now()
        ]);
         return redirect('admin/perubahandaya')->with(['sukses' => 'Data berhasil di update']);
     }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_perbuahan       = $request->id;
            for($i=0; $i < sizeof($id_perbuahan);$i++) {
                DB::table('perubahan_daya')->where('id',$id_perbuahan[$i])->delete();
            }
            return redirect('admin/perubahandaya')->with(['sukses' => 'Data telah dihapus']);
        }elseif(isset($_POST['update'])) {
            $id_perbuahan       = $request->id;
            for($i=0; $i < sizeof($id_perbuahan);$i++) {
                DB::table('perubahan_daya')->where('id',$id_perbuahan[$i])->update([
                    'id'    => $request->id
                ]);
            }
            return redirect('admin/perubahandaya')->with(['sukses' => 'Data di update']);
        }
     }
}