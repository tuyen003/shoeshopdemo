<?php
function getAllBlogs() {
    include("connect.php");
    $blogs = array();
    $sql = "SELECT * FROM blogs";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $blogs[] = $row;
    }

    return $blogs;
}