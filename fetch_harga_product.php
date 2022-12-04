<?php
require("helper.php");

$nama = $_REQUEST['name'];
$size = $_REQUEST['size'];

$query_product = "SELECT * FROM product WHERE pro_name = '".$nama."' AND pro_size = '".$size."'";
$res_product = mysqli_query($con,$query_product);
$row_product = mysqli_fetch_assoc($res_product);

echo "Harga : " . rupiah($row_product['pro_price']);
?>