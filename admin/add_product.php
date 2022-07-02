<?php
session_start();
include("includes/header.php");
require("../server/connect.php");
if(!isset($_SESSION['admin_logged_in'])){
    header("location: login.php");
    exit;
}

$product = array();

if(isset($_POST['create_btn'])){
    $product['name'] = $_POST["name"];
    $product['category'] = $_POST["category"];
    $product['description']  = $_POST["description"];
    $product['price']  = $_POST["price"];
    $product['sale']  = $_POST["sale"];
    $product['color']  = $_POST["color"];
    $desc_detail  = $_POST["product_description_detail"];
    $product['desc_detail'] = htmlspecialchars($desc_detail);

    $image1 = $_FILES['product_img1']['tmp_name'];
    $image2 = $_FILES['product_img2']['tmp_name'];
    $image3 = $_FILES['product_img3']['tmp_name'];
    $image4 = $_FILES['product_img4']['tmp_name'];
    
    
    $image_name1 = $name.$_FILES['product_img1']['name'];
    $image_name2 = $name.$_FILES['product_img2']['name'];
    $image_name3 = $name.$_FILES['product_img3']['name'];
    $image_name4 = $name.$_FILES['product_img4']['name'];


    move_uploaded_file($image1,"../assets/images/products/".$image_name1);
    move_uploaded_file($image2,"../assets/images/products/".$image_name2);
    move_uploaded_file($image3,"../assets/images/products/".$image_name3);
    move_uploaded_file($image4,"../assets/images/products/".$image_name4);



    $stmt = $conn->prepare("INSERT INTO `products`(`product_name`, `product_category`, `product_description`,
     `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`,
      `product_color`,`product_description_detail`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param('sssssssssss',$product['name'],$product['category'],$product['description'],$image_name1,$image_name2,$image_name3,$image_name4,$product['price'],$product['sale'],$product['color'],$product['desc_detail']);
    
    if($stmt->execute()){
        header("location: add_product.php?success=add successfully");
    }  else {
        header("location: add_product.php?error=add error");
    }

  }
?>

<?php 
    include("includes/navbar.php");
?>


        <div id="page-wrapper">
            <div class="container-fluid">
                <h2>Thêm sản phẩm</h2>
                <hr>
            </div>
            <!-- /.container-fluid -->

            <div class="container-fluid">
                <div class="table-responsive">
                    <?php if(isset($_GET["add_success"])) { ?>
                        <p style="color: green;" class="text-center"><?php echo $_GET["add_success"]; ?></p>
                    <?php    } ?>
                    <?php if(isset($_GET["add_fail"])) { ?>
                        <p style="color: red;" class="text-center"><?php echo $_GET["add_fail"]; ?></p>
                    <?php    } ?>
                    <form action="add_product.php" method="POST" enctype="multipart/form-data"  >
        
                    <div class="form-group mt-2">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" value="<?php if(isset($product['name'])) echo $product['name'];   ?>" name="name" required placeholder="Product name" id="product-name" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="product-desc">Miêu tả sản phẩm ngắn</label>
                        <input type="text" value="<?php if(isset($product['description'])) echo $product['description'];   ?>" name="description" required placeholder="Product description" id="product-desc" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="product-price">Giá sản phẩm</label>
                        <input type="text" value="<?php if(isset($product['price'])) echo $product['price'];   ?>" name="price" required placeholder="Product Price" name id="product-price" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="product-cate">Danh mục</label>
                        <select name="category" class="form-select form-control" required >
                            <option value="men">Men</option>
                            <option value="woman">Women</option>
                            <option value="sport">Sport</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="product-color">Màu sắc</label>
                        <input type="text" value="<?php if(isset($product['color'])) echo $product['color'];   ?>" name="color" required placeholder="Product color" id="product-color" class="form-control">
                    </div>

                    <div class="form-group mt-2">
                        <label for=image1">Ảnh mô tả 1</label>
                        <input type="file" value="" name="product_img1" placeholder="Image 1"id="product-img1" required class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for=image2">Ảnh mô tả 2</label>
                        <input type="file" value="" name="product_img2" placeholder="Image 2" id="product-img2" required class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for=image3">Ảnh mô tả 3</label>
                        <input type="file" value="" name="product_img3" placeholder="Image 3" id="product-img3" required class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for=image4">Ảnh mô tả 4</label>
                        <input type="file" value="" name="product_img4" placeholder="Image 4" id="product-img4" required class="form-control">
                    </div>
                    

                    <div class="form-group mt-2">
                        <label for="product-offer">Giảm giá (%)</label>
                        <input type="text" value="<?php if(isset($product['sale'])) echo $product['sale'];   ?>" name="sale" required placeholder="sale %" id="product-offer" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="description-detail">Mô tả sản phẩm</label>
                        <textarea name="product_description_detail" id="description-detail" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary" name="create_btn" value="Thêm sản phẩm">
                    </div>
                    </form>
                </div>
            </div>



        </div>
        <!-- /#page-wrapper -->


<?php
include("includes/footer.php");

?>


<?php
    if(isset($_GET['success'])) {
        echo '<script>swal("Thêm thành công", "", "success")</script>';
    }
    if(isset($_GET['error'])) {
        echo '<script>swal("Thêm thất bại", "", "error")</script>';
    }
?>