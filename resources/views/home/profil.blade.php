<?php
use App\Nav_model;
// Nav profil
$myprofil             = new Nav_model();
$nav_profil           = $myprofil->nav_profil();
?>

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

            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 berita">
              <div class="row">
                    <?php echo $nav_profil ?? ''->isi ?>
                </div>
            </div>
          
      </div>
    </div>
  </div>
</div>
</div>
</section><!-- End Hero -->
