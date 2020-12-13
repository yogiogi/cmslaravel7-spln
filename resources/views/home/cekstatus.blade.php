<script>
 $(document).ready(function(){
    var nama = null;
    var alamat = null;
    var provinsi = null;
    var kabupaten = null;
    var telepon_pemohon = null;
    var ktp = null;
    var email = null;

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    var status = 0;

    function formatRupiah(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('#submitcek').on('click', function() {
      today = mm + '/' + dd + '/' + yyyy;

      $.ajax({
        type:"GET",
        url:"{{url('/cekstatus')}}",
        data: {
          id : $('#statusid').find(":selected").text(),
          layanan = $("#layanan").val(),
        },
        success:function(data){    
          var statusText="Belum disetujui";
          if(status == 1) {
            statusText="Sudah disetujui";
          }

          if (nama.value != '' && alamat.value != '' && ktp.value != '' && email.value != '' 
          && daya != ''){   
          $('.cloundcontainer').show();
          $('.cloundcontainer').empty();
          $('.cloundcontainer').append(
            "<p align='left'> Status permohonan "+ $title +"</p><br>"+
            "<p align='left'> Nama Pemohon : "+ data.nama +"</p><br>"+
            "<p align='left'> KTP : "+ data.ktp +"</p><br>"+
            "<p align='left'> Alamat : "+ data.alamat +"</p><br>"+
            "<p align='left'> Telepon : "+ data.telp +"</p><br>"+
            "<p align='left'> Email : "+ data.email +"</p><br><br>"+
            "<h2 align='left'><b> "+ statusText +" </b></h2>");
        } else {
          alert('Data tidak bisa kosong');
          $('.cloundcontainer').hide();
          $('.cloundcontainer').empty();
        }
        },
        error: function (errorThrown) {
            console.log("error " +errorThrown);
          alert('Ada masalah di server');
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
            <div class="col-md-12">
              <h1 class="text-center"><?php echo $title ?></h1>
              <hr>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-4 control-label text-right">Cek Status Layanan</label>
              <div class="col-md-8">
                <select name="layanan" id="layanan" class="form-control select2" required>
                  <option value="pendaftaran_slo" > Pendaftaran SLO </option>
                  <option value="pasang_baru" > Pasang Baru</option>
                  <option value="perubahan_daya" > Perubahan Daya </option>
                  <option value="penyambungan_semenatara" > Penyambungan Sementara </option>
                  <option value="instalasi" > Instalasi </option>
                  <option value="mcb_box" > MCB BOX </option>
                  <option value="pengaduan_teknis" > Pengaduan Teknis </option>
              </select>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-8">
                <input type="text" id="statusid" name="statusid" class="form-control" placeholder="Isi dengan kode anda" value="" required>
              </div>
            </div>

            <div class="form-group row" id="hitung">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
                  <div class="btn-group">
                  <button type="button" id="submitcek" name="submitcek" class="btn btn-primary btn-lg" value="hitung" >
                    <i class="fa fa-save"></i> cek status
                  </button>
                  </div>
                </div>
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