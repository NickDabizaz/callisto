<?php
	require("helper.php");
    $id = $_REQUEST['product_id'];

    // Delete user dari DB
    $query = "DELETE FROM product WHERE pro_id = '$id'";
    $result = $con->query($query);
?>