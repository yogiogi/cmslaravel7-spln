<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Produk_model;
use App\Rekening_model;
use App\Berita_model;
use App\Pemesanan_model;
use App\pendaftaranslo_model;
use App\resource_model;
use PDF;

class Home extends Controller
{
    // Homepage
    public function index()
    {
        $site     = DB::table('konfigurasi')->first();
        $slider = DB::table('galeri')->where('jenis_galeri', 'Homepage')->limit(5)->orderBy('id_galeri', 'DESC')->get();
        $model     = new Produk_model();
        $produks = $model->listing();
        $news   = new Berita_model();
        $berita = $news->home();

        $data = array(
            'title'     => $site->namaweb . ' - ' . $site->tagline,
            'deskripsi' => $site->namaweb . ' - ' . $site->tagline,
            'keywords'  => $site->namaweb . ' - ' . $site->tagline,
            'slider'    => $slider,
            'site'        => $site,
            'produks'    => $produks,
            'berita'    => $berita,
            'content'   => 'home/index'
        );
        return view('layout/wrapper', $data);
    }

    // kontak
    public function kontak()
    {
        $site   = DB::table('konfigurasi')->first();
        $model  = new Produk_model();
        $produk = $model->listing();

        $data = array(
            'title'     => 'Kontak Kami: ' . $site->namaweb . ' - ' . $site->tagline,
            'deskripsi' => 'Kontak ' . $site->namaweb,
            'keywords'  => 'Kontak ' . $site->namaweb,
            'site'      => $site,
            'produk'    => $produk,
            'content'   => 'home/kontak'
        );
        return view('layout/wrapper', $data);
    }

    // pemesanan
    public function pemesanan()
    {
        $site   = DB::table('konfigurasi')->first();
        $model  = new Produk_model();
        $produk = $model->listing();

        $data = array(
            'title'     => 'Formulir Pemesanan',
            'deskripsi' => 'Formulir Pemesanan',
            'keywords'  => 'Formulir Pemesanan',
            'site'      => $site,
            'produk'    => $produk,
            'content'   => 'home/pemesanan'
        );
        return view('layout/wrapper', $data);
    }

    // pendaftaran SLO
    public function pendaftaranslo()
    {
        $site   = DB::table('konfigurasi')->first();
        $model  = new pendaftaranslo_model();
        $produk = $model->semua();

        $data = array(
            'title'     => 'Formulir Pendaftaran SLO',
            'deskripsi' => 'Formulir Pendaftaran SLO',
            'subtitle'  => 'Perhitungan Layanan Pendaftaran SLO',
            'keywords'  => 'Formulir Pendaftaran SLO',
            'site'      => $site,
            'produk'    => $produk,
            'content'   => 'home/pendaftaranslo'
        );
        return view('layout/wrapper', $data);
    }

    // pendaftaran SLO
    public function penyambungansementara()
    {
        $site   = DB::table('konfigurasi')->first();
        $hitung = new resource_model();
        $resource = $hitung->variablePerhitungan(6);

        $data = array(
            'title'     => 'Formulir Penyambungan Sementara',
            'deskripsi' => 'Formulir Penyambungan Sementara',
            'subtitle'  => 'Perhitungan Layanan Penyambungan Sementara',
            'keywords'  => 'Formulir Penyambungan Sementara',
            'site'      => $site,
            'resource'  => $resource,
            'content'   => 'home/penyambungansementara'
        );
        return view('layout/wrapper', $data);
    }

    // Pasang baru
    public function pasangbaru()
    {
        $site   = DB::table('konfigurasi')->first();

        $data = array(
            'title'     => 'Formulir Pasang Baru',
            'deskripsi' => 'Formulir Pasang Baru',
            'subtitle'  => 'Perhitungan Layanan Pasang Baru',
            'keywords'  => 'Formulir Pasang Baru',
            'site'      => $site,
            'content'   => 'home/pasangbaru'
        );
        return view('layout/wrapper', $data);
    }

    // perubahandaya SLO
    public function perubahandaya()
    {
        $site   = DB::table('konfigurasi')->first();
        $data = array(
            'title'     => 'Formulir Perubahan Daya',
            'deskripsi' => 'Formulir Perubahan Daya',
            'subtitle'  => 'Perhitungan Layanan Perubahan Daya',
            'keywords'  => 'Formulir Perubahan Daya',
            'site'      => $site,
            'content'   => 'home/perubahandaya'
        );
        return view('layout/wrapper', $data);
    }

    //instalasi
    public function instalasi()
    {
        $site   = DB::table('konfigurasi')->first();
        $data = array(
            'title'     => 'Formulir Instalasi',
            'deskripsi' => 'Formulir Instalasi',
            'subtitle'  => 'Perhitungan Layanan Instalasi',
            'keywords'  => 'Formulir Instalasi',
            'site'      => $site,
            'content'   => 'home/instalasi'
        );
        return view('layout/wrapper', $data);
    }

    //mcbbox
    public function mcbbox()
    {
        $site   = DB::table('konfigurasi')->first();
        $data = array(
            'title'     => 'Formulir MCB box',
            'deskripsi' => 'Formulir MCB box',
            'subtitle'  => 'Perhitungan Layanan MCB box',
            'keywords'  => 'Formulir MCB box',
            'site'      => $site,
            'content'   => 'home/mcbbox'
        );
        return view('layout/wrapper', $data);
    }

    //pengaduanteknis
    public function pengaduanteknis()
    {
        $site   = DB::table('konfigurasi')->first();
        $data = array(
            'title'     => 'Formulir Pengaduan Teknis',
            'deskripsi' => 'Formulir Pengaduan Teknis',
            'subtitle'  => 'Perhitungan Layanan Pengaduan Teknis',
            'keywords'  => 'Formulir Pengaduan Teknis',
            'site'      => $site,
            'content'   => 'home/pengaduanteknis'
        );
        return view('layout/wrapper', $data);
    }

    //cek status
    public function cekstatus()
    {
        $site   = DB::table('konfigurasi')->first();
        $data = array(
            'title'     => 'Cek Status Layanan',
            'deskripsi' => 'Cek Status Layanan',
            'keywords'  => 'Cek Status Layanan',
            'site'      => $site,
            'content'   => 'home/cekstatus'
        );
        return view('layout/wrapper', $data);
    }

    // Proses
    public function proses_pemesanan(Request $request)
    {
        $model  = new Produk_model();
        // insert data ke table pegawai
        $produk = $model->detail($request->id_produk);
        $pesan  = new Pemesanan_model();
        $check  = $pesan->nomor_akhir();
        if ($check) {
            $nomor_transaksi    = $check->nomor_transaksi + 1;
        } else {
            $nomor_transaksi    = 1;
        }

        if ($nomor_transaksi < 10) {
            $kode_transaksi = date('Ymd') . '000' . $nomor_transaksi;
        } elseif ($nomor_transaksi < 100) {
            $kode_transaksi = date('Ymd') . '00' . $nomor_transaksi;
        } elseif ($nomor_transaksi < 1000) {
            $kode_transaksi = date('Ymd') . '0' . $nomor_transaksi;
        } elseif ($nomor_transaksi < 1000) {
            $kode_transaksi = date('Ymd') . $nomor_transaksi;
        }
        $kd_tansaksi        = 'JWM' . $kode_transaksi;
        $token_transaksi    = Str::random(32);

        DB::table('pemesanan')->insert([
            'id_produk'         => $request->id_produk,
            'kode_transaksi'    => $kd_tansaksi,
            'token_transaksi'   => $token_transaksi,
            'tanggal_order'     => date('Y-m-d'),
            'status_pemesanan'  => 'Menunggu',
            'nomor_transaksi'   => $nomor_transaksi,
            'nama_pemesan'      => $request->nama_pemesan,
            'telepon_pemesan'   => $request->telepon_pemesan,
            'email_pemesan'     => $request->email_pemesan,
            'alamat'            => $request->alamat,
            'jumlah_produk'     => $request->jumlah_produk,
            'harga_produk'      => $produk->harga_jual,
            'total_harga'       => $request->jumlah_produk * $produk->harga_jual,
            'tanggal_pemesanan' => date('Y-m-d H:i:s'),
            'tanggal_post'      => date('Y-m-d H:i:s')
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('berhasil/' . $token_transaksi);
        // End proses
    }

    // konfirmasi
    public function berhasil($token_transaksi)
    {
        $site       = DB::table('konfigurasi')->first();
        $model      = new Pemesanan_model();
        $pemesanan  = $model->token_transaksi($token_transaksi);

        $data = array(
            'title'     => 'Pemesanan Berhasil',
            'deskripsi' => 'Pemesanan Berhasil',
            'keywords'  => 'Pemesanan Berhasil',
            'site'      => $site,
            'pemesanan' => $pemesanan,
            'content'   => 'home/berhasil'
        );
        return view('layout/wrapper', $data);
    }

    // cetak
    public function cetak($token_transaksi)
    {
        $site       = DB::table('konfigurasi')->first();
        $model      = new Pemesanan_model();
        $pemesanan  = $model->token_transaksi($token_transaksi);

        $data = array(
            'title'     => 'Cetak Pemesanan',
            'deskripsi' => 'Cetak Pemesanan Berhasil',
            'keywords'  => 'Cetak Pemesanan Berhasil',
            'site'      => $site,
            'pemesanan' => $pemesanan
        );
        $config = [
            'format' => 'A4-P', // Landscape
            // 'margin_top' => 0
        ];
        $pdf = PDF::loadview('home/cetak', $data, [], $config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        $nama_file = $pemesanan->kode_transaksi . '.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    // cetak
    public function cetakpengajuan($request)
    {
        // $model = new resource_model();
        // $idlayanan = $request[idlayanan];
        // $title = $request[title];
        // $kodelayanan = $request[kodelayanan];

        $json = dd(json_encode($request));
        $title = $json->title;
        $idlayanan = $request->idlayanan;
        $kode_layanan = $request->kodelayanan;

        switch ($kode_layanan) {
            case 21:
                $table = 'pasang_baru';
                break;

            case 22:
                $table = 'pasang_baru';
                break;

            case 31:
                $table = 'perubahan_daya';
                break;

            case 32:
                $table = 'perubahan_daya';
                break;

            case 33:
                $table = 'perubahan_daya';
                break;

            case 41:
                $table = 'penyambungan_sementara';
                break;

            case 51:
                $table = 'instalasi';
                break;

            case 61:
                $table = 'mcb_box';
                break;

            case 71:
                $table = 'pengaduan_teknis';
                break;

            case 11:
                $table = 'pendaftaran_slo';
                break;

            default:
                null;
        }

        $query = DB::table($table)
            ->select('*')
            ->where('id_layanan', $idLayanan)
            ->first();

        $data = array(
            'title'     => "test",
            'pengajuan' => $query
            // 'tgl_permohonan' => $query->tgl_permohonan,
            // 'id_layanan' => $query->id_layanan,
            // 'nama_pemohon' => $query->nama_pemohon,
            // 'alamat' => $query->alamat,
            // 'kabupaten' => $query->kabupaten,
            // 'provinsi' => $query->provinsi,
            // 'sifat_instalasi' => $query->sifat_instalasi,
            // 'biaya' => $query->biaya,
            // 'daya' => $query->daya,
            // 'slo' => $query->slo,
            // 'gil' => $query->gil,
            // 'ujl' => $query->ujl,
            // 'ppn' => $query->ppn,
            // 'ppj' => $query->ppj,
            // 'token' => $query->token,
            // 'materai' => $query->materai,
            // 'total' => $query->total,
        );
        $config = [
            'format' => 'A4-P', // Landscape
            // 'margin_top' => 0
        ];
        $pdf = PDF::loadview('home/cetak', $data, [], $config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        $nama_file = 'test.pdf';
        // $pdf->stream('my.pdf',array('Attachment'=>0));

        return $pdf->stream($nama_file, array('Attachment' => 0));
    }

    // Testimoni
    public function testimoni()
    {
    }

    // konfirmasi
    public function konfirmasi()
    {
        $site       = DB::table('konfigurasi')->first();
        $model      = new Rekening_model();
        $rekening   = $model->listing();

        if (isset($_GET['token_transaksi'])) {
            $token_transaksi = $_GET['token_transaksi'];
            $model          = new Pemesanan_model();
            $pemesanan      = $model->token_transaksi($token_transaksi);
        } else {
            $pemesanan = '';
        }

        $data = array(
            'title'     => 'Konfirmasi Pembayaran',
            'deskripsi' => 'Konfirmasi Pembayaran',
            'keywords'  => 'Konfirmasi Pembayaran',
            'site'      => $site,
            'rekening'  => $rekening,
            'pemesanan' => $pemesanan,
            'content'   => 'home/konfirmasi'
        );
        return view('layout/wrapper', $data);
    }
    public function variablePerhitungan($id)
    {
        $query = DB::table('variabel_perhitungan')
            ->select('variabel_perhitungan.*')
            ->where('variabel_perhitungan.id', $id)
            ->orderBy('id', 'DESC')
            ->first();
        return $query;
    }

    // pembayaran
    public function pembayaran()
    {
        $site       = DB::table('konfigurasi')->first();
        $model      = new Rekening_model();
        $rekening   = $model->listing();

        $data = array(
            'title'     => 'Metode Pembayaran',
            'deskripsi' => 'Metode Pembayaran',
            'keywords'  => 'Metode Pembayaran',
            'site'      => $site,
            'rekening'  => $rekening,
            'content'   => 'home/pembayaran'
        );
        return view('layout/wrapper', $data);
    }
}
