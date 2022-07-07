<?php
ob_start();

  header_title("Thông tin sản phẩm");
//   $blog = array();

  if(isset($_GET['blog_id'])){
    $blog_id = $_GET['blog_id'];
    // $blog_id = 1;
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE blog_id = ?");
    $stmt -> bind_param("i",$blog_id);
    $stmt->execute();
    $blogs = $stmt ->get_result(); // []


    // no product not found
  } else {
      header("location: 404page.php");
  }

?> 
 
<section class="container blog-detail my-5 pt-5">
<div class="row">
    <?php foreach ($blogs as $blog) {
        # code...
     ?>      
              <div class="col-12">
                <h2 class="blog-tile"> <?php echo $blog['blog_title']; ?></h2>
                <p class="blog-date"><?php echo $blog['blog_date']; ?></p>
                <div class="blog-description-detail">
                    <?php echo html_entity_decode($blog['blog_detail']); ?>
                </div>
              </div>
            </div>


    <?php }  ?>
</section>
        
  
