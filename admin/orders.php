

<?php
session_start();
include("includes/header.php");
include("../server/connect.php");
require('lib/lib.php');
if(!isset($_SESSION['admin_logged_in'])){
    header("location: login.php");
    exit;
}
// $product_single = 1;
if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
    //when user entered page then page number is a number selected 
    $page_no = $_GET['page_no'];

  } else {
    // if user just entered the page then default page
    $page_no = 1;
  }
  //  else {
    //return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
    $stmt1 ->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //Product per page
    $total_records_per_page = 10;
    $offset = ($page_no - 1) * $total_records_per_page;
    $previous_page = $page_no -1;
    $next_page = $page_no +1;

    // $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    // get all product
    $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
    $stmt2->execute();

    $orders = $stmt2->get_result();

    // print_r($_SESSION);
    include('includes/navbar.php');
    
?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Tất cả đơn hàng
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">

                <div class="order-filter-container">
                    <select name="order_status" id="order_filter" class="form-control">
                        <option value="all">Tất cả đơn hàng</option>
                        <option value="on_hold">Đang chờ duyệt</option>
                        <option value="on_shipping">Đang giao hàng</option>
                        <option value="success">Thành công</option>
                        <option value="cancel">Đơn hàng hủy</option>
                    </select>
                </div>

                <div class="table-responsive">
                    
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col" >Mã</th>
                                <th scope="col" >Trạng thái</th>
                                <th scope="col" >Mã người dùng</th>
                                <th scope="col" >Ngày đặt</th>
                                <th scope="col" >Số điện thoại</th>
                                <th scope="col" >Địa chỉ</th>
                                <th scope="col" >Xóa</th>
                                <!-- <th scope="col" >Chỉnh sửa</th> -->
                            </tr>
                        </thead>
                        <tbody id="table-order-body">
                            <?php foreach($orders as $order){ ?>
                                <tr>
                                    <td><?php echo $order['order_id'];    ?></td>    
                                    <td><?php echo statusOrder($order['order_status']);    ?></td>    
                                    <td><?php echo $order['user_id'];    ?></td>    
                                    <td><?php echo $order['order_date'];    ?></td>    
                                    <td><?php echo $order['user_phone'];    ?></td>    
                                    <td><?php echo $order['user_address'];    ?></td>    
                                    <td><a href="<?php //echo "order.php?product_id=".$order['order_id']; ?>" class="btn btn-warning">Delete</a></td>    
                                    <!-- <td><a href="<?php //echo "edit_product.php?product_id=".$order['order_id']; ?>" class="btn btn-primary">Edit</a></td>     -->
                                  
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="container-fluid">

                     <?php 

                        $start_pg = '<ul class="pagination mt-5">';
                        if($page_no > 1) {
                            $start_pg .= "<li class=\"page-item\">
                            <a href=\"?page_no={$previous_page}\" class=\"page-link\">Prev</a>
                        </li>";
                        }

                        for($i = 1; $i <= $total_no_of_pages; $i++){
                            $active ='';
                            if($i == $page_no) $active = "active-pg";
                            $start_pg .= "<li class=\"page-item\">
                                            <a href=\"?page_no={$i}\" class=\"page-link  {$active}\">{$i}</a>
                                        </li>";

                                    }
                        if($page_no < $total_no_of_pages) {
                            $start_pg .="<li class=\"page-item\">
                            <a href=\"?page_no={$next_page}\" class=\"page-link\">Next</a>
                            </li>";
                        } else if($page_no = $total_no_of_pages) {
                            $start_pg .="<li class=\"page-item disabled\">
                            <a href=\"?page_no={$page_no}\" class=\"page-link\">Next</a>
                            </li>";
                        }
                        $start_pg .="</ul>";
                     
                    ?>

                    <nav aria-label="Page navigation" class="d-flex justify-content-end">
                      <?php echo $start_pg; ?>
                    </nav>
                </div>

       

        </div>
        <!-- /#page-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa sản phẩm này không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <form action="delete_product.php" method="POST">
                    <button type="submit" class="btn btn-primary" name="OK" id="delete_product">Đồng ý</button>
                </form>
            </div>
        </div>
        </div>
    </div>



        
<?php
include("includes/footer.php");

?>

<?php
if(isset($_GET['update_success'])){
    echo '<script>swal("Cập nhật thành công", "", "success");</script>';
    // echo "ok ";
}
if(isset($_GET['update_error'])){
    echo '<script>swal("Cập nhật thất bại", "", "error");</script>';
    // echo "ok ";
}
?>
