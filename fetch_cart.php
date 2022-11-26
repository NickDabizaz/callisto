<?php
require("helper.php");

$id = $_REQUEST['user'];

$getId = mysqli_query($con, "SELECT * FROM pro_user = '".$id."' ");
$rowId = mysqli_fetch_assoc($getId);

$select_query = "SELECT * FROM cart WHERE cart_customer_id ='".$rowId['pro_id']."'";
$res = $con->query($select_query);

$ctr = 0;

while($row = $res->fetch_assoc()){
    $ctr++;
    echo "<div class='card' style='width: 18rem; display: flex;'>
    <img src='asset/logo.jpg' class='card-img-top' width='150px' height='300px'>
    <div class='card-body m-auto'>
        <h5 class='card-title text-center'>Card title</h5>
        <p class='card-text'>Harga : ???</p>
        <p class='card-text'>Size : ???</p>
        <button type='submit' class='btn btn-primary' onclick='deleteItem(this)' value='".$_REQUEST['pro_id']."'>DELETE</button>
    </div>
    </div>";
}



if($ctr == 0){
    echo "<span style='color:red;'>Cart Kosong</span>";
}

?>