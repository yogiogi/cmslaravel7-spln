<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\cekstatus_model;
use App\Rekening_model;
use Carbon\Carbon;
use PDFDOM;

class kirimemail extends Controller
{
    public function index(Request $request)
    {
        $email = $request->email_hidden;
        $layanan = $request->layanan;
        $idlayanan = $request->id_layanan;

        $model  = new cekstatus_model();
        $produk = $model->singlelist($idlayanan, $layanan);
        $date = Carbon::now()->format('dmyHis');
        // $no_registrasi = $data->kodelayanan . '' . $date;
        $model      = new Rekening_model();
        $rekening   = $model->listing();

        $data = array(
            'title'     => 'PT SPLN',
            'deskripsi' => 'Formulir Pendaftaran SLO',
            'data'    => $produk,
            'date'  => $date,
            'rekening'  => $rekening,
            'content'   => 'home/cekstatus'
        );

        // share data to view
        if ($layanan == "pendaftaran_slo") {
            $pdf = PDFDOM::loadView('cetak/cetakpendaftaranslo', $data);
        } else if ($layanan == "pasang_baru") {
            $pdf = PDFDOM::loadView('cetak/cetakpasangbaru', $data);
        } else if ($layanan == "perubahan_daya") {
            $pdf = PDFDOM::loadView('cetak/cetakperubahandaya', $data);
        } else if ($layanan == "penyambungan_sementara") {
            $pdf = PDFDOM::loadView('cetak/cetakpenyambungansementara', $data);
        } else if ($layanan == "instalasi") {
            $pdf = PDFDOM::loadView('cetak/cetakinstalasi', $data);
        } else if ($layanan == "mcb_box") {
            $pdf = PDFDOM::loadView('cetak/cetakmcbbox', $data);
        } else if ($layanan == "pengaduan_teknis") {
            $pdf = PDFDOM::loadView('cetak/cetakpengaduanteknis', $data);
        }
        // download PDF file with download method
        // return $pdf->download('pdf_file');
        $pdf_file = 'public/pdf/permohonan_' . $layanan . '_' . $date . '.pdf';
        $pdf_path = $pdf_file;
        $pdf->save($pdf_path);
        // return asset($pdf_path);

        // $data["email"] = $produk->email;
        $data["title"] = "From PT S-PLN";

        Mail::send('emailku', $data, function ($message) use ($data, $pdf_file) {
            $message->to($produk->email)
                ->subject($data["title"])
                ->attach($pdf_file);
        });

        // Mail::to("masogiogi@gmail.com")->send(new splnEmail($pdf_path));

        return response($produk->email);
        // if ($value) {
        // } else {
        //     Session::flash('message', 'Username already exists.');
        // }
    }
}
