<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\pendaftaranslo_model;

class pendaftaranslo extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $slodata = new pendaftaranslo_model();
        $slo       = $slodata->semua();

        $data = array(
            'title'             => 'Pendaftaran SLO',
            'slo'   => $slo,
            'content'           => 'admin/pendaftaranslo/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Delete
    public function delete($id_slo)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('pendaftaran_slo')->where('id', $id_slo)->delete();
        return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data telah dihapus']);
    }

    // Update
    public function update($id_slo)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('pendaftaran_slo')->where('id', $id_slo)->update([
            'status'      => '1',
            'tgl_approve' => now(),
        ]);
        return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data berhasil di update']);
    }

    // Update
    public function update_bayar($id_slo)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        DB::table('pendaftaran_slo')->where('id', $id_slo)->update([
            'status_bayar'      => '1',
            'tanggal_bayar' => now(),
        ]);
        return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data berhasil di update']);
    }

    // Update
    public function update_selesai($id_slo)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        DB::table('pendaftaran_slo')->where('id', $id_slo)->update([
            'status_selesai'      => '1',
            'tanggal_selesai' => now(),
        ]);
        return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data berhasil di update']);
    }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $id_slo = $request->input('idslonya');
            // error_log('Some message here.');
            // error_log(dd($id_slo));

            for ($i = 0; $i < count($id_slo); $i++) {
                DB::table('pendaftaran_slo')->where('id', $id_slo[$i])->delete();
            }
            return redirect('admin/pendaftaranslo')->with(['sukses' => 'Data telah dihapus']);
        }
    }
}
