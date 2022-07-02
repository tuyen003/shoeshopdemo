<?php
session_start();
include('includes/header.php'); 
// include('includes/redirec.php'); 

require("../server/getNumofRecord.php");

if(!isset($_SESSION['admin_logged_in'])){

  header("location: login.php");
  exit;
}


include('includes/navbar.php');
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng số sản phẩm</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo getNumOfRecord('products'); ?>
              </div>
            </div>
            <div class="col-auto">
               <i class="fas fa-boxes fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số khách hàng</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php echo getNumOfRecord('users'); ?>
              </div>
            </div>
            <div class="col-auto">
            <i class="fa-solid fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng doanh thu</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?php echo getSumOfCol('orders','order_cost'); ?> đ
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tổng hóa đơn thành công</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php echo getNumOfRecord('orders'); ?>
              </div>
            </div>
            <div class="col-auto">
             <i class="fas fa-money-bill fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->

  <div class="container-fluid">
    <div class="chart-column chart-container">
      <canvas id="myChartCol" width="400" height="400"></canvas>
    </div>
    <div class="chart-pie chart-container">
      <canvas id="myChartPie" width="400" height="400"></canvas>
    </div>
  </div>




  <?php
// include('includes/scripts.php');
include('includes/footer.php');
?>

<script src="js/chart.js?v<?php echo time();?>"></script>