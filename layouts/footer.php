

  <div id="btn--scroll-top">
    <i class="fa-solid fa-arrow-up"></i>
  </div>

  <footer id="footer" class="footer mt-5 py-5">
    <div class="container">
    <div class="row">
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img src="assets/images/logo.png?v<?php echo time(); ?>" alt="logo" style="width: 18rem;height: 10rem;object-fit: scale-down;"/>
        <p class="pt-3">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt,
          perferendis?
        </p>
      </div>

      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Danh mục</h5>
        <ul class="text-uppercase">
          <li><a href="#">Nam</a></li>
          <li><a href="#">Nữ</a></li>
        </ul>
      </div>

      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Liên hệ</h5>
        <div class="mb-4">
          <h6 class="text-uppercase mt-2">Địa chỉ</h6>
          <p>448 Lê Văn Việt, TP. Thủ Đức</p>
        </div>
        <div class="mb-4">
          <h6 class="text-uppercase mt-2">Số điện thoại</h6>
          <p>+84-977-191-850</p>
        </div>
        <div class="mb-4">
          <h6 class="text-uppercase mt-2">Email</h6>
          <p>tuyenpv2703@gmail.com</p>
        </div>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Instagram</h5>
        <div class="row">
          <img src="assets/images/products/3_b.png" alt="img" class="img-fluid h-100 w-25 mb-2">
          <img src="assets/images/products/3_b.png" alt="img" class="img-fluid h-100 w-25 mb-2">
          <img src="assets/images/products/3_b.png" alt="img" class="img-fluid h-100 w-25 mb-2">
          <img src="assets/images/products/3_b.png" alt="img" class="img-fluid h-100 w-25 mb-2">
          <img src="assets/images/products/3_b.png" alt="img" class="img-fluid h-100 w-25 mb-2">
          <img src="assets/images/products/3_b.png" alt="img" class="img-fluid h-100 w-25 mb-2">
        </div>
      </div>

    </div>

    <div class="copyright pt-2">
      <div class="row mx-auto d-flex justify-content-between align-items-center">
        <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap" style="padding: 0;">
          <p>ShoesShop @<span id="year">2025</span> All right reserved</p>
        </div>
        <div class="d-flex col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap icon-list">
          <a href="https://www.facebook.com/Shoe-Shop-107451745328260" target="_blank"><i class="fa-brands fa-facebook"></i></i></a
          ><a href=""><i class="fa-brands fa-twitter"></i></a
          ><a href=""><i class="fa-brands fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>

  </footer>

  <div class="fb-mess-container">
 <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
</div>
    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "107451745328260");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v14.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

  <!-- ADD JAVASCRIPT -->
  <?php include("script.php"); ?>
</body>
</html>
