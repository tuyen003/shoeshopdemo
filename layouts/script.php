<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
  crossorigin="anonymous"
  ></script>

  <script src="assets/js/lib/jquery-3.6.0.min.js" type="text/javascript"></script>
  <script src="assets/js/lib/zoom.js?v<?php echo time();?>"></script>
  
  <script src="assets/js/app.js?v<?php echo time();?>"></script>
  <script src="assets/js/product-detail.js?v<?php echo time();?>"></script>
  
 
  <script src="assets/js/main.js?v<?php echo time();?>">" ></script>
  <script src="assets/js/display-order.js?v<?php echo time();?>">" ></script>


  <script src="assets/js/review.js?v<?php echo time();?>"></script>

  <script src="assets/js/wishlist.js?v<?php echo time();?>"></script>
  <script>
  $(document).ready(function(){
    $("#btn--scroll-top").click(function() {
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
    });


    if($(".xzoom,.xzoom-gallery")){
      $(".xzoom,.xzoom-gallery").xzoom({
        zoomWidth: 350,
        tint: "#333",
        Xoffset:15,
      })
    }
 
  })
  
  </script>