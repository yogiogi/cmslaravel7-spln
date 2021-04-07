<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\variable_model;
use App\pendaftaranslo_model;

class varpendaftaranslo extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $varmodeldata = new variable_model();
        $varmodel       = $varmodeldata->semua('var_pendaftaran_slo');

        $data = array(
            'title'           => 'Pendaftaran SLO',
            'varpendaftaranslo'   => $varmodel,
            'content'         => 'admin/varlayanan/pendaftaranslo'
        );
        return view('admin/layout/wrapper', $data);
    }

    // // Update
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_pendaftaran_slo')->where('id', $id)->update([
            'daya' => $request->daya,
            'slo' => $request->slo,
            'gil' => $request->gil,
            'ujl' => $request->ujl,
            'materai' => $request->materai,
            'biaya' => $request->biaya,
            'ppn' => $request->ppn,
            'ppj' => $request->ppj,
            'update_by' => Session()->get('username'),
            'update_date' => now(),
        ]);
        return redirect('admin/varpendaftaranslo')->with(['sukses' => 'Data berhasil di update']);
    }

    // Tambah
    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        DB::table('var_pendaftaran_slo')->insert([
            'daya' => $request->daya,
            'slo' => $request->slo,
            'gil' => $request->gil,
            'ujl' => $request->ujl,
            'materai' => $request->materai,
            'biaya' => $request->biaya,
            'ppn' => $request->ppn,
            'ppj' => $request->ppj,
            'update_by' => Session()->get('username'),
            'update_date' => now(),
        ]);
        return redirect('admin/varpendaftaranslo')->with(['sukses' => 'Data berhasil di tambah']);
    }

    // Delete
    public function delete($id_slo)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_pendaftaran_slo')->where('id', $id_slo)->delete();
        return redirect('admin/varpendaftaranslo')->with(['sukses' => 'Data telah dihapus']);
    }
}
