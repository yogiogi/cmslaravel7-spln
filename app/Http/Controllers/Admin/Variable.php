<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\variable_model;

class Variable extends Controller
{
    // Main page
    public function index()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myvariable  = new variable_model();
        $site           = $myvariable->listing();

        $data = array(  'title'        => 'Data Variable Perhitungan',
                        'site'         => $site,
                        'content'      => 'admin/konfigurasi/variable'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses
    public function proses(Request $request)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        // request()->validate([
        //     'slo'          => 'required',
        //     'gil'          => 'required',
        //     'ujl'          => 'required',
        //     'slo'          => 'required',
        //     'materai'          => 'required',
        //     'biaya'          => 'required',
        //     'ppn'          => 'required',
        //     'ppj'          => 'required',
        //     ]);
        DB::table('variabel_perhitungan')->where('id',$request->id_variable)->update([
            'slo'       => $request->slo,
            'gil'       => $request->gil,
            'ujl'       => $request->ujl,
            'materai'   => $request->materai,
            'biaya'     => $request->biaya,
            'ppn'       => $request->ppn,
            'ppj'       => $request->ppj,
            'id_user'   => Session()->get('id_user'),
        ]);
        return redirect('admin/variable')->with(['sukses' => 'Data telah diupdate']);
    }

    public function varLayanan(Request $request)
    {
        $query = DB::table('variabel_perhitungan')
            ->select('variabel_perhitungan.*')
            ->where('variabel_perhitungan.id',$request->id)
            ->first();
        return response()->json($query);
    }
}