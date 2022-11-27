<?php
	require("helper.php");
    $update_id = $_REQUEST['update_id'];

    // Delete user dari DB
    $update_query = "DELETE FROM cart WHERE cart_pro_id ='$update_id'";
    $res = $con->query($update_query);

    echo "tes";
?>