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
              <form action="{{ asset('pendaftaran_slo') }}" method="post" accept-charset="utf-8">
                {{ csrf_field() }}
                <input type="hidden" name="token_rahasia" value="72827582Uduagd86275gbdahgahgfa">
              
                <p class="alert alert-info">
                  Isi data pemesanan Anda dengan lengkap dan benar.
                </p>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nama Konsumen <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="nama_konsumen" class="form-control" placeholder="Isi dengan nama konsumen" value="{{ old('nama_konsumen') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nomer KTP <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="number" name="nomer_ktp" class="form-control" placeholder="Isi dengan nomer ktp" value="{{ old('nomer_ktp') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Alamat</label>
                  <div class="col-sm-8">
                    <textarea name="alamat" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
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
                    <select name="id" class="form-control select2">
                      <?php foreach($instalasi as $instalasi) { ?>
                        <option value="<?php echo $instalasi->id ?>" <?php if(isset($_POST['id']) && $_POST['id']==$instalasi->id) { echo "selected"; }elseif(isset($_GET['id']) && $_GET['id']==$instalasi->id) { echo 'selected'; } ?>>
                          <?php echo $instalasi->intalasi ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Daya Lama</label>
                  <div class="col-md-8">
                    <select name="id" class="form-control select2">
                      <?php foreach($dayalama as $dayalama) { ?>
                        <option value="<?php echo $daya->id ?>" <?php if(isset($_POST['id']) && $_POST['id']==$daya->id) { echo "selected"; }elseif(isset($_GET['id']) && $_GET['id']==$daya->id) { echo 'selected'; } ?>>
                          <?php echo $daya->dayalama ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nomer DJK Lama <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="nomer_djk" class="form-control" placeholder="Isi nomer DJK lama anda disini" value="{{ old('nomer_djk') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Daya</label>
                  <div class="col-md-8">
                    <select name="id" class="form-control select2">
                      <?php foreach($daya as $daya) { ?>
                        <option value="<?php echo $daya->id ?>" <?php if(isset($_POST['id']) && $_POST['id']==$daya->id) { echo "selected"; }elseif(isset($_GET['id']) && $_GET['id']==$daya->id) { echo 'selected'; } ?>>
                          <?php echo $daya->daya ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
    
                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nama Badan Usaha <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="nama_badan" class="form-control" placeholder="Isi nama badan yang diberi kuasa" value="{{ old('nama_badan') }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 control-label text-right">Nomor telepon pemohon <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="telepon_pemohon" class="form-control" value="{{ old('telepon_pemohon') }}"  placeholder="Isi nomer telepon yang diberi kuasa" required>
                  </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                      <div class="btn-group">
                          <button type="submit" name="submit" class="btn btn-primary btn-lg" value="login">
                            <i class="fa fa-save"></i> Kirim pesanan
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
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero -->

