<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
<script>
  $(document).ready(function(){
    $('#provincy').on('change', function() {
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
  use App\perubahandaya_model;
  use App\resource_model;

  $site = DB::table('konfigurasi')->first();
  $resource = new resource_model();
  $instalasi = $resource->sifat_instalasi();
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
              <form action="perubahandaya" method="get" accept-charset="utf-8">
                {{ csrf_field() }}
                <input type="hidden" name="token_rahasia" value="72827582Uduagd86275gbdahgahgfa">
              
                <p class="alert alert-info">
                  Isi data perubahan daya Anda dengan lengkap dan benar.
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

                    <select name="provincy" id="provincy" class="form-control select2">
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
                  <label class="col-sm-4 control-label text-right">Email</label>
                  <div class="col-sm-8">
                    <input type="email" name="email_konsumen" class="form-control" value="{{ old('email_konsumen') }}"  placeholder="Isi dengan email Anda" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Sifat Instalasi</label>
                  <div class="col-md-8">
                    <select id="layanan" name="layanan" class="form-control select2">
                    <option value="Perubahan daya prabayar ke prabayar"> Perubahan daya prabayar ke prabayar</option>
                    <option value="Perubahan daya prabayar ke pascabayar"> Perubahan daya prabayar ke pascabayar</option>
                    <option value="Perubahan daya pascabayar ke pascabayar"> Perubahan daya pascabayar ke pascabayar</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row" style="display:none">
                  <label class="col-sm-4 control-label text-right">Daya Lama</label>
                  <div class="col-md-8">
                    <select name="dayalama" id="dayalama" class="form-control select2">
                      <option>--Pilih Daya--</option>
                      @foreach($daya as $daya)
                        <option value="{{ $daya->id }}"> {{ $daya->daya }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row" style="display:none">
                  <label class="col-sm-4 control-label text-right">Daya Baru</label>
                  <div class="col-md-8">
                    <select name="dayabaru" id="dayabaru" class="form-control select2">
                      <option>--Pilih Daya--</option>
                      @foreach($daya as $daya)
                        <option value="{{ $daya->id }}"> {{ $daya->daya }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                      <div class="btn-group">
                          <button type="submit" name="submit" class="btn btn-primary btn-lg" value="login">
                            <i class="fa fa-save"></i> Hitung Biaya
                          </button>
                          <button type="reset" name="submit" class="btn btn-info btn-lg" value="reset">
                            <i class="fa fa-times"></i> Reset
                          </button>
                      </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="form-group column">
            <label class="col-sm-4 control-label">Detail Biaya</label>
            <p>
              <strong>Biaya Perubahan Daya</strong>
              <br><?php echo $layanan ?>
              <br>Detail Biaya
              <br>- Daya Baru: <?php echo $perubahan_daya->daya_baru ?>
              <br>- Daya Lama: <?php echo $perubahan_daya->daya_lama ?>
              <br>- Biaya penyambungan: <?php echo $perubahan_daya->biaya ?>
              <br>- SLO: <?php echo $perubahan_daya->slo ?>
              <br>- GIL: <?php echo $perubahan_daya->gil ?>
              @if($layanan != 'Perubahan daya prabayar ke prabayar')
              <br>- UJL: <?php echo $perubahan_daya->ujl ?>
              @endif
              <br>- PPN 10 %: <?php echo $perubahan_daya->ppn ?>
              <br>- PPJ 5%: <?php echo $perubahan_daya->ppj ?>
              <br>- Token: <?php echo $perubahan_daya->token ?>
              <br>- Materai: <?php echo $perubahan_daya->materai ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero -->