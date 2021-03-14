<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\pasangbaru_model;

class Pasangbaru extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $pasangbarudata = new pasangbaru_model();
        $pasangbaru       = $pasangbarudata->semua();

        $data = array(
            'title'             => 'Pasang Baru',
            'pasangbaru'   => $pasangbaru,
            'content'           => 'admin/pasangbaru/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Delete
    public function delete($id_pasang)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('pasang_baru')->where('id', $id_pasang)->delete();
        return redirect('admin/pasangbaru')->with(['sukses' => 'Data telah dihapus']);
    }

    // Update
    public function update_bayar($id_pasang)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('pasang_baru')->where('id', $id_pasang)->update([
            'status_bayar'      => '1',
            'tgl_approve' => now()
        ]);
        return redirect('admin/pasangbaru')->with(['sukses' => 'Data berhasil di update']);
    }

    // Update bayar
    public function update($id_pasang)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('pasang_baru')->where('id', $id_pasang)->update([
            'status'      => '1',
            'tgl_approve' => now()
        ]);
        return redirect('admin/pasangbaru')->with(['sukses' => 'Data berhasil di update']);
    }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $id_pasang       = $request->id;
            for ($i = 0; $i < sizeof($id_pasang); $i++) {
                DB::table('pasang_baru')->where('id', $id_pasang[$i])->delete();
            }
            return redirect('admin/pasangbaru')->with(['sukses' => 'Data telah dihapus']);
        } elseif (isset($_POST['update'])) {
            $id_pasang       = $request->id;
            for ($i = 0; $i < sizeof($id_pasang); $i++) {
                DB::table('pasang_baru')->where('id', $id_pasang[$i])->update([
                    'id'    => $request->id
                ]);
            }
            return redirect('admin/pasangbaru')->with(['sukses' => 'Data di update']);
        }
    }
}
