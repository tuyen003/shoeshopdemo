

<?php


require("lib/sendMail.php");

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
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders WHERE order_status='on_hold' ");
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
    $stmt2 = $conn->prepare("SELECT * FROM orders WHERE order_status='on_hold' LIMIT $offset,$total_records_per_page");
    $stmt2->execute();

    $orders = $stmt2->get_result();
    
?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Đơn hàng đang chờ duyệt
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">
            

                <div class="table-responsive">
             
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col" >Mã</th>
                                <th scope="col" >Trạng thái</th>
                                <th scope="col" >Tổng tiền</th>
                                <th scope="col" >Tên Khách hàng</th>
                                <th scope="col" >Ngày đặt</th>
                                <th scope="col" >Số điện thoại</th>
                                <th scope="col" >Địa chỉ</th>
                                <th scope="col" >Tùy chỉnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order){ ?>
                                <tr>
                                    <td><?php echo $order['order_id'];    ?></td>    
                                    <td><?php echo statusOrder($order['order_status']);    ?></td>    
                                    <td><?php echo $order['order_cost'];    ?> đ</td>    
                                    <td><?php echo $order['user_name'];    ?></td>    
                                    <td><?php echo $order['order_date'];    ?></td>    
                                    <td><?php echo $order['user_phone'];    ?></td>    
                                    <td><?php echo $order['user_address'];    ?></td>    
                                    <td>
                                    <form action="?page=order_pending" method="GET">
                                    <input type="hidden" name="order_id" value="<?php echo  $order['order_id']; ?>">
                                    <input type="hidden" name="user_name" value="<?php echo  $order['user_name']; ?>">
                                    <input type="hidden" name="user_email" value="<?php echo  $order['user_email']; ?>">
                                
                                    <a class="btn-warning btn" type="submit" name="cancel_order" href="<?php echo "?order_id=".$order['order_id']."&cancel=1"; ?>" >Hủy</a>
                                    <a class="btn-primary btn mt-2" type="submit" name="update_order_status" href="<?php echo "?page=order_pending&order_id=".$order['order_id']."&update_order_status=1"; ?>" >Duyệt</a>
                                    <button class="btn-success btn mt-2 btn-order-detail" data-order-id="<?php echo  $order['order_id']; ?>" >Chi tiết</button>
                                      
                                    </form>
                                    </td>    
                                    <!-- <td></td>     -->
                                  
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
                <form action="?page=delete_product" method="POST">
                    <button type="submit" class="btn btn-primary" name="OK" id="delete_product">Đồng ý</button>
                </form>
            </div>
        </div>
        </div>
    </div>






    <!-- // POP UP  -->
    <section id="pop-up">
        <div id="pop-up-bg"></div>
        <div class="popup-detail-container">
        <div id="pop-up-close"><i class="fa-solid fa-xmark"></i></div>
        <div class="container mt-5">
            <div class="table-responsive" id="pop-up-form-container">
          
   
               
                        <!-- Thêm nội dung hiển thị vào đây -->
                        
            </div>      
        </div>
      </section>


        

<?php
if(isset($_GET['success'])){
    echo '<script>swal("Duyệt thành công", "", "success");</script>';
    // echo "ok ";
}
if(isset($_GET['cancel_success'])){
    echo '<script>swal("Đã hủy đơn hàng", "", "success");</script>';
    // echo "ok ";
}
?>


<?php

// print_r($_POST);
// print_r($_GET);
// CHức năng duyệt gửi đơn hàng qua email
if(isset($_GET['update_order_status'])){
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt -> bind_param("i",$order_id);
    $stmt->execute();
    $orders = $stmt ->get_result(); // []
    
    foreach ($orders as $order) {
        $_SESSION['Email']  =  $order['user_email'];
        $_SESSION['Name']  = $order['user_name'];
    }

    $order_status = 'on_shipping';

    $stmt = $conn ->prepare("UPDATE `orders` SET `order_status`=? WHERE `order_id`= ? ");
    $stmt ->bind_param('si',$order_status,$order_id);
    
    if($stmt->execute()) {
    
            if(sendMail( $_SESSION['Email'], $_SESSION['Name'])){
                unset( $_SESSION['Email']);
                unset( $_SESSION['Name']);
                header('location: order_pending.php?success=order update status successfully');
                exit;
            } else {
                echo sendMail($_SESSION['Email'],$_SESSION['Name']);
            }
         
    } else {
            header('location: order_pending.php?error=order update status error');
            exit;
    }
    
}

if(isset($_GET['cancel'])){
    $order_id = $_GET['order_id'];
    $order_status = 'cancel';
    $stmt = $conn ->prepare("UPDATE `orders` SET `order_status`=? WHERE `order_id`= ? ");
    $stmt ->bind_param('si',$order_status,$order_id);
    
    if($stmt->execute()) {
        header('location: order_pending.php?cancel_success=order cancel');
        exit;
    } else {
        header('location: order_pending.php?error=order error');
        exit;
    }
    
}



?>


