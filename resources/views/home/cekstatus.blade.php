<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="style.css">
<?php

use Illuminate\Support\Facades\DB;
use App\resource_model;

$site = DB::table('konfigurasi')->first();
$resource = new resource_model();
$layanan = $resource->layanan();
?>

<script>
  $(document).ready(function() {
    var idstatus = null;
    var layanan = null;
    var valLayanan = null;

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    var status = 0;

    function formatRupiah(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('#submitcek').on('click', function() {
      $('.cloundcontainer').show();
      $('.cloundcontainer').empty();
      $('.cloundcontainer').html("data tidak ditemukan");
      console.log("pilihLayanan " + $("#pilihLayanan").val());
      console.log("layanan " + $('#layanan').find(":selected").text());

      idstatus = $('#statusid').val();
      console.log(idstatus);

      layanan = $('#pilihLayanan').find(":selected").text();
      valLayanan = $("#pilihLayanan").val();

      if (valLayanan == "null") {
        alert('Lengkapi data terlebih dahulu');
      } else if (idstatus == "") {
        alert('Lengkapi data terlebih dahulu');
      } else {
        $.ajax({
          type: "GET",
          url: "{{url('/cekstatus/getCekstatus')}}",
          data: {
            id_layanan: $('#statusid').val(),
            layanan: $("#pilihLayanan").val(),
          },
          success: function(data) {
            console.log(data);
            var statusText = "Belum disetujui";
            if (data.status == 1) {
              statusText = "Sudah disetujui";
            }

            if ($('#statusid').val() != '' && $('#pilihLayanan').val() != '') {
              $('.cloundcontainer').show();
              $('.cloundcontainer').empty();
              var elements =
                "<p align='left'><b> Konsumen dengan data :</b></p>" +
                "<div class='row'>" +
                "<label class='col-sm-4'>Tanggal permohonan </label>" +
                "<label> :  </label>" +
                "<div class='col-sm-4 text-left'>" +
                "<label>" + data.tgl_permohonan + " </label>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<label class='col-sm-4'>ID Transaksi </label>" +
                "<label> :  </label>" +
                "<div class='col-sm-4 text-left'>" +
                "<label>" + data.id_layanan + " </label>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<label class='col-sm-4'>Nama Konsumen </label>" +
                "<label> :  </label>" +
                "<div class='col-sm-4 text-left' >" +
                "<label> " + data.nama_konsumen + " </label>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<label class='col-sm-4'>Alamat </label>" +
                "<label> :  </label>" +
                "<div class='col-sm-6 text-left'>" +
                "<label>" + data.alamat + ", Desa " + data.desa + ", " + data.kecamatan + ", " + data.kabupaten + ", " + data.provinsi + " </label>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<label class='col-sm-4'>KTP </label>" +
                "<label> :  </label>" +
                "<div class='col-sm-4 text-left' >" +
                "<label> " + data.ktp + " </label>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<label class='col-sm-4'>Telepon </label>" +
                "<label> :  </label>" +
                "<div class='col-sm-4 text-left' >" +
                "<label> " + data.telp + " </label>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<label class='col-sm-4'>Whatsapp </label>" +
                "<label> :  </label>" +
                "<div class='col-sm-4 text-left' >" +
                "<label> " + data.whatsapp + " </label>" +
                "</div>" +
                "</div>" +

                "<div class='row'>" +
                "<label class='col-sm-4'>Jenis Layanan SPLN  </label>" +
                "<label> :  </label>" +
                "<div class='col-sm-4 text-left' >" +
                "<label> <b>" + layanan + " </b></label>" +
                "</div>" +
                "</div>";

              if (data.status == 1) {
                elements += "<div class='row'>" +
                  "<label class='col-sm-4'>Tanggal Approve </label>" +
                  "<label> :  </label>" +
                  "<div class='col-sm-4 text-left' >" +
                  "<label> " + data.tgl_approve + " </label>" +
                  "</div>" +
                  "</div>";
              }

              if (data.status_bayar == 1) {
                elements += "<div class='row'>" +
                  "<label class='col-sm-4'>Tanggal Bayar </ilabel>" +
                  "<label> :  </label>" +
                  "<div class='col-sm-4 text-left' >" +
                  "<label> " + data.tanggal_bayar + " </label>" +
                  "</div>" +
                  "</div>";
              }

              elements += "<p align='left'><b> " +
                statusText +
                "</b></p>";

              if (data.status == 1 && data.status_bayar == 0 && data.status_layanan == 0) {
                elements += "<button type='submit' id='cetakReg' name='cetakReg' class='button' value='Send'>Cetak Registrasi</button>";
                elements += "<br><small><a>Permohonan Anda sudah disetujui, Mohon lakukan pembayaran dengan nomer layanan yang tersedia kami akan tunggu sampai 2x24 jam </a></small>";
              } else if (data.status == 1 && data.status_bayar == 1 && data.status_layanan == 0) {
                elements += "<br><small><a>Sudah dibayarkan, silahkan menunggu untuk layanan lebih lanjut </a></small>";
              } else if (data.status == 1 && data.status_bayar == 1 && data.status_layanan == 0) {
                elements += "<br><small><a>Sudah dibayarkan, silahkan menunggu untuk layanan lebih lanjut </a></small>";
              } else if (data.status == 1 && data.status_bayar == 1 && data.status_layanan == 1) {
                elements += "<br><small><a>Terima kasih telah mempercyakan kami, Layanan Anda sudah ditangani dengan baik oleh tim </a></small>";
              } else {
                elements += "<button type='submit' id='cetakReg' name='cetakReg' class='button' value='Send' disabled readonly>Cetak Registrasi</button>";
                elements += "<br><small><a>Permohonan Anda belum disetujui, mohon tunggu sampai 2x24 jam atau hubungi Customer Service Kami </a></small>";
              }

              $('.cloundcontainer').append(elements);
            }
          },
          error: function(errorThrown) {
            console.log("error " + errorThrown.toString);
            alert('Data tidak ditemukan');
          }
        });
      }
    });

    $('.cloundcontainer').on('click', 'button', function() {
      $.ajax({
        url: '{{ url("/cekstatus/cetak_pdf/") }}',
        type: "GET",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          id_layanan: $('#statusid').val(),
          layanan: $("#pilihLayanan").val(),
        },
        dataType: 'text',
        beforeSend: function() {
          $('#loader').addClass('display-none')
        },
        success: function(data) {
          console.log("data");
          console.log(data);
          window.location.href = data;
        },
        error: function(xhr, status, error) {
          alert('Ada masalah di server');
        },
        complete: function() {
          $('#loader').removeClass('display-none')
        },
      });
    });
  });
</script>

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
        <div class="kotak">
          <div class="row">
            <div class="col-md-12">
              <h1 class="text-center"><?php echo $title ?></h1>
              <hr>
            </div>

            <div class="col-md-8 text-left">
              <form action="" method="" accept-charset="utf-8">
                <div class="form-group row">
                  <select name="pilihLayanan" id="pilihLayanan" class="form-control select2" required>
                    <option value="null"> -- Pilih layanan yang ingin dicek -- </option>
                    <option value="pendaftaran_slo"> Pendaftaran SLO </option>
                    <option value="pasang_baru"> Pasang Baru</option>
                    <option value="perubahan_daya"> Perubahan Daya </option>
                    <option value="penyambungan_sementara"> Penyambungan Sementara </option>
                    <option value="instalasi"> Instalasi </option>
                    <option value="mcb_box"> MCB BOX </option>
                    <option value="pengaduan_teknis"> Pengaduan Teknis </option>
                  </select>
                </div>
                <div class="form-group row">
                  <input type="text" id="statusid" name="statusid" class="form-control" placeholder="Masukkan kode layanan yang telah dikirimkan via email " value="" required>
                </div>

                <div class="form-group row" id="cekstatus">
                  <div class="btn-group">
                    <button type="button" id="submitcek" name="submitcek" class="btn btn-primary btn-lg" value="cekstatus">
                      <i class="fa fa-save"></i> cek status
                    </button>
                  </div>
                </div>

              </form>
            </div>

            <div class="cloundcontainer" style="display:none; 
                   width: 100%;
                   border: 2px solid powderblue;   
                   padding: 10px;
                   margin: 5px;">

            </div>
            <div id="loader" name="loader" class="lds-dual-ring display-none overlay"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="notifModal" name="notifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="md-form">
          <p>Anda belum memilih status layanan</p>
        </div>
      </div>
    </div>
  </div>
</div>