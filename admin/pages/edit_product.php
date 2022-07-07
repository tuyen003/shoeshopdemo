<?php

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt -> bind_param("i",$product_id);
    $stmt->execute();
    $product = $stmt ->get_result(); // []
    
    // no product not found
}else if($_POST['edit_btn']){
    $product_id = $_POST["product_id"];
    $name = $_POST["name"];
    $category = $_POST["category"];
    $description  = $_POST["description"];
    $price  = $_POST["price"];
    $sale  = $_POST["sale"];
    $color  = $_POST["color"];
    $desc_detail  = $_POST["product_description_detail"];
    $desc_detail = htmlspecialchars($desc_detail);

    $stmt1 = $conn->prepare("UPDATE `products` SET `product_name`= ?,`product_category`= ?
                 ,`product_description`= ?,`product_price`= ?,`product_special_offer`= ?,
                 `product_color`= ?, `product_description_detail`= ? WHERE `product_id`= ?");

    $stmt1->bind_param('sssssssi',$name,$category,$description,$price,$sale,$color,$desc_detail,$product_id);
    
    if($stmt1->execute()){

        header("location: all_products.php?update_success=update successfully");
        // header("location: edit_product.php?product_id={$product['product_id']}");
    }  else {
        header("location: all_products.php?update_error=update fail");
    }

  } else {
      header("location: all_products.php");
      exit;
  }



?>


     
            <div class="container-fluid">
                <h2>Edit Product</h2>
                <hr>
            </div>
            <!-- /.container-fluid -->

            <div class="container-fluid">
                <div class="table-responsive">
                    <form action="?page=edit_product" method="POST" enctype="multipart/form-data"  >
                    <p><?php if(isset($_GET['error'])) {echo $_GET['error'];}  ?></p>
                    
                    <?php 
                    if(isset($product)){
                        foreach($product as $product) { ?>
                        <input type="hidden" value="<?php echo $product['product_id']; ?>" name="product_id" id="product_id">
                    <div class="form-group mt-2">
                        <label for="product-name">Product Name</label>
                        <input required type="text" value="<?php echo $product['product_name']; ?>" name="name" placeholder="Product name" id="product-name" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="product-desc">Product description</label>
                        <input required type="text" value="<?php echo $product['product_description']; ?>" name="description" placeholder="Product description" id="product-desc" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="product-price">Product Price</label>
                        <input required type="text" value="<?php echo $product['product_price']; ?>" name="price" placeholder="Product Price" name id="product-price" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="product-cate">Category</label>
                        <select name="category" class="form-select form-control" required >
                            <option value="<?php echo $product['product_category']; ?>"><?php echo $product['product_category']; ?></option>
                            <option value="men">Men</option>
                            <option value="woman">Women</option>
                            <option value="sport">Sport</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="product-color">Product color</label>
                        <input required  type="text" value="<?php echo $product['product_color']; ?>" name="color" placeholder="Product color" name id="product-color" class="form-control">
                    </div>

                    <div class="form-group mt-2">
                        <label for="product-offer">Special Offer/Sale</label>
                        <input required  type="text" value="<?php echo $product['product_special_offer']; ?>" name="sale" placeholder="Product offer" id="product-offer" class="form-control">
                    </div>
                    
                    <div class="form-group mt-2">
                        <label for="description-detail">Product Description Detail</label>
                        <textarea name="product_description_detail" id="description-detail" class="form-control"><?php echo html_entity_decode($product['product_description_detail']); ?></textarea>
                    </div>
                    <?php }} ?>

                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary" name="edit_btn" id="update-btn" value="Edit">
                    </div>
                    </form>
                </div>
            </div>


