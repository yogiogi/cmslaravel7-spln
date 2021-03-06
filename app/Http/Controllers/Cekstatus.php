<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\cekstatus_model;
use App\resource_model;
use App\Rekening_model;
use Carbon\Carbon;
use PDFDOM;

class cekstatus extends Controller
{
    public function getCekstatus(Request $request)
    {
        $model = new cekstatus_model();
        $produk = $model->getCekstatus($request->id_layanan, $request->layanan);

        $resource = new resource_model();

        $villages = $resource->getvillage($produk->desa);
        $districts = $resource->getdistrict($produk->kecamatan);
        $provinces = $resource->getprovinsi($produk->provinsi);
        $regencies = $resource->getcity($produk->kabupaten);

        $data = [
            'id_layanan' => $produk->id_layanan,
            'id_transaksi' => $produk->id_transaksi,
            'kode_layanan' => $produk->kode_layanan,
            'nama_konsumen' => $produk->nama_konsumen,
            'ktp' => $produk->ktp,
            'alamat' => $produk->alamat,
            'desa' => $villages->name,
            'kecamatan' => $districts->name,
            'provinsi' => $provinces->name,
            'kabupaten' => $regencies->name,
            'telp' => $produk->telp,
            'whatsapp' => $produk->whatsapp,
            'email' => $produk->email,
            'status' => $produk->status,
            'status_bayar' => $produk->status_bayar,
            'status_layanan' => $produk->status_layanan,
            'tgl_permohonan' => $produk->tgl_permohonan,
            'tgl_approve' => $produk->tgl_approve,
        ];

        return response()->json($data);
    }

    public function cetak_pdf(Request $request)
    {
        $layanan = $request->layanan;
        $idlayanan = $request->id_layanan;

        $model  = new cekstatus_model();
        $data = $model->singlelist($idlayanan, $layanan);

        $date = Carbon::now()->format('dmyHis');
        // $no_registrasi = $data->kodelayanan . '' . $date;
        $model      = new Rekening_model();
        $rekening   = $model->listing();

        $data = array(
            'title'     => 'PT SPLN',
            'deskripsi' => 'Formulir Pendaftaran SLO',
            'data'    => $data,
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
        return asset($pdf_path);
    }
}
