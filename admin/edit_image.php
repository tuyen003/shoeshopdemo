<?php
session_start();
include("includes/header.php");
require("../server/connect.php");
if(!isset($_SESSION['admin_logged_in'])){
    header("location: login.php");
    exit;
}

if(isset($_GET["product_id"])){
    $product_id = $_GET['product_id'];
    // $product_name = $_GET['product_name'];
}

?>

<?php 
    include("includes/navbar.php");
?>


            <div class="container-fluid">
                <h2>Add Product</h2>
                <hr>
            </div>
        

            <div class="container-fluid">
                <div class="table-responsive">
                    <?php if(isset($_GET["add_success"])) { ?>
                        <p style="color: green;" class="text-center"><?php echo $_GET["edit_success"]; ?></p>
                    <?php    } ?>
                    <?php if(isset($_GET["add_fail"])) { ?>
                        <p style="color: red;" class="text-center"><?php echo $_GET["edit_fail"]; ?></p>
                    <?php    } ?>
                    <form action="components/update_image.php" method="POST" enctype="multipart/form-data"  >
        
                        <input type="hidden" value="<?php if(isset($product_id)) echo $product_id;  ?>" name="product_id">
                        <input type="hidden" value="<?php if(isset($product_name)) echo $product_name;  ?>" name="product_name">
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
                        <input type="submit" class="btn btn-primary" name="update_img_btn" value="Update">
                    </div>
                    </form>
                </div>
            </div>



<?php
include("includes/footer.php");

?>