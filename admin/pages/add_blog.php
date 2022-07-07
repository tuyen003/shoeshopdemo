<?php

$blog = array();

if(isset($_POST['add_blog_btn'])){
    $blog['name'] = $_POST["name"];
    $blog['description']  = $_POST["description"];
    $desc_detail  = $_POST["blog_description_detail"];
    $blog['desc_detail'] = htmlspecialchars($desc_detail);

    $image = $_FILES['blog_img']['tmp_name'];
    $image_name = $name.$_FILES['blog_img']['name'];
    move_uploaded_file($image,"../assets/images/blogs/".$image_name);

    $stmt = $conn->prepare("INSERT INTO `blogs`(`blog_title`, `blog_image`, `blog_description_short`, `blog_detail`) VALUES (?,?,?,?)");

    $stmt->bind_param('ssss',$blog['name'],$image_name,$blog['description'],$blog['desc_detail']);
    
    if($stmt->execute()){
        header("location: add_blog.php?success=add successfully");
    }  else {
        header("location: add_blog.php?error=add error");
    }

  }
?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <h2>Thêm bài viết</h2>
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
                    <form action="add_blog.php" method="POST" enctype="multipart/form-data"  >
        
                    <div class="form-group mt-2">
                        <label for="blog-name">Tiêu đề</label>
                        <input type="text" value="<?php if(isset($blog['name'])) echo $blog['name'];   ?>" name="name" required placeholder="blog name" id="blog-name" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="blog-desc">Miêu tả ngắn (tối đa 200 kí tự)</label>
                        <input type="text" value="<?php if(isset($blog['description'])) echo $blog['description'];   ?>" name="description" required placeholder="blog description" id="blog-desc" class="form-control">
                    </div>
                
                    <div class="form-group mt-2">
                        <label for=image1">Ảnh</label>
                        <input type="file" value="" name="blog_img" placeholder="Image"id="blog-img" required class="form-control">
                    </div>
                  
                    <div class="form-group mt-2">
                        <label for="description-detail">Chi tiết bài viết</label>
                        <textarea name="blog_description_detail" id="description-detail" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary" name="add_blog_btn" value="Thêm bài viết">
                    </div>
                    </form>
                </div>
            </div>



        </div>
        <!-- /#page-wrapper -->

<?php
    if(isset($_GET['success'])) {
        echo '<script>swal("Thêm thành công", "", "success")</script>';
    }
    if(isset($_GET['error'])) {
        echo '<script>swal("Thêm thất bại", "", "error")</script>';
    }
?>