<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\variable_model;

class varubahprapasca extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $varmodeldata = new variable_model();
        $varmodel       = $varmodeldata->semua('var_perubahan_daya_pra_pasca');

        $data = array(
            'title'           => 'Perubahan Daya Prabayar ke Pascabayar',
            'varprapasca'   => $varmodel,
            'content'         => 'admin/varlayanan/perubahandayaprapasca'
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
        DB::table('var_perubahan_daya_pra_pasca')->where('id', $request->id)->update([
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
        return redirect('admin/varubahprapasca')->with(['sukses' => 'Data berhasil di update']);
    }

    // Tambah
    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        DB::table('var_perubahan_daya_pra_pasca')->insert([
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
        return redirect('admin/varubahprapasca')->with(['sukses' => 'Data berhasil di tambah']);
    }
}
