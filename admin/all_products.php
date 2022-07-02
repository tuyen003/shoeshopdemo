
<?php
session_start();
include("includes/header.php");
include("../server/connect.php");
if(!isset($_SESSION['admin_logged_in'])){
    header("location: login.php");
    exit;
}
$product_single = 1;
if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
    //when user entered page then page number is a number selected 
    $page_no = $_GET['page_no'];

  } else {
    // if user just entered the page then default page
    $page_no = 1;
  }
  //  else {
    //return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
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
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
    $stmt2->execute();

    $products = $stmt2->get_result();

  
    include('includes/navbar.php');
    
?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Tất cả sản phẩm
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
                                <th scope="col" >Ảnh</th>
                                <th scope="col" >Tên</th>
                                <th scope="col" >Giá</th>
                                <th scope="col" >Danh mục</th>
                                <th scope="col" >Giảm giá</th>
                                <th scope="col" >Màu sắc</th>
                                <th scope="col" >Chỉnh ảnh</th>
                                <th scope="col" >Chỉnh sửa thông tin</th>
                                <th scope="col" >Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product){ ?>
                                <tr>
                                    <td><?php echo $product['product_id'];    ?></td>    
                                    <td><img src="<?php echo "../assets/images/products/".$product['product_image'];    ?>" alt="product image" style="width:70px; height:70px;"></td>    
                                    <td><?php echo $product['product_name'];    ?></td>    
                                    <td><?php echo $product['product_price'];    ?></td>    
                                    <td><?php echo $product['product_category'];    ?></td>    
                                    <td><?php echo $product['product_special_offer'];    ?></td>    
                                    <td><?php echo $product['product_color'];    ?></td>    
                                    <td><button class="update-image-btn btn-warning btn" data-img-id="<?php echo $product['product_id']; ?>" data-img-name="<?php echo $product['product_name']; ?>" class="btn btn-warning">Sửa ảnh</button></td>    
                                    <td><a href="<?php echo "edit_product.php?product_id=".$product['product_id']; ?>" class="btn btn-primary">Chỉnh sửa</a></td>    
                                    <!-- <td><a href="" class="btn btn-danger delete_links">Delete</a></td>     -->
                                    <td>
                                        <form action="all_products.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>">
                                            <button type="submit" class="btn btn-danger delete_btn" name="delete" data-id="<?php echo $product['product_id']; ?>" data-toggle="modal" data-target="#modalDelete">
                                                Delete
                                            </button>
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




    <section id="pop-up">
        <div id="pop-up-bg"></div>
        <div class="popup-detail-container">
        <div id="pop-up-close"><i class="fa-solid fa-xmark"></i></div>
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center form-title">Chỉnh sửa ảnh</h2>
            <hr class="mx-auto">
   
            <div class="table-responsive" id="pop-up-form-container">
               
                <!-- <form action="all_products.php" method="POST" id="edit-img-form" enctype="multipart/form-data"  >
                
                    <div class="form-group mt-2">
                        <label for=image1">Product Image 1</label>
                        <input type="file" value="" name="product_img1" placeholder="Image 1"id="product-img1" required class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for=image2">Product Image 2</label>
                        <input type="file" value="" name="product_img2" placeholder="Image 2" id="product-img2" required class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for=image3">Product Image 3</label>
                        <input type="file" value="" name="product_img3" placeholder="Image 3" id="product-img3" required class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for=image4">Product Image 4</label>
                        <input type="file" value="" name="product_img4" placeholder="Image 4" id="product-img4" required class="form-control">
                    </div>
                
                    
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary" id="update-img-btn" name="update_img_btn" data-id-product="<?php if(isset($product_id)) echo $product_id;  ?>" value="Update">
                    </div>
                </form> -->
            </div>      
       
        </div>
      </section>


        
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
