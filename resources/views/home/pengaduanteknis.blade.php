<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<?php

use Illuminate\Support\Facades\DB;
use App\resource_model;

$site      = DB::table('konfigurasi')->first();
$resource  = new resource_model();
$provinces = $resource->provinsi();
?>

<script>
  $(document).ready(function() {
    $('#provinsi').on('change', function() {
      var provinceID = $(this).val();
      if (provinceID) {
        $.ajax({
          type: "GET",
          url: "{{url('getCityList')}}?province_id=" + provinceID,
          success: function(res) {
            if (res) {
              $("#kabupaten").empty();
              $("#kabupaten").append('<option>--Pilih Kabupaten/Kota--</option>');
              $.each(res, function(key, value) {
                $("#kabupaten").append('<option value="' + key + '">' + value + '</option>');
              });

            } else {
              $("#kabupaten").append('<option>--Pilih Kabupaten/Kota--</option>');
            }
          }
        });
      } else {
        $("#kabupaten").append('<option>--Pilih Kabupaten/Kota--</option>');
      }
    });

    $('#kabupaten').on('change', function() {
      var cityID = $(this).val();
      if (cityID) {
        $.ajax({
          type: "GET",
          url: "{{url('getDistrictList')}}?regency_id=" + cityID,
          success: function(res) {
            if (res) {
              $("#kecamatan").empty();
              $("#kecamatan").append('<option>--Pilih Kecamatan--</option>');
              $.each(res, function(key, value) {
                $("#kecamatan").append('<option value="' + key + '">' + value + '</option>');
              });

            } else {
              $("#kecamatan").append('<option>--Pilih Kecamatan--</option>');
            }
          }
        });
      } else {
        $("#kecamatan").append('<option>--Pilih Kecamatan--</option>');
      }
    });

    $('#kecamatan').on('change', function() {
      var districtID = $(this).val();
      if (districtID) {
        $.ajax({
          type: "GET",
          url: "{{url('getVillageList')}}?district_id=" + districtID,
          success: function(res) {
            if (res) {
              $("#desa").empty();
              $("#desa").append('<option>--Pilih Desa--</option>');
              $.each(res, function(key, value) {
                $("#desa").append('<option value="' + key + '">' + value + '</option>');
              });

            } else {
              $("#desa").append('<option>--Pilih Desa--</option>');
            }
          }
        });
      } else {
        $("#desa").append('<option>--Pilih Desa--</option>');
      }
    });
  })
</script>

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 order-1 order-lg-2 hero-img" style="margin-left: auto; margin-right: auto;" data-aos="zoom-out" data-aos-delay="300">
        <div class="kotak">
          <div class="row">
            <div class="col-md-12 text-center" style="margin-left: auto; margin-right: auto;">
              <h1><?php echo $title ?></h1>
              <hr>
            </div>
            <div class="col-md-10" style="margin-left: auto; margin-right: auto;">

              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <form action="{{asset('pengaduanteknis/save')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                {{ csrf_field() }}
                <input type="hidden" name="token_rahasia" value="72827582Uduagd86275gbdahgahgfa">

                <p class="alert alert-info">
                  Isi <?php echo $title ?> Anda dengan lengkap dan benar.
                </p>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Nama Pemohon </label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_pemohon" class="form-control" placeholder="Isi dengan nama pemohon" value="{{ old('nama_pemohon') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Alamat</label>
                  <div class="col-sm-10">
                    <textarea name="alamat" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Provinsi</label>
                  <div class="col-sm-4">
                    <select name="provinsi" id="provinsi" class="form-control select2" required>
                      <option value="">--Pilih Provinsi--</option>
                      @foreach($provinces as $provincy)
                      <option value="{{$provincy->id}}">{{ $provincy->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <label class="col-sm-2 control-label text-right">Kabupaten/Kota</label>
                  <div class="col-sm-4">
                    <select name="kabupaten" id="kabupaten" class="form-control select2" required>
                      <option>--Pilih Kabupaten/Kota--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Kecamatan</label>
                  <div class="col-sm-4">
                    <select name="kecamatan" id="kecamatan" class="form-control select2" required>
                      <option>--Pilih Kecamatan--</option>
                    </select>
                  </div>

                  <label class="col-sm-2 control-label text-right">Desa</label>
                  <div class="col-sm-4">
                    <select name="desa" id="desa" class="form-control select2" required>
                      <option>--Pilih Desa--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Nomer KTP </label>
                  <div class="col-sm-10">
                    <input type="number" name="nomer_ktp" class="form-control" placeholder="Isi dengan nomer ktp" value="{{ old('nomer_ktp') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">No. Telepon </label>
                  <div class="col-sm-4">
                    <input type="number" id="telepon" name="telepon" class="form-control" placeholder="Isi nomer telepon pemohon" value="{{ old('nomer_ktp') }}" required>
                  </div>
                  <label class="col-sm-2 control-label text-right">No. Whatsapp </label>
                  <div class="col-sm-4">
                    <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="Isi nomer whatsapp pemohon" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email_konsumen" class="form-control" value="{{ old('email_konsumen') }}" placeholder="Isi email Anda" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">ID Pelanggan</label>
                  <div class="col-sm-4">
                    <input type="number" id="id_pelanggan" name="id_pelanggan" class="form-control" placeholder="Isi ID pelanggan PLN" value="{{ old('id_pelanggan') }}" required>
                  </div>
                  <label class="col-sm-2 control-label text-right">Nomer Meter</label>
                  <div class="col-sm-4">
                    <input type="text" id="no_meter" name="no_meter" class="form-control" value="{{ old('no_meter') }}" placeholder="Isi nomer meter PLN" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Keterangan</label>
                  <div class="col-sm-10">
                    <textarea name="keterangan" class="form-control" placeholder="isi dengan keterangan pengaduan" value="{{ old('keterangan') }}"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label"></label>
                  <div class="col-sm-8">
                    <div class="btn-group">
                      <button type="submit" name="submit" class="btn btn-primary btn-lg" value="login">
                        <i class="fa fa-save"></i> Submit Pengaduan
                      </button>
                      <button type="reset" name="submit" class="btn btn-info btn-lg" value="reset">
                        <i class="fa fa-times"></i> Reset
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="cloundcontainer" style="display:none; 
                   width: 100%;
                   border: 2px solid powderblue;   
                   padding: 50px;
                   margin: 20px;">

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section><!-- End Hero -->

<!-- Modal -->
<div class="modal fade" id="ketentuanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Ketentuan Umum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="md-form">
          <p>Dalam Syarat & Ketentuan ini, pernyataan/istilah tertentu ini memiliki makna sebagai berikut:</p>
          <ol type="i">
            <li>Listrik Prabayar (LPB) adalah Produk layanan pemakaian tenaga listrik yang menggunakan meter elektronik prabayar dengan cara pembayaran dimuka.</li>
            <li>Meter Prabayar (MPB) adalah meter energi listrik yang dipergunakan untuk mengukur energi listrik (kWh) yang dikonsumsi oleh Pelanggan yang berfungsi setelah Pelanggan memasukkan sejumlah stroom tertentu ke dalamnya.</li>
            <li>Nomor Meter adalah Nomor yang tertera dalam MPB sebagai nomor identitas pada saat transaksi pembelian isi ulang dan pengaduan, yang terdiri dari 11 (sebelas) digit yang bersifat unique dan tidak sama antara meter yang satu dengan meter lainnya.</li>
            <li>Stroom adalah kode angka yang setara dengan energi listrik tertentu yang dituangkan dalam 20 (duapuluh) angka yang bersifat unique (hanya cocok untuk nomor serial meter prabayar 11 (sebelas) angka tertentu).</li>
            <li>Stroom Perdana adalah kode angka yang mewakili sejumlah tertentu energi listrik yang harus dibeli oleh Pelanggan pada saat penyambungan baru/perubahan daya dan migrasi ke prabayar.</li>
            <li>Pembelian Isi Ulang Stroom adalah pembelian kembali Stroom oleh Pelanggan yang dilakukan di tempat-tempat penerimaan pembayaran tagihan listrik.</li>
            <li>Stroom Darurat adalah Stroom penggantian yang dibeli secara langsung oleh Pelanggan di kantor PLN yang disebabkan seluruh loket penjualan Stroom setempat tidak dapat melayani transaksi pembelian Stroom.</li>
            <li>Peringatan Awal adalah sinyal yang dipancarkan oleh MPB sebagai pemberitahuan bahwa Stroom tinggal tersisa sejumlah kWh tertentu.</li>
            <li>Tenaga Listrik adalah satu bentuk energi sekunder yang dibangkitkan, ditransmisikan dan didistribusikan untuk semua keperluan oleh PLN kepada Pelanggan.</li>
            <li>Alat Pembatas dan Pengukur (APP) adalah alat milik PLN yang dipakai untuk membatasi daya lisrik dan mengukur energi listrik yang dipakai oleh Pelanggan.</li>
            <li>Instalasi PLN adalah instalasi ketenagalistrikan milik PLN sampai dengan APP.</li>
            <li>Instalasi Pelanggan adalah instalasi ketenagalistrikan milik Pelanggan sesudah APP milik PLN.</li>
            <li>Tingkat Mutu Pelayanan (TMP) adalah deskripsi kwantitatif beberapa indikator mutu pelayanan yang dinyatakan oleh PLN secara berkala.</li>
            <li>Penertiban Pemakaian Tenaga Listrik (P2TL) adalah pemeriksaan yang dilakukan oleh PLN terhadap Instalasi PLN dan/atau Instalasi Pelanggan.</li>
          </ol>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="SetujuButton" type="button" class="btn btn-primary" data-dismiss="modal">Setuju</button>
      </div>
    </div>
  </div>
</div>