<?php
require("helper.php");

//$_REQUEST product id
$product_id = $_REQUEST['pro_id'];
//$_REQUEST product qty
$qty = $_REQUEST['qty'];

$query_user = "SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."'";
$res_user = mysqli_query($con,$query_user);
$row_user = mysqli_fetch_assoc($res_user);

//insert into cart
$query_insert = "INSERT INTO cart VALUES ('".$row_user['acc_id']."' , '".$product_id."' , '".$qty."')";
$res = $con->query($query_insert);

$err = "BERHASIL TAMBAHKAN KE KERANJANG!";
?>