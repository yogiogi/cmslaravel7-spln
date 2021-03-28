<?php
use Illuminate\Support\Facades\DB;
use App\Nav_model;
$site                 = DB::table('konfigurasi')->first();
// Produk
$myproduk             = new Nav_model();
$nav_kategori_produk  = $myproduk->nav_produk();
// Nav profil
$myprofil             = new Nav_model();
$nav_profil           = $myprofil->nav_profil();

// Nav panduan
$mypanduan             = new Nav_model();
$nav_panduan           = $mypanduan->nav_panduan();
?>
<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="{{ asset('/') }}"><span>
          <img src="{{ asset('public/upload/image/'.$site->logo) }}" alt="Nitrico" style="min-height: 50px; width: auto;">
        </span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="{{ asset('/') }}"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          
            <li class="active"><a href="{{ asset('/') }}">Home</a></li>
            
            <li class="drop-down"><a href=#>Profil</a>
              <ul>
                <?php foreach($nav_profil as $nav_profil) { ?>
                <li><a href="{{ asset('berita/read/'.$nav_profil->slug_berita) }}"><?php echo $nav_profil->judul_berita ?></a></li>
                <?php } ?>
              </ul>
            </li>
           
            <!-- <li class="drop-down"><a href="{{ asset('produk') }}">Produk</a>
              <ul>
                <?php foreach($nav_kategori_produk as $nkp) { ?>
                <li><a href="{{ asset('produk/kategori/'.$nkp->slug_kategori_produk) }}"><?php echo $nkp->nama_kategori_produk ?></a></li>
                <?php } ?>
                <li><a href="#"><hr style="margin: 0; padding: 0;"></a></li>
                <li><a href="{{ asset('produk') }}">Semua Produk</a></li>
              </ul>
            </li> -->

            <li class="drop-down"><a href=#>Layanan</a>
              <ul>
                <li><a href="{{ asset('pendaftaranslo') }}">Pendaftaran SLO</a></li>
                <li><a href="{{ asset('pasangbaru') }}">Pasang Baru</a></li>
                <li><a href="{{ asset('perubahandaya') }}">Perubahan Daya </a></li>
                <li><a href="{{ asset('penyambungansementara') }}">Penyambungan Sementara</a></li>
                <li><a href="{{ asset('instalasi') }}">Instalasi</a></li>
                <li><a href="{{ asset('mcbbox') }}">MCB Box</a></li>
                <li><a href="{{ asset('pengaduanteknis') }}">Pengaduan Teknis</a></li>
              </ul>
            </li>

            <li><a href="{{ asset('cekstatus') }}">Cek Status Layanan</a></li>
            <li><a href="{{ asset('pembayaran') }}">Pembayaran</a></li>

            <li class="drop-down"><a href=#>Panduan</a>
              <ul>
                <?php foreach($nav_panduan as $nav_panduan) { ?>
                <li><a href="{{ asset('berita/read/'.$nav_panduan->slug_berita) }}"><?php echo $nav_panduan->judul_berita ?></a></li>
                <?php } ?>
              </ul>
            </li>

            <li class="drop-down"><a href="#">Galeri</a>
              <ul>
                
                <li><a href="{{ asset('video') }}">Video</a></li>
                <li><a href="{{ asset('galeri') }}">Gambar</a></li>
                <li><a href="{{ asset('download') }}">Unduhan File</a></li>
              </ul>
            </li>
            <!-- <li><a href="{{ asset('kontak') }}">Kontak</a></li>
              <li>
                  <a href="{{ asset('pemesanan') }}" class="orange" title="Form Pemesanan"><div class="belanja"><i class="fa fa-shopping-cart"></i> Form Order</div></a>
              </li>
                      -->
            
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header --><!-- ======= Hero Section ======= -->