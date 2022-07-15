<?php
  include("layouts/header.php");
  require("server/getProducts.php");
  require("lib/lib.php");
  require("server/connect.php");
  $products = getProducts();

?>

<?php 

  $page = isset($_GET['page']) ? $_GET['page']: 'home';
  $path = "pages/".$page.".php";

  if(file_exists($path))
      require("{$path}");
    else require('pages/404page.php');

?>


<?php
  include("layouts/footer.php");
?>