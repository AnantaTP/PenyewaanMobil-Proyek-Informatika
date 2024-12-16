<?php
include 'admin/config.php';
if(isset($_POST['addtocart']) && $_POST['addtocart'] == 1){
    if(!isset($_SESSION['uid']) || $_SESSION['uid'] == NULL){
        echo 0;
        exit;
    }
    $pid = $_POST['pid'];
    $uid = $_SESSION['uid'];
    $addtocart_query = "insert into orders(product_id, user_id) values('$pid', '$uid')";
    $result = $conn->query($addtocart_query);
    if($result === FALSE){
        echo "Something went wrong!";
    }else{
        echo "Added successfully";
    }
    exit;
}

if(isset($_POST['deleteorder']) && $_POST['deleteorder'] == 1){
    $oid = $_POST['oid'];
    $delete_order_query = "delete from orders where id = '$oid'";
    $result = $conn->query($delete_order_query);
    if($result === TRUE){
        echo 1;
    }
    exit;
}


if(isset($_POST['cancelorder']) && $_POST['cancelorder'] == 1){
    $oid = $_POST['oid'];
    $cancel_order_query = "update orders set status = 3 where id = '$oid'";
    $result = $conn->query($cancel_order_query);
    if($result === TRUE){
        echo 1;
    }
    exit;
}
?>