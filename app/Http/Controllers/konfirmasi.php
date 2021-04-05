<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\konfirmasi_model;
use Image;
use App\resource_model;

class konfirmasi extends Controller
{
    public function save(Request $request)
    {
        request()->validate([
            'bukti'         => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kode_transaksi = $request->input('kode_transaksi');
        $id_rekening = $request->input('id_rekening');
        $cara_bayar  = $request->input('cara_bayar');
        $tanggal_bayar = $request->input('tanggal_bayar');

        $jumlah = $request->input('jumlah');
        $pengirim = $request->input('pengirim');
        $nama_bank_pengirim = $request->input('nama_bank_pengirim');
        $nomor_rekening_pengirim = $request->input('nomor_rekening_pengirim');
        $keterangan = $request->input('keterangan');
        $getId = konfirmasi_model::getValue($kode_transaksi);

        if ($getId == "0") {
            return response("id layanan tidak terdaftar");
        }

        $image                  = $request->file('bukti');
        if (!empty($image)) {
            $filenamewithextension  = $request->file('bukti')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = str_slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath        = public_path('upload/transaksi/thumbs/');
            $img = Image::make($image->getRealPath(), array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath . '/' . $input['nama_file']);
            $destinationPath = public_path('upload/image/');
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD
            $data = array(
                'id_transaksi' => $kode_transaksi,
                'id_rekening' => $id_rekening,
                'cara_bayar' => $cara_bayar,
                'tgl_bayar' => $tanggal_bayar,
                'bukti_bayar' => $input['nama_file'],
                'jumlah_pembayaran' => $jumlah,
                'nama_pemilik_rek' => $pengirim,
                'nama_bank' => $nama_bank_pengirim,
                'nomor_rekening' => $nomor_rekening_pengirim,
                'keterangan' => $keterangan,
            );

            $value = konfirmasi_model::insertData($data);
            if ($value) {
                return response("data sukses");
            } else {
                Session::flash('message', 'Username already exists.');
            }
        }
    }
}
