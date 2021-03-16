<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cekstatus_model;
use App\resource_model;
use Carbon\Carbon;
use PDFDOM;

class cekstatus extends Controller
{
    public function getCekstatus(Request $request)
    {
        $model = new Cekstatus_model();
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

        $model  = new Cekstatus_model();
        $data = $model->singlelist($idlayanan, $layanan);

        $date = Carbon::now()->format('dmyHis');
        // $no_registrasi = $data->kodelayanan . '' . $date;

        $data = array(
            'title'     => 'PT SPLN',
            'deskripsi' => 'Formulir Pendaftaran SLO',
            'data'    => $data,
            'date'  => $date,
            'content'   => 'home/cekstatus'
        );

        // share data to view
        $pdf = PDFDOM::loadView('home/cetakpendaftaran', $data);

        // download PDF file with download method
        // return $pdf->download('pdf_file');
        $pdf_file = 'download.pdf';
        $pdf_path = $pdf_file;
        $pdf->save($pdf_path);
        return asset($pdf_path);
    }
}
