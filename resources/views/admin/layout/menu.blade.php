<?php
use Illuminate\Support\Facades\DB;
use App\Nav_model;
$site                 = DB::table('konfigurasi')->first();
$nav_pemesanan        = DB::table('pemesanan')
            ->join('produk', 'produk.id_produk', '=', 'pemesanan.id_produk','LEFT')
            ->select('pemesanan.*', 'produk.nama_produk', 'produk.harga_jual','produk.gambar')
            ->where('pemesanan.status_pemesanan','Menunggu')
            ->orderBy('id_produk','DESC')
            ->get();
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>
      <a href="{{ asset('admin') }}" class="btn btn-sm"><i class="fa fa-tachometer-alt"></i> Dasbor</a> 
      <a href="{{ asset('/') }}" class="btn btn-sm" target="_blank"><i class="fa fa-home"></i> Beranda</a>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo Session()->get('nama'); ?> (<?php echo Session()->get('akses_level'); ?>)</span>
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item"  href="{{ asset('admin/user/edit/'.Session()->get('id_user')) }}">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Update Profile
            </a>
            <a class="dropdown-item" href="{{ asset('admin/konfigurasi') }}">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Setting Website
            </a>
            <!-- <a class="dropdown-item" href="http://localhost/nitrico/admin/activity">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Activity Log
            </a> -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
      

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Halaman Dashboard</h6>
        </div> -->
        <div class="card-body">
          <div class="table-responsive" style="min-height: 500px;">