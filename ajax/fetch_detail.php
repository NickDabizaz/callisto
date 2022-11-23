<?php
require("helper.php");

$id = $_REQUEST['pro_id'];

$select_query = "SELECT * FROM product WHERE pro_id = '" . $id . "' ";
$res = $con->query($select_query);

$row = $res->fetch_assoc();

// <div class='card' style='width: 18rem; display: flex;'>
//     <img src='asset/logo.jpg' class='card-img-top' width='150px' height='300px'>
//     <div class='card-body m-auto'>
//         <h5 class='card-title text-center'>Card title</h5>
//         <p class="card-text">Harga : ???</p>
//         <p class="card-text">Size : ???</p>
//         <button type="submit" class="btn btn-primary" onclick="deleteItem(this)" value='$_REQUEST[`id product`]'>DELETE</button>
//     </div>
// </div>


?>
