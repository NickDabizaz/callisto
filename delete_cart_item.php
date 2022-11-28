<?php
	require("helper.php");
    $delete_id = $_REQUEST['delete_id'];  
    
    // Check Custom Product
    $result = mysqli_query($con, "SELECT * FROM product where '".$delete_id."' = pro_id");
    $row = mysqli_fetch_assoc($result);

    if($row['pro_cust_id'] == NULL){
        // Delete Product From Cart
        $delete_query = "DELETE FROM cart WHERE cart_pro_id ='".$delete_id."'";
        $delete_res = $con->query($delete_query);
    }
    else{
        // Delete Product From Cart
        $delete_query = "DELETE FROM cart WHERE cart_pro_id ='".$delete_id."'";
        $delete_res = $con->query($delete_query);

        // Delete Custom Product
        $deletecustom_query = "DELETE FROM product WHERE pro_id ='".$delete_id."'";
        $deletecustom_res = $con->query($deletecustom_query);
    }
?>