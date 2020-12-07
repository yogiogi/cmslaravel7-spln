<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
  $(document).ready(function(){
    $('#provinsi').on('change', function() {
      var provinceID = $(this).val();  
      if(provinceID){
        $.ajax({
          type:"GET",
          url:"{{url('getCityList')}}?province_id="+provinceID,
          success:function(res){        
          if(res){
            $("#city").empty();
            $("#city").append('<option>--Pilih Kabupaten/Kota--</option>');
            $.each(res,function(key,value){
              $("#city").append('<option value="'+key+'">'+value+'</option>');
            });
          
          }else{
            $("#city").append('<option>--Pilih Kabupaten/Kota--</option>');
          }
          }
        });
      }else{
        $("#city").append('<option>--Pilih Kabupaten/Kota--</option>');
      }   
    });
  })
</script>

<?php
  use Illuminate\Support\Facades\DB;
  use App\resource_model;

  $site      = DB::table('konfigurasi')->first();
  $resource  = new resource_model(); 
  $daya      = $resource->daya();
  $instalasi = $resource->sifat_instalasi();
  $provinces = $resource->provinsi();
  $layanan   = $resource->layanan();
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
            <div class="col-md-8 text-left">

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
                  Isi data pengaduan teknis Anda dengan lengkap dan benar.
                </p>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nama Pemohon <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="nama_pemohon" class="form-control" placeholder="Isi dengan nama pemohon" value="{{ old('nama_pemohon') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Alamat</label>
                  <div class="col-sm-8">
                    <textarea name="alamat" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Provinsi</label>
                  <div class="col-md-8">

                    <select name="provinsi" id="provinsi" class="form-control select2">
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
                    <select name=city id="city" class="form-control select2">
                      <option>--Pilih Kabupaten/Kota--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nomer KTP <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="number" name="nomer_ktp" class="form-control" placeholder="Isi dengan nomer ktp" value="{{ old('nomer_ktp') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Telepon <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="telepon" class="form-control" placeholder="Isi dengan nomer telepon" value="{{ old('nomer_ktp') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Email</label>
                  <div class="col-sm-8">
                    <input type="email" name="email_konsumen" class="form-control" value="{{ old('email_konsumen') }}"  placeholder="Isi dengan email Anda" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Keterangan</label>
                  <div class="col-sm-8">
                    <textarea name="keterangan" class="form-control" placeholder="isi dengan keterangan pengaduan" value ="{{ old('keterangan') }}"></textarea>
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

            <div class="cloundcontainer" 
                 style= "display:none; 
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
            <li>Meter Prabayar (MPB) adalah meter energi listrik yang dipergunakan untuk mengukur energi listrik  (kWh) yang dikonsumsi oleh Pelanggan yang berfungsi setelah Pelanggan memasukkan sejumlah stroom tertentu ke dalamnya.</li>
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
            <li>Tingkat Mutu Pelayanan (TMP) adalah deskripsi kwantitatif beberapa indikator mutu pelayanan yang dinyatakan oleh PLN  secara berkala.</li>
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