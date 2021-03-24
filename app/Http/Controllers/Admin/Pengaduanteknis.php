<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\pengaduanteknis_model;

class Pengaduanteknis extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $pengaduanteknisdata = new pengaduanteknis_model();
        $pengaduanteknis       = $pengaduanteknisdata->semua();

        $data = array(
            'title'             => 'Pengaduan Teknis',
            'pengaduanteknis'   => $pengaduanteknis,
            'content'           => 'admin/pengaduanteknis/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Delete
    public function delete($id_ngadu)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('pengaduan_teknis')->where('id', $id_ngadu)->delete();
        return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data telah dihapus']);
    }

    // Update
    public function update($id_ngadu)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('pengaduan_teknis')->where('id', $id_ngadu)->update([
            'status'      => '1',
            'tgl_approve' => now(),
        ]);
        return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data berhasil di update']);
    }

    // Update bayar
    public function update_bayar($id_ngadu)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('pengaduan_teknis')->where('id', $id_ngadu)->update([
            'status_bayar'      => '1',
            'tgl_approve' => now(),
        ]);
        return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data berhasil di update']);
    }

    // Update
    public function edit(Request $request)
    {
        print("edit");
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()->validate(['biaya' => 'required',]);
        DB::table('pengaduan_teknis')->where('id', $request->id)->update([
            'biaya'  => $request->biaya,
        ]);
        return redirect('admin/pengaduanteknis')->with(['sukses' => 'Biaya pengaduan berhasil di update']);
    }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $id_ngadu       = $request->id;
            for ($i = 0; $i < sizeof($id_ngadu); $i++) {
                DB::table('pengaduan_teknis')->where('id', $id_ngadu[$i])->delete();
            }
            return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data telah dihapus']);
        } elseif (isset($_POST['update'])) {
            $id_ngadu       = $request->id;
            for ($i = 0; $i < sizeof($id_ngadu); $i++) {
                DB::table('pengaduan_teknis')->where('id', $id_ngadu[$i])->update([
                    'id'    => $request->id
                ]);
            }
            return redirect('admin/pengaduanteknis')->with(['sukses' => 'Data di update']);
        }
    }
}
