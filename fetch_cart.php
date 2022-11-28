<?php
require("helper.php");

$getId = mysqli_query($con, "SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."' ");
$rowId = mysqli_fetch_assoc($getId);

$select_query = "SELECT * FROM cart WHERE cart_customer_id ='".$rowId['acc_id']."'";
$res = $con->query($select_query);

$ctr = 0;

while($row = $res->fetch_assoc()){
    $ctr++;
    $getId2 = mysqli_query($con, "SELECT * FROM product JOIN cart on pro_id = cart_pro_id WHERE pro_id = '".$row['cart_pro_id']."' ");
    $rowId2 = mysqli_fetch_assoc($getId2);
    echo "<div class='card' style='width: 18rem; display: flex;'>
    <img src='./img_product/".$rowId2['pro_picture']."' class='card-img-top' width='150px' height='300px'>
    <div class='card-body m-auto'>
        <h5 class='card-title text-center'>".$rowId2['pro_name']."</h5>
        <p class='card-text'>Harga : Rp ".$rowId2['pro_price']."</p>
        <p class='card-text'>Size : ".strtoupper($rowId2['pro_size'])."</p>
        <p class='card-text'>Qty : ".$rowId2['qty']."</p>
        <button type='submit' class='btn btn-primary' onclick='deleteItem(this)' value='".$row['cart_pro_id']."'>DELETE</button>
    </div>
    </div>";
}

if($ctr == 0){
    echo "<span style='color:red;'>Cart Kosong</span>";
}
