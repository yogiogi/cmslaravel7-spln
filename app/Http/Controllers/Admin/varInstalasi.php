<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\variable_model;

class varinstalasi extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $varmodeldata = new variable_model();
        $varmodel       = $varmodeldata->semua('var_instalasi');

        $data = array(
            'title'           => 'Instalasi',
            'varinstalasi'   => $varmodel,
            'content'         => 'admin/varlayanan/instalasi'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Update
    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_instalasi')->where('id', $request->id)->update([
            'daya' => $request->daya,
            'lampu' => $request->lampu,
            'saklar' => $request->saklar,
            'stopkontak' => $request->stopkontak,
            'hargameter' => $request->hargameter,
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
        return redirect('admin/varinstalasi')->with(['sukses' => 'Data berhasil di update']);
    }

    // Tambah
    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        DB::table('var_instalasi')->insert([
            'daya' => $request->daya,
            'lampu' => $request->lampu,
            'saklar' => $request->saklar,
            'stopkontak' => $request->stopkontak,
            'hargameter' => $request->hargameter,
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
        return redirect('admin/varinstalasi')->with(['sukses' => 'Data berhasil di tambah']);
    }

    // Delete
    public function delete($id_slo)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_instalasi')->where('id', $id_slo)->delete();
        return redirect('admin/varinstalasi')->with(['sukses' => 'Data telah dihapus']);
    }
}
