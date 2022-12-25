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
    
    echo 
    "<div class='card my-2' style='width: 100%; display: flex;' id='contain-cart'>
        <div class='row no-gutters'>
            <div class='col-sm-4'>
            ";
            if($rowId2['pro_name'] == "Custom"){
                echo "<img src='./kaos_custom/kaos.png' id='kaospolos' style='width: 20vw; height: auto;'>
                <img src='./kaos_custom/".$rowId2['pro_picture']."' alt='".$rowId2['pro_picture']."' style='width: 5vw; height: auto; position: absolute; top: 10vh; left: 8vw;'>";
            }else{
                echo "<img src='./img_product/".$rowId2['pro_picture']."' class='card-img-top' style='width: 40vh; height: 40vh;'>";
            }
            echo "
            </div>
            <div class='col-sm-5'>
                <div class='card-body m-auto'>
                    <h5 class='card-title text-left'>".$rowId2['pro_name']."</h5>
                    <p class='card-text'>Harga : ". rupiah($rowId2['pro_price'])."</p>
                    <p class='card-text'>Size : ".strtoupper($rowId2['pro_size'])."</p>
                    <p class='card-text'>Qty : ".$rowId2['qty']."</p>
                    <button type='submit' class='btn btn-primary' onclick='deleteItem(this)' value='".$row['cart_pro_id']."'>DELETE</button>
                </div>
            </div>
        </div>
    </div>";
}

echo "<form action='user_payment.php' method='post'>
            <button type='submit' class='btn btn-primary my-2'>BAYAR</button>
        </form>";


if($ctr == 0){
    echo "<span style='color:red;'>Cart Kosong</span>";
}
