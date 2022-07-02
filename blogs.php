<?php
  include("layouts/header.php");
  require("server/getBlogs.php");
  header_title("Bài viết");

?>


<section id="blogs" class="py-5">
    <div class="container text-center">
         <h3 class="form-title">Bài viết</h3>
        <hr class="mx-auto">
    </div>
    <div class="container mt-5 py-2">
        <ul class="blog-list row">
        <?php 
                $blogs = getAllBlogs();
                foreach ($blogs as $blog) {
        ?>
        <li class="col-lg-3 col-md-4 sol-sm-12">
                <a class="blog">
                    <img src="assets/images/blogs/<?php echo $blog["blog_image"]; ?>" alt="" class="blog-img">
                    <div class="blog-content-container">
                        <p class="blog-date"><i class="fa-solid fa-clock"></i> <?php echo $blog["blog_date"]; ?></p>
                        <h3 class="blog-title">
                          <?php echo $blog["blog_title"]; ?>
                        </h3>
                        <p class="blog-description">
                            <?php echo $blog["blog_description_short"]; ?>
                        </p>
                        <span>đọc thêm</span>
                    </div>
                </a>
            </li>
        <?php }  ?>
        </ul>
    </div>
</section>


<?php
  include("layouts/footer.php");
?>