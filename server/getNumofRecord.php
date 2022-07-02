<?php
function getNumOfRecord($table,$where ='') {
    include("connect.php");
    $where = empty($where) ? $where : "WHERE {$where}";
    
    $sql = "SELECT * FROM {$table} {$where}";
    $result = mysqli_query($conn,$sql);

    $numb =  mysqli_num_rows($result);
    

    return $numb;
}


function getSumOfCol($table,$col="",$where =''){
    include("connect.php");
    $where = empty($where) ? $where : "WHERE {$where}";
    
    $sql = "SELECT SUM($col) AS total FROM {$table} {$where}";
    $result = mysqli_query($conn,$sql);
    $sum = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $sum = $row['total'];
    }
  
    return $sum;
}