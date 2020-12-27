<script>
 $(document).ready(function(){
    var idstatus = null;
    var layanan = null;

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
      console.log("id " + $('#statusid').val());
      console.log("layanan " + $("#layanan").val());
      console.log("layanan " + $('#layanan').find(":selected").text() );
      $.ajax({
        type:"GET",
        url:"{{url('cekstatus')}}",
        data: {
          id_layanan : $('#statusid').find(":selected").text(),
          layanan : $('#layanan').find(":selected").text(),
        },
        success:function(data){    
          idstatus = $('#statusid').find(":selected").text();
          layanan = $('#layanan').find(":selected").text();
          var statusText="Belum disetujui";
          if(data.status == 1) {
            statusText="Sudah disetujui";
          }

          if ( $('#statusid').val() != '' && $('#layanan').val() != ''){   
            $('.cloundcontainer').show();
            $('.cloundcontainer').empty();
            $('.cloundcontainer').append(
              "<a align='left'> Status permohonan untuk "+ $('#layanan').find(":selected").text()  +"</a><br>"+
              "<a align='left'> Nama Pemohon : "+ data.nama +"</a><br>"+
              "<a align='left'> Alamat : "+ data.alamat +"</a><br>"+
              "<a align='left'> Telepon : "+ data.telp +"</a><br>"+
              "<h2 align='left'><b> "+ statusText +" </b></h2>");
          } else if ($('#layanan').val() == 'null'){
            alert('Pilih Layanan yang ingin dicek');
            $('.cloundcontainer').hide();
            $('.cloundcontainer').empty();
          } else if($('#statusid').val() == ''){
            alert('Kode tidak bisa kosong,\nMasukkan kode yang sudah dikirimkan lewat email');
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

            <div class="col-md-8 text-left">
              <form action="" method="" accept-charset="utf-8">
                <div class="form-group row">
                    <select name="layanan" id="layanan" class="form-control select2" required>
                      <option value="null"> -- Pilih layanan yang ingin dicek -- </option>
                      <option value="pendaftaran_slo" > Pendaftaran SLO </option>
                      <option value="pasang_baru" > Pasang Baru</option>
                      <option value="perubahan_daya" > Perubahan Daya </option>
                      <option value="penyambungan_semenatara" > Penyambungan Sementara </option>
                      <option value="instalasi" > Instalasi </option>
                      <option value="mcb_box" > MCB BOX </option>
                      <option value="pengaduan_teknis" > Pengaduan Teknis </option>
                    </select>
                </div>
                <div class="form-group row">
                  <input type="text" id="statusid" name="statusid" class="form-control" placeholder="Masukkan kode layanan yang telah dikirimkan via email " value="" required>
                </div>

                <div class="form-group row" id="cekstatus">
                  <div class="btn-group">
                      <button type="button" id="submitcek" name="submitcek" class="btn btn-primary btn-lg" value="cekstatus" >
                        <i class="fa fa-save"></i> cek status
                      </button>
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