<section id="hero" style="color: #fff;">
  <div class="container">
    <div class="row">
        <div class="owl-carousel owl-theme">
          <?php foreach($slider as $slider) { ?>
                <div class="slideku">
                  <p class="text-center"><a href="{{ asset('galeri/detail/'.$slider->id_galeri) }}"><img src="{{ asset('public/upload/image/'.$slider->gambar) }}" class="img img-fluid" alt="<?php echo $slider->judul_galeri ?>"></a></p>
                </div>
          <?php } ?>
      </div>
    </div>
  </div>
  <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
    <defs>
      <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
    </defs>
    <g class="wave1">
      <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
    </g>
    <g class="wave2">
      <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
    </g>
    <g class="wave3">
      <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
    </g>
  </svg>
</section><!-- End Hero --><!-- Start main -->
<main id="main">

 <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-4 col-lg-6 d-flex justify-content-center align-items-stretch" data-aos="fade-right">
            <img src="{{ asset('public/upload/image/'.$site->icon) }}" alt="{{ $site->namaweb }}" class="img img-fluid img-thumbnail">
          </div>

          <div class="col-xl-8 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
            <h3>Selamat datang di {{ $site->namaweb }}</h3>
            <?php echo $site->tentang ?>

          </div>
        </div>

      </div>
      <hr>
    </section><!-- End About Section -->

 <!-- ======= Contact Section ======= -->
</main>
<script>
var owl = $('.owl-carousel');
owl.owlCarousel({
    items:1,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[1000])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
})
</script>