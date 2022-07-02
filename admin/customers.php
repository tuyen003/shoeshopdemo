

<?php
session_start();
include("includes/header.php");
include("../server/connect.php");
if(!isset($_SESSION['admin_logged_in'])){
    header("location: login.php");
    exit;
}

if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
    //when user entered page then page number is a number selected 
    $page_no = $_GET['page_no'];

  } else {
    // if user just entered the page then default page
    $page_no = 1;
  }
  //  else {
    //return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM users");
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
    $stmt2 = $conn->prepare("SELECT * FROM users LIMIT $offset,$total_records_per_page");
    $stmt2->execute();

    $users = $stmt2->get_result();

  
    include('includes/navbar.php');
    
?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Tài khoản khách hàng
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
                                <th scope="col" >Tên</th>
                                <th scope="col" >Họ tên đệm</th>
                                <th scope="col" >Họ và tên</th>
                                <th scope="col" >Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user){ ?>
                                <tr>
                                    <td><?php echo $user['user_id'];    ?></td>    
                                    <td><?php echo $user['first_name'];    ?></td>    
                                    <td><?php echo $user['last_name'];    ?></td>    
                                    <td><?php echo $user['user_name'];    ?></td>    
                                    <td><?php echo $user['user_email'];    ?></td>                                       
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
include("includes/footer.php");

?>
