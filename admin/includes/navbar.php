<?php //$_GET['page'] = substr($_SERVER['SCRIPT_NAME'],strrpos($_SERVER['SCRIPT_NAME'],"=")+1);
  // echo $_GET['page'];
  if(isset($_GET['page'])) {
    $page_active = $_GET['page'];
  } else $page_active = "";
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand" href="?page=home"  style="text-align:left;">
  <div class="sidebar-brand-text">Shoe shop</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?php if($page_active == '') echo 'active'; ?>">
  <a class="nav-link" href="?page=home">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Thống kê</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    khách hàng
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?php if($page_active == 'orders' || $page_active == 'order_pending'|| $page_active == 'order_shipping') echo 'active'; ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDashboard" aria-expanded="true" aria-controls="collapseDashboard">
  <i class="fas fa-file-invoice-dollar"></i>
    <span>Danh sách đơn hàng</span>
  </a>
  <div id="collapseDashboard" class="collapse  <?php if($page_active == 'orders' ||$page_active == 'order_pending'||$page_active == 'order_shipping') echo 'show'; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!-- <h6 class="collapse-header">Custom Components:</h6> -->
      <a class="collapse-item <?php if($page_active == 'order_pending') echo 'active'; ?>" href="?page=order_pending">Đơn hàng đang chờ duyệt</a>
      <a class="collapse-item <?php if($page_active == 'order_shipping') echo 'active'; ?>" href="?page=order_shipping">Đơn hàng đang giao</a>
      <a class="collapse-item <?php if($page_active == 'orders') echo 'active'; ?>" href="?page=orders">Đơn hàng thành công</a>
    </div>
  </div>
</li>




<li class="nav-item <?php if($page_active == 'customers') echo 'active'; ?>">
  <a class="nav-link" href="?page=customers">
  <i class="fas fa-user"></i>
    <span>Danh sách người dùng</span></a>
</li>



<!-- Divider -->
<hr class="sidebar-divider">
<div class="sidebar-heading">
    Sản phẩm
</div>

<!-- Nav Item -  PRODUCTS -->
<li class="nav-item <?php if($page_active == 'all_products' ||$page_active == 'add_product') echo 'active'; ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
  <i class="fas fa-boxes"></i>
    <span>Sản phẩm</span>
  </a>
  <div id="collapseProducts" class="collapse <?php if($page_active == 'all_products' ||$page_active == 'add_product') echo 'show'; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">

      <a class="collapse-item <?php if($page_active == 'all_products') echo 'active'; ?>" href="?page=all_products">Tất cả sản phẩm</a>
      <a class="collapse-item <?php if($page_active == 'add_product') echo 'active'; ?>" href="?page=add_product">Thêm sản phẩm</a>
   
    </div>
  </div>
</li>

<!-- Nav Item -  Blogs Bài viết -->
<li class="nav-item <?php if($page_active == 'blogs' ||$page_active == 'add_blog') echo 'active'; ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs" aria-expanded="true" aria-controls="collapseBlogs">
  <i class="fab fa-blogger"></i>
    <span>Bài viết( Blogs)</span>
  </a>
  <div id="collapseBlogs" class="collapse <?php if($page_active == 'blogs' ||$page_active == 'add_blog') echo 'show'; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">

      <a class="collapse-item <?php if($page_active == 'blogs') echo 'active'; ?>" href="?page=blogs">Tất cả bài viết</a>
      <a class="collapse-item <?php if($page_active == 'add_blog') echo 'active'; ?>" href="?page=add_blog">Thêm bài viết</a>
   
    </div>
  </div>
</li>




<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

        

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
                  <?php echo  $_SESSION['admin_info']['admin_name']; ?>
                  
                </span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Đăng xuất?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Bạn có chắc muốn đăng xuất</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>

          <form action="logout" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">Đăng xuất</button>

          </form>


        </div>
      </div>
    </div>
  </div>