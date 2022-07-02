
<?php 
ob_start();
session_start();?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link type="image/png" sizes="32x32" rel="icon" href="assets/favicon/icons8-shoe-32.png">
      <link type="image/png" sizes="16x16" rel="icon" href="assets/favicon/icons8-shoe-16.png">
      <link type="image/png" sizes="96x96" rel="icon" href="assets/favicon/icons8-shoe-96.png">

      <base href="https://php-shoeshop.herokuapp.com/">
  <?php 
  function header_title($title){
      echo '<title>'.$title.'</title>';
  }
  ?>
   <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
  crossorigin="anonymous"
  />
  <link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>


  <link rel="stylesheet" href="assets/css/reset.css?v<?php echo time();?>" />
  <link rel="stylesheet" href="assets/css/main.css?v<?php echo time();?>" />
  <style>
  @import url("assets/css/components/404-style.css?v<?php echo time();?>");
  @import url("assets/css/components/account.css?v<?php echo time();?>");
  @import url("assets/css/components/blogs.css?v<?php echo time();?>");
  @import url("assets/css/components/cart.css?v<?php echo time();?>");
  @import url("assets/css/components/checkout.css?v<?php echo time();?>");
  @import url("assets/css/components/contact.css?v<?php echo time();?>");
  @import url("assets/css/components/header.css?v<?php echo time();?>");
  @import url("assets/css/components/login.css?v<?php echo time();?>");
  @import url("assets/css/components/order_detail.css?v<?php echo time();?>");
  @import url("assets/css/components/register.css?v<?php echo time();?>");
  @import url("assets/css/components/shop.css?v<?php echo time();?>");
  @import url("assets/css/components/single-product.css?v<?php echo time();?>");
  @import url("assets/css/components/wishlist.css?v<?php echo time();?>");
  </style>
 
  <script src="assets/js/lib/swiper-bundle.min.js"></script>
  <script src="assets/js/lib/sweetalert.min.js?v<?php echo time();?>"></script>

  </head>
<body>
 
<header id="header" class="header">

<nav class="navbar navbar-expand-lg bg-light py-3">
        <div class="container-fluid">
          <div class="nav-left d-flex align-items-center">
            <a class="navbar-brand" href="index.php">
            <!-- <img src="assets/images/logo.png?v" alt="logo" class="w-50"> -->
            <span id="logo">SHOESHOP</span>
            </a>
            <ul class="navbar-nav navbar-dropdown">
              <li class="nav-item">
                <a class="nav-link" href="index">Trang chủ</a>
              </li>
              <li class="nav-item parent-menu" style="position: relative;">
                <a class="nav-link" href="shop" >Sản phẩm</a>
                <div class="sub-category-container">
                  <ul id="sub-category">
                  <li class="sub-category-item">
                      <a href="danh-muc/products.php?cate[]=nam" class="sub-category-link">Giày Nam</a>
                    </li>
                    <li class="sub-category-item">
                      <a href="danh-muc/products.php?cate[]=nữ" class="sub-category-link">Giày nữ</a>
                    </li>
                    <li class="sub-category-item">
                      <a href="danh-muc/products.php?cate[]=nữ&cate[]=sport" class="sub-category-link">Giày thể thao nữ</a>
                    </li>
                    <li class="sub-category-item">
                      <a href="danh-muc/products.php?cate[]=nam&cate[]=sport" class="sub-category-link">Giày thể thao nam</a>
                    </li>
                  
                   
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact">Liên hệ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="blogs">Blogs</a>
              </li>
              <li class="nav-item action-dropdown"  style="display:<?php echo isset($_SESSION['user_info'])?'none':'block';?>;" >
                <a href="login" class="nav-btn btn-login" >Đăng nhập</a>
                <a href="register" class="nav-btn btn-register">Đăng ký</a>
              </li>
            </ul>
          </div>
         
          <div class="navbar-right">
            <ul class="navbar-nav flex-row" >
              <li class="nav-item d-flex justify-content-between align-items-center">
                <a href="wishlist" class="wishlist-icon ml-3">
                <img src="assets/images/icons/wishlist_icon.svg" alt="wishlist icon">
                </a>
                <a href="cart" class="cart-icon">
                  <img src="assets/images/icons/cart_icon.svg" alt="cart icon">
                  <?php

                    $number = 0;
                    if(isset($_SESSION['cart'])){
                        foreach ($_SESSION['cart'] as $key => $value) {
                            $number += $value['product_quantity'];
                        }
                    }
                  ?>
                  <span id="product-number-cart"><?php echo $number !== 0? $number: 0;?></span>
                </a>
                  <a href="account" class="user-icon ml-3" style="display:<?php if(isset($_SESSION['logged_in'])) echo 'block'; else echo 'none'; ?>">
                 
                  <img src="assets/images/icons/user_icon.svg" alt="user icon">
                  </a>
                  <a href="#" class="dropdown-icon ml-3">
                  <img src="assets/images/icons/icon_dropdown.svg" alt="dropdown icon">
                  </a>
              </li>

              
              <li class="nav-item user-list-action"  style="display:<?php echo isset($_SESSION['user_info'])?'none':'block';?>;" >
                <a href="login" class="nav-btn btn-login" >Đăng nhập</a>
                <a href="register" class="nav-btn btn-register">Đăng ký</a>
              </li>
            </ul>
          </div>

            
        </div>
      </nav>

</header>

<?php ob_end_flush();?>
