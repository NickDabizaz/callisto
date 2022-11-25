<?php
require("helper.php");

$select_query = "SELECT * FROM product GROUP BY pro_name";
$res = mysqli_query($con,$select_query);

$ctr = 0;

while ($row = mysqli_fetch_assoc($res)) {
	$ctr++;
    echo    "<div class='card ms-2' style='width: 18rem; display: flex;'>
            <img src='img_product/".$row['pro_picture']."' class='card-img-top' width='150px' height='300px'>
            <div class='card-body m-auto'>
                <h5 class='card-title text-center'>".$row['pro_name']."</h5>
                <form action='product_confirm.php' method='post'>
                    <input type='hidden' name='product_name' value='".$row['pro_picture']."'>
                    <button type='submit' class='btn btn-primary'>CHOOSE</button>
                </form>
            </div>
        </div>";
}

if ($ctr == 0) {
	echo "Belum ada Product!";
}


?>