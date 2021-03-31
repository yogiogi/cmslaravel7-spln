<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\variable_model;

class varmcbbox extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $varmodeldata = new variable_model();
        $varmodel       = $varmodeldata->semua('var_mcb_box');

        $data = array(
            'title'       => 'MCB Box',
            'varmcbbox'   => $varmodel,
            'content'     => 'admin/varlayanan/mcbbox'
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
        DB::table('var_mcb_box')->where('id', $request->id)->update([
            'daya' => $request->daya,
            'harga_mcb' => $request->harga_mcb,
            'harga_lnb' => $request->harga_lnb,
            'harga_mccb' => $request->harga_mccb,
            'harga_trafo' => $request->harga_trafo,
            'mdp' => $request->mdp,
            'sdp' => $request->sdp,
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
        return redirect('admin/varmcbbox')->with(['sukses' => 'Data berhasil di update']);
    }

    // Tambah
    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        DB::table('var_mcb_box')->insert([
            'daya' => $request->daya,
            'harga_mcb' => $request->harga_mcb,
            'harga_lnb' => $request->harga_lnb,
            'harga_mccb' => $request->harga_mccb,
            'harga_trafo' => $request->harga_trafo,
            'mdp' => $request->mdp,
            'sdp' => $request->sdp,
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
        return redirect('admin/varmcbbox')->with(['sukses' => 'Data berhasil di tambah']);
    }

    // Delete
    public function delete($id_slo)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_mcb_box')->where('id', $id_slo)->delete();
        return redirect('admin/varmcbbox')->with(['sukses' => 'Data telah dihapus']);
    }
}
