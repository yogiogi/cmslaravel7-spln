<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\variable_model;

class Variable extends Controller
{
    // Main page
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $myvariable  = new variable_model();
        $site           = $myvariable->listing();

        $data = array(
            'title'        => 'Data Variable Perhitungan',
            'site'         => $site,
            'content'      => 'admin/konfigurasi/variable'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Proses
    public function proses(Request $request)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('variabel_perhitungan')->where('id', $request->id_variable)->update([
            'slo'       => $request->slo,
            'slo'       => $request->slo,
            'slo'       => $request->slo,
            'slo'       => $request->slo,
            'slo'       => $request->slo,
            'gil'       => $request->gil,
            'ujl'       => $request->ujl,
            'materai'   => $request->materai,
            'biaya'     => $request->biaya,
            'ppn'       => $request->ppn,
            'ppj'       => $request->ppj,
            'update_by'   => Session()->get('id_user'),
        ]);
        return redirect('admin/variable')->with(['sukses' => 'Data telah diupdate']);
    }

    public function varLayanan(Request $request)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $query = DB::table('variabel_perhitungan')
            ->select('variabel_perhitungan.*')
            ->where('variabel_perhitungan.id', $request->id)
            ->first();
        return response()->json($query);
    }

    public function layananNya(Request $request)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $listVar = new variable_model();
        $variable = $listVar->listVariable($request->tabel);

        $data = array(
            'variableList' => $variable,
        );
        return view('admin/layout/wrapper', $data);
    }

    public function updinstall(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_instalasi')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'lampu'      => $request->lampu,
            'saklar'      => $request->saklar,
            'stopkontak'      => $request->stopkontak,
            'hargameter'      => $request->hargameter,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/instalasi')->with(['sukses' => 'Data berhasil di update']);
    }




    public function updpasangpasca(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_pasang_baru_pascabayar')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/pasangbarupasca')->with(['sukses' => 'Data berhasil di update']);
    }

    public function updpasangpra(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_pasang_baru_prabayar')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/pasangbaruprabayar')->with(['sukses' => 'Data berhasil di update']);
    }

    public function upddaftarslo(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_pendaftran_slo')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/pendaftarnslo')->with(['sukses' => 'Data berhasil di update']);
    }

    public function updaduteknis(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_pengaduan_teknis')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/pengaduanteknis')->with(['sukses' => 'Data berhasil di update']);
    }

    public function updsambungsementara(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_penyambungan_sementara')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/penyambungansementara')->with(['sukses' => 'Data berhasil di update']);
    }

    public function updubahpascapasca(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_perubahan_daya_pasca_pasca')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/perubahandayapascapasca')->with(['sukses' => 'Data berhasil di update']);
    }

    public function updubahprapasca(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_perubahan_daya_pra_pasca')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/perubahandayaprapasca')->with(['sukses' => 'Data berhasil di update']);
    }

    public function updprapra(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('var_perubahan_daya_pra_pra')->where('id', $request->id)->update([
            'daya'      => $request->daya,
            'slo'      => $request->slo,
            'gil'      => $request->gil,
            'ujl'      => $request->ujl,
            'biaya'    => $request->biaya,
            'materai'  => $request->materai,
            'ppn'      => $request->ppn,
            'ppj'      => $request->ppj,
            'tgl_approve' => now(),
        ]);
        return redirect('admin/varLayanan/perubahandayaprapra')->with(['sukses' => 'Data berhasil di update']);
    }
}
