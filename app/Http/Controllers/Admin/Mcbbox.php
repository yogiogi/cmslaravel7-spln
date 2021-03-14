<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\mcbbox_model;

class Mcbbox extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $mcbboxdata = new mcbbox_model();
        $mcbbox       = $mcbboxdata->semua();

        $data = array(
            'title'             => 'MCB Box',
            'mcbbox'   => $mcbbox,
            'content'           => 'admin/mcbbox/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Delete
    public function delete($id_mcb)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('mcb_box')->where('id', $id_mcb)->delete();
        return redirect('admin/mcbbox')->with(['sukses' => 'Data telah dihapus']);
    }

    // Update
    public function update($id_mcb)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('mcb_box')->where('id', $id_mcb)->update([
            'status'      => '1',
            'tgl_approve' => now(),
        ]);
        return redirect('admin/mcbbox')->with(['sukses' => 'Data berhasil di update']);
    }

    // Update bayar
    public function update_bayar($id_mcb)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('mcb_box')->where('id', $id_mcb)->update([
            'status_bayar'      => '1',
            'tgl_approve' => now(),
        ]);
        return redirect('admin/mcbbox')->with(['sukses' => 'Data berhasil di update']);
    }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $id_mcb       = $request->id;
            for ($i = 0; $i < sizeof($id_mcb); $i++) {
                DB::table('mcb_box')->where('id', $id_mcb[$i])->delete();
            }
            return redirect('admin/mcbbox')->with(['sukses' => 'Data telah dihapus']);
        } elseif (isset($_POST['update'])) {
            $id_mcb       = $request->id;
            for ($i = 0; $i < sizeof($id_mcb); $i++) {
                DB::table('mcb_box')->where('id', $id_mcb[$i])->update([
                    'id'    => $request->id
                ]);
            }
            return redirect('admin/mcbbox')->with(['sukses' => 'Data di update']);
        }
    }
}
