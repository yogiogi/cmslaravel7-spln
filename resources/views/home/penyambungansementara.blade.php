<?php

use Carbon\Carbon;
?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<script>
  $(document).ready(function() {
    $('.dateStart').datepicker({
      format: 'mm-dd-yyyy'
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.dateEnd').datepicker({
      format: 'mm-dd-yyyy'
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#provincy').on('change', function() {
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
    var ktp = null;
    var email = null;

    var jammulai = null;
    var jamakhir = null;
    var jam = null;

    var harimulai = null;
    var hariakhir = null;
    varihari = null;
    var biaya = null;
    var ppn = null;
    var ppj = null;
    var materai = null;
    var total = null;
    var menit = null;
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    function formatRupiah(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('#submithitung').on('click', function() {

      today = mm + '/' + dd + '/' + yyyy;

      $.ajax({
        type: "GET",
        url: "{{url('/penyambungansementara/perhitungan')}}",
        data: {
          jam_nyala: $("#jam_nyala").val(),
          hari_nyala: $('#hari_nyala').find(":selected").text(),
        },
        success: function(data) {
          nama = document.getElementsByName("nama_pemohon")[0];
          ktp = document.getElementsByName("nomer_ktp")[0];
          alamat = document.getElementsByName("alamat")[0];
          provinsi = document.getElementsByName("provinsi")[0];
          kabupaten = document.getElementsByName("city")[0];
          email = document.getElementsByName("email_konsumen")[0];

          jammulai = document.getElementsByName("jammulai")[0];
          jamakhir = document.getElementsByName("jamakhir")[0];
          harimulai = document.getElementsByName("datestart")[0];
          hariakhir = document.getElementsByName("dateend")[0];

          console.log('harimulai');
          console.log(harimulai.value);
          console.log('hariakhir');
          console.log(hariakhir.value);

          console.log("jam mulainya");
          console.log(jammulai.value);

          console.log("jam akhirnya");
          console.log(jamakhir.value);

          // var timeArray = jammulai.split(".");
          // timeArray = parseInt(timeArray[0] * 60) + parseInt(timeArray[1]);
          // console.log(timeArray);

          if (harimulai.value == hariakhir.value) {
            console.log('oke');
            // jam = Math.abs(jamakhir.value - jammulai.value);


            // var d1 = new Date();
            // var d2 = new Date("2011/10/11")
            // var diff = ;
            // console.log(jam);

            var hoursmulai = Number(jammulai.value.match(/^(\d+)/)[1]);
            hoursmulai = hoursmulai * 60;
            var minmulai = Number(jammulai.value.match(/:(\d+)/)[1]);
            minmulai = hoursmulai + minmulai;

            console.log(minmulai);

            var hoursakhir = Number(jamakhir.value.match(/^(\d+)/)[1]);
            hoursakhir = hoursakhir * 60;
            var minakhir = Number(jamakhir.value.match(/:(\d+)/)[1]);
            minakhir = hoursakhir + minakhir;
            console.log(minakhir);

            menit = minakhir - minmulai;
            console.log("menit");
            console.log(menit);
            console.log(menit / 60);

          } else if (harimulai.value < hariakhir.value) {
            var date1 = new Date(harimulai + "  " + jammulai);
            var date2 = new Date(hariakhir + " " + jamakhir);

            var second = 1000,
              minute = second * 60,
              hour = minute * 60,
              day = hour * 24,
              week = day * 7;
            fromDate = new Date(fromDate);
            toDate = new Date(toDate);
            var timediff = toDate - fromDate;

            if (isNaN(timediff)) return NaN;
            switch (interval) {
              case "years":
                return toDate.getFullYear() - fromDate.getFullYear();
              case "months":
                return (
                  (toDate.getFullYear() * 12 + toDate.getMonth()) -
                  (fromDate.getFullYear() * 12 + fromDate.getMonth())
                );
              case "weeks":
                return Math.floor(timediff / week);
              case "days":
                return Math.floor(timediff / day);
              case "hours":
                return Math.floor(timediff / hour);
              case "minutes":
                return Math.floor(timediff / minute);
              case "seconds":
                return Math.floor(timediff / second);
              default:
                return undefined;
            }
          }
          // console.log('jammulai');
          // console.log(jammulai.value);
          // console.log('jamakhir');
          // console.log(jamakhir.value);
          console.log('jam');
          console.log(jam);

          biaya = data.biaya;
          ppn = data.ppn;
          ppj = data.ppj;
          materai = data.materai;
          total = data.total;

          if (nama.value != '' && alamat.value != '' && ktp.value != '' && email.value != '') {
            $('.cloundcontainer').show();
            $('.cloundcontainer').empty();
            $('.cloundcontainer').append(
              "<h2 align='center'> Penyambungan Sementara </h2>" +
              "<table>" +
              "<tr align='left'>" +
              "<th align='left' width='75%'> Detail Biaya </th>" +
              "<th align='left' width='25%'></th>" +
              "</tr>" +
              "<tr align='left'>" +
              "<th align='left' width='75%'> a. Rupiah Biaya Penyambungan</th>" +
              "<th align='left' width='25%'> : Rp " + formatRupiah(biaya) + "</th>" +
              "</tr>" +
              "<tr align='left'>" +
              "<th align='left' width='75%'> b. PPN (10%*a) </th>" +
              "<th align='left' width='25%'> : Rp " + formatRupiah(ppn) + "</th>" +
              "</tr>" +
              "<tr align='left'>" +
              "<th align='left' width='75%'> c. PPJ (5%*a) </th>" +
              "<th align='left' width='25%'> : Rp " + formatRupiah(ppj) + "</th>" +
              "</tr>" +
              "<tr align='left'>" +
              "<th align='left' width='75%'> d. Materai </th>" +
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
              "<button type='submit' name='submit_btn' class='button' id='submit_btn' value='Send' disabled>Simpan Permohonan</button>");
          } else {
            alert('Data tidak bisa kosong');
            $('.cloundcontainer').hide();
            $('.cloundcontainer').empty();
          }
        },
        error: function(errorThrown) {
          console.log("error " + errorThrown);
          alert('Data tidak bisa kosong');
        }
      });
    });

    $('#SetujuButton').on("click", function() {
      jQuery("#checkKetentuan").attr('checked', true);
      jQuery("#submit_btn").attr('disabled', false);
    });

    $('.cloundcontainer').on('click', 'button', function() {
      $.ajax({
        url: '{{ url("/penyambungansementara/save") }}',
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          nama_konsumen: $("#nama_pemohon").val(),
          ktp: $("#nomer_ktp").val(),
          alamat: $("#alamat").val(),
          provinsi: $("#provincy").val(),
          kabupaten: $("#city").val(),
          kecamatan: $("#district").val(),
          desa: $("#village").val(),
          telp: $("#telepon_pemohon").val(),
          whatsapp: $("#whatsapp").val(),
          email: $("#email_konsumen").val(),

          jam_nyala: $("#jam_nyala").val(),
          hari_nyala: $("#hari_nyala").val(),

          biaya: biaya,
          ppn: ppn,
          ppj: ppj,
          materai: materai,
          total: total,

        },
        dataType: 'text',
        success: function(data) {
          window.location.href = "http://localhost/cmslaravel7-spln/"
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan server');
        }
      });
    });
  });
</script>

<?php

use Illuminate\Support\Facades\DB;
use App\penyambungansementara_model;
use App\resource_model;

$site = DB::table('konfigurasi')->first();
$resource = new resource_model();
$provinces = $resource->provinsi();
?>

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
        <div class="kotak">
          <div class="row">
            <div class="col-md-12 text-center">
              <h1><?php echo $title ?></h1>
              <hr>
            </div>
            <div class="col-md-10 text-left">

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
                  Isi data penyambungan sementara Anda dengan lengkap dan benar.
                </p>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nama Pemohon</label>
                  <div class="col-sm-8">
                    <input type="text" id="nama_pemohon" name="nama_pemohon" class="form-control" placeholder="Isi dengan nama pemohon" value="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nomer KTP </label>
                  <div class="col-sm-8">
                    <input type="number" id="nomer_ktp" name="nomer_ktp" class="form-control" placeholder="Isi dengan nomer ktp" value="{{ old('nomer_ktp') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nomor telepon pemohon </label>
                  <div class="col-sm-8">
                    <input type="number" id="telepon_pemohon" name="telepon_pemohon" class="form-control" value="{{ old('telepon_pemohon') }}" placeholder="Isi nomer telepon yang diberi kuasa" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nomor whatsapp pemohon </label>
                  <div class="col-sm-8">
                    <input type="number" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="Isi nomer whatsapp yang diberi kuasa" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Alamat</label>
                  <div class="col-sm-8">
                    <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required value=""></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Provinsi</label>
                  <div class="col-md-8">

                    <select name="provincy" id="provincy" class="form-control select2" required>
                      <option value="">--Pilih Provinsi--</option>
                      @foreach($provinces as $provincy)
                      <option value="{{$provincy->id}}">{{ $provincy->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Kabupaten/Kota</label>
                  <div class="col-md-8">
                    <select name="city" id="city" class="form-control select2" required>
                      <option>--Pilih Kabupaten/Kota--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Kecamatan</label>
                  <div class="col-md-8">
                    <select name="district" id="district" class="form-control select2" required>
                      <option>--Pilih Kecamatan--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Desa</label>
                  <div class="col-md-8">
                    <select name="village" id="village" class="form-control select2" required>
                      <option>--Pilih Desa--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Email</label>
                  <div class="col-sm-8">
                    <input type="email" id="email_konsumen" name="email_konsumen" class="form-control" value="{{ old('email_konsumen') }}" placeholder="Isi dengan email Anda" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">ID Pelanggan</label>
                  <div class="col-sm-8">
                    <input type="text" id="id_pelanggan" name="id_pelanggan" class="form-control" value="{{ old('id_pelanggan') }}" placeholder="Isi nomer id_pelanggan PLN" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nomer Meter</label>
                  <div class="col-sm-8">
                    <input type="text" id="no_meter" name="no_meter" class="form-control" value="{{ old('no_meter') }}" placeholder="Isi nomer Nomer Meter pelanggan" required>
                  </div>
                </div>
                <!-- 
                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Jam nyala </label>
                  <div class="col-md-8">
                    <select name="jam_nyala" id="jam_nyala" class="form-control select2" required>
                      <option value="">--Pilih jam nyala--</option>
                      <option value="12">12 jam</option>
                      <option value="24">24 jam</option>
                    </select>
                  </div>
                </div> -->

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Hari mulai nyala </label>
                  <div class="col-sm-2">
                    <input id="datestart" name="datestart" class="dateStart form-control" type="text">
                  </div>
                  <label class="control-label text-right">Hari akhir nyala </label>
                  <div class="col-sm-2">
                    <input id="dateend" name="dateend" class="dateEnd form-control" type="text">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">jam mulai nyala </label>
                  <div class="col-sm-2">
                    <input id="jammulai" name="jammulai" type="time" name="jam_mulai" id="jam_mulai" class="form-control" onkeyup="Waktumasuk();" />
                  </div>
                  <label class="control-label text-right">jam selesai nyala </label>
                  <div class="col-sm-2">
                    <input id="jamakhir" name="jamakhir" type="time" name="jam_selesai" id="jam_selesai" class="form-control" onkeyup="Waktumasuk();" />
                  </div>

                </div>

                <div class="form-group row" id="hitung">
                  <label class="col-sm-4 control-label"></label>
                  <div class="col-sm-8">
                    <div class="btn-group">
                      <button type="button" id="submithitung" name="submithitung" class="btn btn-primary btn-lg" value="hitung">
                        <i class="fa fa-save"></i> Hitung Biaya
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