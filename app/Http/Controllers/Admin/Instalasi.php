<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\Instalasi_model;

class Instalasi extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $instalasidata = new Instalasi_model();
        $instalasi       = $instalasidata->semua();

        $data = array(
            'title'             => 'Instalasi',
            'instalasi'   => $instalasi,
            'content'           => 'admin/instalasi/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Delete
    public function delete($id_instal)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('instalasi')->where('id', $id_instal)->delete();
        return redirect('admin/instalasi')->with(['sukses' => 'Data telah dihapus']);
    }

    // Update
    public function update($id_instal)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('instalasi')->where('id', $id_instal)->update([
            'status'      => '1',
            'tgl_approve' => now(),
        ]);
        return redirect('admin/instalasi')->with(['sukses' => 'Data berhasil di update']);
    }

    // Update bayar
    public function update_bayar($id_instal)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('instalasi')->where('id', $id_instal)->update([
            'status_bayar'      => '1',
            'tanggal_bayar' => now(),
        ]);
        return redirect('admin/instalasi')->with(['sukses' => 'Data berhasil di update']);
    }

    // Update
    public function update_selesai($id_instal)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        DB::table('instalasi')->where('id', $id_instal)->update([
            'status_selesai'      => '1',
            'tanggal_selesai' => now(),
        ]);
        return redirect('admin/instalasi')->with(['sukses' => 'Data berhasil di update']);
    }


    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $id_perbuahan       = $request->id;
            for ($i = 0; $i < sizeof($id_perbuahan); $i++) {
                DB::table('instalasi')->where('id', $id_perbuahan[$i])->delete();
            }
            return redirect('admin/instalasi')->with(['sukses' => 'Data telah dihapus']);
        } elseif (isset($_POST['update'])) {
            $id_perbuahan       = $request->id;
            for ($i = 0; $i < sizeof($id_perbuahan); $i++) {
                DB::table('instalasi')->where('id', $id_perbuahan[$i])->update([
                    'id'    => $request->id
                ]);
            }
            return redirect('admin/instalasi')->with(['sukses' => 'Data sudah di update']);
        }
    }
}
