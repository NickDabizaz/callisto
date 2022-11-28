<?php
require("helper.php");

//$_REQUEST product id
$product_id = $_REQUEST['pro_id'];
//$_REQUEST product qty
$qty = $_REQUEST['qty'];

$query_user = "SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."'";
$res_user = mysqli_query($con,$query_user);
$row_user = mysqli_fetch_assoc($res_user);

//Check Product
$query_cart = "SELECT * FROM cart where '".$row_user['acc_id']."' = cart_customer_id and '".$product_id."' = cart_pro_id";
$res_cart = mysqli_query($con, $query_cart);
$row_cart = mysqli_fetch_array($res_cart);

if($row_cart != NULL){
    //Update Qty Produk yang sudah ada di dalam cart
    $qtynow = $row_cart['qty'];
    $qtynow += $qty;

    $query_update = "UPDATE cart set qty = '".$qtynow."' where cart_customer_id = '".$row_user['acc_id']."' AND '".$product_id."' = cart_pro_id";
    mysqli_query($con, $query_update);
}
else{
    //insert into cart
    $query_insert = "INSERT INTO cart VALUES ('".$row_user['acc_id']."' , '".$product_id."' , '".$qty."')";
    $res = $con->query($query_insert);
}

echo "<p class='card-text' style='color: green;'>Berhasil Ditambahkan Ke Cart!</p>";
?>