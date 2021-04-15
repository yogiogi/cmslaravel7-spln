<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<?php

use Illuminate\Support\Facades\DB;

$site = DB::table('konfigurasi')->first();
?>

<script>
  $(document).ready(function() {
    $('#laravel-ajax-file-upload').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '{{ url("/konfirmasi_proses/save") }}',
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          console.log("oke coy");
          console.log(data);
          if (data == "") {
            alert('data tidak bisa kosong');
          } else if (data == "error") {
            alert('id layanan tidak terdaftar');
          } else if (data == "sukses") {
            var item = "Bukti pembayaran Anda sudah berhasil di upload, layanan Anda akan segera kami proses";
            $("#areaValue").html(item);
            $("#showModal").modal("toggle");
          } else {
            alert('Terjadi kesalahan server');
          }
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
      <div class="col-lg-12 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
        <div class="kotak">
          <div class="row">
            <div class="col-md-12 text-center">
              <h1><?php echo $title ?></h1>
              <hr>
            </div>
            <div class="col-md-12 text-left">

              <p class="text-center">Tolong baca informasi Panduan pembayaran sebelum melakukaan konfirmasi. <a href="{{ asset('pembayaran') }}">Panduan Pembayaran</a>.</p>
              <hr>
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              <form method="POST" enctype="multipart/form-data" id="laravel-ajax-file-upload" action="javascript:void(0)">
                {{ csrf_field() }}
                <input type="hidden" id="token_rahasia" value="72827582Uduagd86275gbdahgahgfa">

                <p class="alert alert-info">
                  Isi <?php echo $title ?> Anda dengan lengkap dan benar.
                </p>
                <div class="form-group row">
                  <label class="col-sm-3 control-label">Pilh Layanan</label>
                  <div class="col-sm-9">
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
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 control-label">ID Transaksi</label>
                  <div class="col-sm-9">
                    <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control" placeholder="ID transaksi">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 control-label">Pilih rekening pembayaran</label>
                  <div class="col-md-9">
                    <select name="id_rekening" id="id_rekening" class="form-control select2">
                      <?php foreach ($rekening as $rekening) { ?>
                        <option value="<?php echo $rekening->id_rekening ?>" <?php if (isset($_POST['id_rekening']) && $_POST['id_rekening'] == $rekening->id_rekening) {
                                                                                echo "selected";
                                                                              } ?>>
                          <?php echo $rekening->nama_bank ?> (<?php echo $rekening->nomor_rekening ?> a.n <?php echo $rekening->atas_nama ?>)
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-3 control-label">Cara bayar</label>
                  <div class="col-sm-9">
                    <select name="cara_bayar" class="form-control" id="cara_bayar">
                      <option value="Transfer">Transfer</option>
                      <option value="Tunai">Tunai</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 control-label">Tanggal bayar</label>
                  <div class="col-sm-9">
                    <input type="text" name="tanggal_bayar" id="tanggal_bayar" class="form-control tanggal" placeholder="dd-mm-yyyy" value="">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 control-label">Upload buktis bayar
                    <br><small class="text-gray">Format JPG, PNG, GIF. Maksimal 2 MB</small>
                  </label>
                  <div class="col-sm-9">
                    <input type="file" name="bukti" id="bukti" placeholder="Upload bukti bayar" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 control-label">Jumlah Pembayaran</label>
                  <div class="col-sm-9">
                    <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah" value="">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 control-label">Nama Pemilik Rekening</label>
                  <div class="col-sm-9">
                    <input type="text" name="pengirim" id="pengirim" class="form-control" placeholder="Nama Pemilik Rekening" value="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 control-label">Nama Bank</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama_bank_pengirim" id="nama_bank_pengirim" class="form-control" value="" placeholder="Nama Bank" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 control-label">Nomor Rekening Pembayaran</label>
                  <div class="col-sm-9">
                    <input type="text" name="nomor_rekening_pengirim" id="nomor_rekening_pengirim" class="form-control" value="" placeholder="Nomor rekening pembayaran" required>
                    <small class="text-gray">Nomor rekening yang digunakan untuk membayar</small>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 control-label">Keterangan lain</label>
                  <div class="col-sm-9">
                    <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
                    <div class="btn-group">
                      <button id="submitGO" name="submitGO" type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Data
                      </button>
                      <button type="reset" name="submit" class="btn btn-info btn-lg" value="reset">
                        <i class="fa fa-times"></i> Reset
                      </button>
                    </div>
                  </div>

              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="showModal" name="showModal" tabindex="-1" role="dialog" aria-labelledby="showmodalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Permohonan Data Berhasil</h5>
      </div>
      <div class="modal-body" id="areaValue">
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="http://spln.co.id/" role="button">OK, kembali</a>
      </div>
    </div>
  </div>
</div>