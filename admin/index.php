<?php
session_start();
include('includes/header.php'); 
require("lib/lib.php");
require("../server/connect.php");

require("../server/getNumofRecord.php");

if(!isset($_SESSION['admin_logged_in'])){

  header("location: login.php");
  exit;
}

include('includes/navbar.php');
?>

<?php
 
  $page = isset($_GET['page']) ? $_GET['page']: 'home';
  $path = "pages/".$page.".php";

  if(file_exists($path))
      require("{$path}");
    else require('pages/404.php');

?>



  <?php
// include('includes/scripts.php');
include('includes/footer.php');
?>

