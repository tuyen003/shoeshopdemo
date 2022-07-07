
<?php

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
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders WHERE order_status='on_shipping' ");
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
    $stmt2 = $conn->prepare("SELECT * FROM orders WHERE order_status='on_shipping' LIMIT $offset,$total_records_per_page");
    $stmt2->execute();

    $orders = $stmt2->get_result();


    
?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Đơn hàng đang giao
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
                                <th scope="col" >Mã người dùng</th>
                                <th scope="col" >Ngày đặt</th>
                                <th scope="col" >Số điện thoại</th>
                                <th scope="col" >Địa chỉ</th>
                                <th scope="col" >Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order){ ?>
                                <tr>
                                    <td><?php echo $order['order_id'];    ?></td>    
                                    <td><?php echo statusOrder($order['order_status']);    ?></td>    
                                    <td><?php echo $order['user_id'];    ?></td>    
                                    <td><?php echo $order['order_date'];    ?></td>    
                                    <td><?php echo $order['user_phone'];    ?></td>    
                                    <td><?php echo $order['user_address'];    ?></td>    
                                    <td>
                                        <form action="?page=order_shipping" method="get">
                                            <a href="<?php echo "&act=cancel&order_id=".$order['order_id']; ?>" class="btn btn-warning" type="submit">Hủy</a>
                                            <a href="<?php echo "&act=update&order_id=".$order['order_id']; ?>" class="btn btn-primary" type="submit">Cập nhật</a>
                                        </form>
                                    </td>    
                                
                                  
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


<?php
if(isset($_GET['success'])){
    echo '<script>swal("Cập nhật thành công", "", "success");</script>';
    // echo "ok ";
}
if(isset($_GET['cancel_success'])){
    echo '<script>swal("Đã hủy đơn hàng", "", "warning");</script>';
    // echo "ok ";
}
?>


<?php 


if(isset($_GET['act'])){
    $order_id = $_GET['order_id'];
    $act = $_GET['act'];
    
    if($act == 'update'){
        $order_status = 'delivered';
        $stmt = $conn ->prepare("UPDATE `orders` SET `order_status`=? WHERE `order_id`= ? ");
        $stmt ->bind_param('si',$order_status,$order_id);

        if($stmt->execute()) {
            header('location: ?page=order_shipping&success=order update status successfully');
                
        } else {
            header('location: ?page=order_shipping?error=order update status error');
            exit;
        }
    }


    if($act == 'cancel'){
        $order_status = 'cancel';
        $stmt = $conn ->prepare("UPDATE `orders` SET `order_status`=? WHERE `order_id`= ? ");
        $stmt ->bind_param('si',$order_status,$order_id);
        
        if($stmt->execute()) {
            header('location: ?page=order_shipping&cancel_success=order cancel');
            // exit;
        } else {
            header('location: ?page=order_shipping&error=order error');
            exit;
        }
        
    }


}



?>