

<?php

$blog_single = 1;
if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
    //when user entered page then page number is a number selected 
    $page_no = $_GET['page_no'];

  } else {
    // if user just entered the page then default page
    $page_no = 1;
  }
  //  else {
    //return number of blogs
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM blogs");
    $stmt1 ->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //blog per page
    $total_records_per_page = 10;
    $offset = ($page_no - 1) * $total_records_per_page;
    $previous_page = $page_no -1;
    $next_page = $page_no +1;

    // $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    // get all blog
    $stmt2 = $conn->prepare("SELECT * FROM blogs LIMIT $offset,$total_records_per_page");
    $stmt2->execute();

    $blogs = $stmt2->get_result();


?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Tất cả bài viết
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
                                <th scope="col" >Miêu tả ngắn</th>
                                <th scope="col" >Ngày</th>
                                <th scope="col" >Chỉnh sửa</th>
                                <th scope="col" >Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($blogs as $blog){ ?>
                                <tr>
                                    <td><?php echo $blog['blog_id'];    ?></td>    
                                    <td><img src="<?php echo "../assets/images/blogs/".$blog['blog_image'];    ?>" alt="blog image" style="width:120px; height:70px;object-fit: cover;"></td>    
                                    <td><?php echo $blog['blog_title'];    ?></td>        
                                    <td><?php echo $blog['blog_description_short'];    ?></td>        
                                    <td><?php echo $blog['blog_date'];    ?></td>        
                                    <td><a href="#"class="btn btn-primary" data-id-blog="<?php echo $blog['blog_id']; ?>">Edit</a></td>    
                                 
                                    <td>
                                        <form action="?page=all_blogs" method="post">
                                            <input type="hidden" name="id" value="<?php echo $blog['blog_id']; ?>">
                                            <button type="submit" class="btn btn-danger delete_btn" name="delete" data-id="<?php echo $blog['blog_id']; ?>" data-toggle="modal" data-target="#modalDelete">
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
                <p>Bạn có chắc chắn muốn xóa bài viết này không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <form action="?page=delete_blog" method="POST">
                    <button type="submit" class="btn btn-primary" name="OK" id="delete_blog">Đồng ý</button>
                </form>
            </div>
        </div>
        </div>
    </div>



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
