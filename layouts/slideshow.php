<!-- Slider main container -->
<div class="swiper">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <div class="swiper-slide">
        <a href="shop.php">
            <img src="assets/images/banner/banner-3.png" alt="">
        </a>
    </div>
    <div class="swiper-slide">
        <a href="shop.php">
            <img src="assets/images/banner/banner-2.png" alt="">
        </a>
    </div>
    <div class="swiper-slide">
        <a href="shop.php">
            <img src="assets/images/banner/banner-1.png" alt="">
        </a>
    </div>
    ...
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

</div>




<script>
  const swiper = new Swiper('.swiper', {
  pagination: {
    el: '.swiper-pagination',
    type: 'bullets',
    dynamicBullets: true,
  },
  autoplay: {
   delay: 5000,
 },
});


</script>

