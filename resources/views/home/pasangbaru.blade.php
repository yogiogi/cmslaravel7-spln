<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<?php

use Illuminate\Support\Facades\DB;
use App\resource_model;

$site = DB::table('konfigurasi')->first();
$resource = new resource_model();
$layanan = $resource->layanan();
$nilaipascavar = $resource->nilaiPasangPasca();
$nilaipravar = $resource->nilaiPasangPra();

// $daya      = $resource->daya();
$provinces = $resource->provinsi();
$token = $resource->token();
?>

<script>
  $(document).ready(function() {
    $("#token").removeAttr('required');
    $("#dayapra").show();
    $("#dayapasca").hide().prop('required', false);
    $('#layanan').on('change', function() {
      if (this.value == '1') {
        $("#tokenjml").show();
        $("#token").show();
        $("#dayapra").show();
        $("#dayapasca").hide().prop('required', false);
        $("#token").prop('required', true);
      } else {
        $("#tokenjml").hide().prop('required', false);
        $("#token").hide().prop('required', false);
        $("#dayapra").hide().prop('required', false);
        $("#dayapasca").show();
        $("#token").removeAttr('required');
      }
    });
  });
</script>

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
              $("#city").empty();
              $("#city").append('<option>--Pilih Kabupaten/Kota--</option>');
              $.each(res, function(key, value) {
                $("#city").append('<option value="' + key + '">' + value + '</option>');
              });

            } else {
              $("#city").append('<option>--Pilih Kabupaten/Kota--</option>');
            }
          }
        });
      } else {
        $("#city").append('<option>--Pilih Kabupaten/Kota--</option>');
      }
    });

    $('#city').on('change', function() {
      var cityID = $(this).val();
      if (cityID) {
        $.ajax({
          type: "GET",
          url: "{{url('getDistrictList')}}?regency_id=" + cityID,
          success: function(res) {
            if (res) {
              $("#district").empty();
              $("#district").append('<option>--Pilih Kecamatan--</option>');
              $.each(res, function(key, value) {
                $("#district").append('<option value="' + key + '">' + value + '</option>');
              });

            } else {
              $("#district").append('<option>--Pilih Kecamatan--</option>');
            }
          }
        });
      } else {
        $("#district").append('<option>--Pilih Kecamatan--</option>');
      }
    });

    $('#district').on('change', function() {
      var districtID = $(this).val();
      if (districtID) {
        $.ajax({
          type: "GET",
          url: "{{url('getVillageList')}}?district_id=" + districtID,
          success: function(res) {
            if (res) {
              $("#village").empty();
              $("#village").append('<option>--Pilih Desa--</option>');
              $.each(res, function(key, value) {
                $("#village").append('<option value="' + key + '">' + value + '</option>');
              });

            } else {
              $("#village").append('<option>--Pilih Desa--</option>');
            }
          }
        });
      } else {
        $("#village").append('<option>--Pilih Desa--</option>');
      }
    });
  })
</script>

<script>
  $(document).ready(function() {
    var nama = null;
    var alamat = null;
    var provinsi = null;
    var kabupaten = null;
    var kecamatan = null;
    var desa = null;
    var telepon_pemohon = null;
    var whatsapp = null;
    var ktp = null;
    var email = null;

    var layanan = null;
    var token = 0;
    var hari = 0;
    var biaya = 0;
    var slo = 0;
    var gil = 0;
    var ppn = 0;
    var ppj = 0;
    var ujl = 0;
    var materai = 0;
    var total = 0;

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    function formatRupiah(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('#submithitung').on('click', function() {
      today = mm + '/' + dd + '/' + yyyy;

      daya = $('#dayapra').find(":selected").text();
      tokennya = $('#token').find(":selected").text();
      layanan = $("#layanan").val();
      if (layanan == "2") {
        daya = $('#dayapasca').find(":selected").text();
        tokennya = 0;
        ujl = 0;
      }
      console.log(daya);

      nama = document.getElementsByName("nama_pemohon")[0];
      ktp = document.getElementsByName("nomer_ktp")[0];
      alamat = document.getElementsByName("alamat")[0];
      provinsi = document.getElementsByName("provinsi")[0];
      kabupaten = document.getElementsByName("city")[0];
      kecamatan = document.getElementsByName("district")[0];
      desa = document.getElementsByName("village")[0];
      telepon_pemohon = document.getElementsByName("telepon_pemohon")[0];
      whatsapp = document.getElementsByName("whatsapp")[0];
      email = document.getElementsByName("email_konsumen")[0];

      if (nama.value != '' && ktp.value != '' && alamat.value != '' && provinsi.value != 0 && kabupaten.value != 0 && kecamatan.value != 0 && desa.value != 0 && email.value != '' && telepon_pemohon.value != '' && whatsapp.value != '' &&
        email.value != '' && daya.value != 0) {
        $.ajax({
          type: "GET",
          url: "{{url('/pasangbaru/perhitungan')}}",
          data: {
            layanan: layanan,
            daya: daya,
            token: tokennya,
          },
          success: function(data) {
            nama = document.getElementsByName("nama_pemohon")[0];
            ktp = document.getElementsByName("nomer_ktp")[0];
            alamat = document.getElementsByName("alamat")[0];
            provinsi = document.getElementsByName("provinsi")[0];
            kabupaten = document.getElementsByName("city")[0];
            kecamatan = document.getElementsByName("district")[0];
            desa = document.getElementsByName("village")[0];
            telepon_pemohon = document.getElementsByName("telepon_pemohon")[0];
            whatsapp = document.getElementsByName("whatsapp")[0];
            email = document.getElementsByName("email_konsumen")[0];

            layanan = $('#layanan').find(":selected").text();
            daya = $('#daya').find(":selected").text();

            biaya = data.biaya;
            slo = data.slo;
            gil = data.gil;
            ujl = data.ujl;

            ppn = data.ppn;
            ppj = data.ppj;

            materai = data.materai;
            total = data.total;

            if (nama.value != '' && alamat.value != '' && ktp.value != '' && email.value != '' &&
              daya.value != '') {
              $('.cloundcontainer').show();
              $('.cloundcontainer').empty();
              var elements = "<h2 align='center'> <?php echo $subtitle ?> </h2>" +
                "<table>" +
                "<tr align='left'>" +
                "<th align='left' width='50%'> Layanan " + layanan + "</th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='50%'> Daya </th>" +
                "<th align='left' width='50%'> : " + daya + " Watt </th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='50%'> Token </th>" +
                "<th align='left' width='50%'> : Rp " + formatRupiah(tokennya) + " </th>" +
                "</tr>" +
                "</table>" +
                "<br>" +
                "<table>" +
                "<tr align='left'>" +
                "<th align='left' width='75%'> Detail Biaya </th>" +
                "<th align='left' width='25%'></th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='75%'> - Rupiah Biaya Pasang Baru </th>" +
                "<th align='left' width='25%'> : Rp " + formatRupiah(biaya) + "</th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='75%'> - SLO </th>" +
                "<th align='left' width='25%'> : Rp " + formatRupiah(slo) + "</th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='75%'> - GIL </th>" +
                "<th align='left' width='25%'> : Rp " + formatRupiah(gil) + "</th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='75%'> - PPN (10%*a) </th>" +
                "<th align='left' width='25%'> : Rp " + formatRupiah(ppn) + "</th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='75%'> - PPJ (5%*a) </th>" +
                "<th align='left' width='25%'> : Rp " + formatRupiah(ppj) + "</th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='75%'> - UJL </th>" +
                "<th align='left' width='25%'> : Rp " + formatRupiah(ujl) + "</th>" +
                "</tr>" +
                "<tr align='left'>" +
                "<th align='left' width='75%'> - Materai </th>" +
                "<th align='left' width='25%'> : Rp " + formatRupiah(materai) + "</th>" +
                "</tr>" +
                "</table>" +
                "<br>" +
                "<p align='left'><b> Estimasi total biaya yang harus dibayar : Rp " + formatRupiah(total) + "</b></p>" +
                "<p align='left'> Hasil perhitungan mengacu pada ketentuan tarif tenaga listrik dan peraturan perpajakan yang berlaku hari ini (" + today + ")</p>" +
                "<br>" +
                "<p>Perhatian :</p>" +
                "<ul>" +
                "<li>Pastikan semua data yang Anda isi di atas adalah benar</li>" +
                "<li>Setelah Anda tekan tombol Simpan Permohonan, maka data-data akan diproses oleh PT SPLN (Persero) dan akan dipertanggung jawabkan apabila di kemudian hari ditemukan kesalahan</li>" +
                "</ul>" +
                "<table>" +
                "<tr>" +
                "<td><input type='checkbox' id='checkKetentuan' name='checkKetentuan' value='ketentuan' disabled readonly></td>" +
                "<td><label style='font-size:11px;'> Saya bersedia mengikuti ketentuan yang berlaku di PT SPLN </label><label data-toggle='modal' data-target='#ketentuanModal' style='font-size:11px; padding-left:5px '><b> <u>Ketentuan & Persyaratan </u></b></label></td>" +
                "</tr>" +
                "</table>" +
                "<button type='button' name='submit_btn' class='btn btn-info' id='submit_btn' value='Send' data-toggle='modal' data-target='#attentionModal' disabled>Simpan Permohonan</button>";
              $('.cloundcontainer').append(elements);
            } else {
              alert('Data tidak bisa kosong');
              $('.cloundcontainer').hide();
              $('.cloundcontainer').empty();
            }
          },
          error: function(errorThrown) {
            console.log("error " + errorThrown);
            alert('Ada masalah di server');
          }
        });
      } else {
        alert('Data tidak bisa kosong');
        $('.cloundcontainer').hide();
        $('.cloundcontainer').empty();
      }
    });

    $('#SetujuButton').on("click", function() {
      jQuery("#checkKetentuan").attr('checked', true);
      jQuery("#submit_btn").attr('disabled', false);
    });

    $('#saveButton').on('click', function() {
      daya = $("#dayapra").val();
      layanan = $("#layanan").val();
      tokennya = $("#token").val();
      if (layanan == "2") {
        daya = $("#dayapasca").val();
        tokennya = 0;
      }

      $.ajax({
        url: '{{ url("/pasangbaru/save") }}',
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          nama_konsumen: $("#nama_pemohon").val(),
          alamat: $("#alamat").val(),
          provinsi: $("#provinsi").val(),
          kabupaten: $("#city").val(),
          kecamatan: $("#district").val(),
          desa: $("#village").val(),
          ktp: $("#nomer_ktp").val(),
          telp: $("#telepon_pemohon").val(),
          whatsapp: $("#whatsapp").val(),
          email: $("#email_konsumen").val(),

          layanan: $("#layanan").val(),
          biaya: biaya,
          daya: daya,
          token: tokennya,
          slo: slo,
          gil: gil,
          ujl: ujl,

          ppn: ppn,
          ppj: ppj,
          materai: materai,
          total: total,
        },
        dataType: 'text',
        success: function(data) {
          var item = "Id Layanan Anda adalah " + data + ", simpan dan gunakan untuk mengecek status permohonan Anda pada halaman CEK STATUS LAYANAN ";
          $("#areaValue").html(item);
          $("#showModal").modal("toggle");
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan server');
        }
      });
    });
  });
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
              <div id="alerterror" name="alerterror" class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <form action="" accept-charset="utf-8">
                {{ csrf_field() }}
                <input type="hidden" name="token_rahasia" value="72827582Uduagd86275gbdahgahgfa">

                <p class="alert alert-info">
                  Isi <?php echo $title ?> Anda dengan lengkap dan benar.
                </p>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Nama Pemohon</label>
                  <div class="col-sm-10">
                    <input type="text" id="nama_pemohon" name="nama_pemohon" class="form-control" placeholder="Isi dengan nama pemohon" value="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Alamat</label>
                  <div class="col-sm-10">
                    <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required value=""></textarea>
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
                    <select name="city" id="city" class="form-control select2" required>
                      <option>--Pilih Kabupaten/Kota--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Kecamatan</label>
                  <div class="col-sm-4">
                    <select name="district" id="district" class="form-control select2" required>
                      <option>--Pilih Kecamatan--</option>
                    </select>
                  </div>

                  <label class="col-sm-2 control-label text-right">Desa</label>
                  <div class="col-sm-4">
                    <select name="village" id="village" class="form-control select2" required>
                      <option>--Pilih Desa--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Nomer KTP </label>
                  <div class="col-sm-10">
                    <input type="number" min="0" id="nomer_ktp" name="nomer_ktp" class="form-control" placeholder="Isi dengan nomer ktp" value="{{ old('nomer_ktp') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">No. Telepon </label>
                  <div class="col-sm-4">
                    <input type="number" min="0" id="telepon_pemohon" name="telepon_pemohon" class="form-control" placeholder="Isi nomer telepon pemohon" value="{{ old('nomer_ktp') }}" required>
                  </div>
                  <label class="col-sm-2 control-label text-right">No. Whatsapp </label>
                  <div class="col-sm-4">
                    <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="Isi nomer whatsapp pemohon" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Email</label>
                  <div class="col-sm-10">
                    <input type="email" id="email_konsumen" name="email_konsumen" class="form-control" value="{{ old('email_konsumen') }}" placeholder="Isi dengan email Anda" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Layanan</label>
                  <div class="col-md-10">
                    <select id="layanan" name="layanan" class="form-control select2">
                      @foreach($layanan as $layanan)
                      <option value="{{ $layanan->id }}"> {{ $layanan->layanan }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 control-label text-right">Daya (Va)</label>
                  <div class="col-sm-4">
                    <select id="dayapra" name="dayapra" class="form-control select2">
                      <option>--Pilih Daya--</option>
                      @foreach($nilaipravar as $daya)
                      <option value="{{ $daya->id }}"> {{ $daya->daya }}</option>
                      @endforeach
                    </select>

                    <select id="dayapasca" name="dayapasca" class="form-control select2">
                      <option>--Pilih Daya--</option>
                      @foreach($nilaipascavar as $daya)
                      <option value="{{ $daya->id }}"> {{ $daya->daya }}</option>
                      @endforeach
                    </select>
                  </div>

                  <label id="tokenjml" name="tokenjml" class="col-sm-2 control-label text-right">token </label>
                  <div class="col-sm-4">
                    <select id="token" name="token" class="form-control select2">
                      <option value="0">--Pilih Token--</option>
                      @foreach($token as $token)
                      <option value="{{ $token->id }}"> {{ $token->token }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row" id="hitung">
                  <label class="col-sm-4 control-label"></label>
                  <div class="col-sm-8">
                    <div class="btn-group">
                      <button type="button" id="submithitung" name="submithitung" class="btn btn-primary btn-lg" value="hitung">
                        <i class="fa fa-save"></i> Hitung Biaya
                      </button>
                      <button type="reset" class="btn btn-info btn-lg" value="reset">
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
<div class="modal fade" id="ketentuanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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


<div class="modal fade" id="attentionModal" name="attentionModal" tabindex="-1" role="dialog" aria-labelledby="perhatianModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="perhatianModal">Perhatian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="md-form">
          <p>Anda yakin data-data tersebut telah benar?</p>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Ya, simpan</button> -->
        <button id="saveButton" name="saveButton" type="button" class="btn btn-primary" data-dismiss="modal">Ya, Simpan</button>
        <button class="btn btn-secondary" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="showModal" name="showModal" tabindex="-1" role="dialog" aria-labelledby="showmodalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Permohonan Data Berhasil</h5>
      </div>
      <div class="modal-body" id="areaValue">
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="http://spln.co.id/cekstatus" role="button">Cek Layanan</a>
        <a class="btn btn-primary" href="http://spln.co.id/" role="button">Home</a>
      </div>
    </div>
  </div>
</div>