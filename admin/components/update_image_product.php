<?php
require("../../server/connect.php");
$data = array();

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$image1 = $_FILES['product_img1']['tmp_name'];
$image2 = $_FILES['product_img2']['tmp_name'];
$image3 = $_FILES['product_img3']['tmp_name'];
$image4 = $_FILES['product_img4']['tmp_name'];


$image_name1 = $product_name.$_FILES['product_img1']['name'];
$image_name2 = $product_name.$_FILES['product_img2']['name'];
$image_name3 = $product_name.$_FILES['product_img3']['name'];
$image_name4 = $product_name.$_FILES['product_img4']['name'];



move_uploaded_file($image1,"../../assets/images/products/".$image_name1);
move_uploaded_file($image2,"../../assets/images/products/".$image_name2);
move_uploaded_file($image3,"../../assets/images/products/".$image_name3);
move_uploaded_file($image4,"../../assets/images/products/".$image_name4);

$stmt = $conn->prepare("UPDATE `products` SET `product_image`=?,
                    `product_image2`=?,`product_image3`=?,
                    `product_image4`= ? WHERE  `product_id`= ?");

$stmt->bind_param('ssssi',$image_name1,$image_name2,$image_name3,$image_name4,$product_id);

if($stmt->execute()){
  $data['message'] = 'success';
} else {
    $data['message'] = 'error';
}

$data = json_encode($data);
echo $data;