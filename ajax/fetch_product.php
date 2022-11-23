<?php
require("helper.php");

$select_query = "SELECT * FROM product";
$res = $con->query($select_query);

$ctr = 0;

while ($row = $res->fetch_assoc()) {
	$ctr++;
    // <!-- ini template card -->
    //     <div class='card' style='width: 18rem; display: flex;'>
    //         <img src='asset/logo.jpg' class='card-img-top' width='150px' height='300px'>
    //         <div class='card-body m-auto'>
    //             <h5 class='card-title text-center'>Card title</h5>
    //             <p class="card-text">Harga : ???</p>
    //             <p class="card-text">Size : ???</p>
    //             <form action='product_detail.php' method='get'>
    //                 <input type='hidden' name='product_id' value='$_REQUEST[`id product`]'>
    //                 <button type="submit" class="btn btn-primary">DETAIL</button>
    //             </form>
    //         </div>
    //     </div>
    //     <!-- ini template card -->
}

if ($ctr == 0) {
	echo "Belum ada Product!";
}


?>