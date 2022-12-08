<?php
require("helper.php");

function generateIdProduct()
{
    global $con;
    //cari max dari id
    $query = "SELECT MAX(pro_id) as 'id' FROM `product`";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    //ambil id
    $getId = substr($row['id'], 2);
    //nambah no urut
    $noUrut = (int) $getId;
    $noUrut++;
    $noUrut = str_pad($noUrut, 3, "0", STR_PAD_LEFT);
    //return id dengan no urut naik
    return "PD" . $noUrut;
}


$size = $_REQUEST['size'];
if (isset($_FILES['fileImg']['name'])) {
    $imageName = $_FILES["fileImg"]["name"];
    $tmpName = $_FILES["fileImg"]["tmp_name"];

    // Image extension validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);

    $name = $imageExtension[0];
    $imageExtension = strtolower(end($imageExtension));

    if (!in_array($imageExtension, $validImageExtension)) {
        echo "Invalid Extension";
        exit;
    } else {
        $newImageName = $name . "-" . uniqid(); // Generate new image name
        $newImageName .= '.' . $imageExtension;

        move_uploaded_file($tmpName, 'kaos_custom/' . $_FILES['fileImg']['name']);
    }
}

$getId = mysqli_query($con, "SELECT * FROM account WHERE acc_user = '" . $_SESSION['userLogin'] . "' ");
$rowId = mysqli_fetch_assoc($getId);
$customer_id = $rowId['acc_id'];

$product_id = generateIdProduct();

if ($size == "s") {
    $name = "Custom";
    $price = 12000000;
} else if ($size == "m") {
    $name = "Custom";
    $price = 17000000;
} else if ($size == "l") {
    $name = "Custom";
    $price = 22000000;
} else if ($size == "xl") {
    $name = "Custom";
    $price = 27000000;
}

$detail = "-";

$queryInsert = "INSERT INTO product VALUES ( '" . $product_id . "' , '" . $name . "' , '" . $price . "' , 1, '" . $size . "' , '" . $detail . "' , '" . $_FILES['fileImg']['name'] . "' , 1, '" . $customer_id . "')";
$resInsert = mysqli_query($con, $queryInsert);

$cartInsert = "INSERT INTO cart VALUES ('" . $customer_id . "' , '" . $product_id . "' , 1)";
$rescartInsert = mysqli_query($con, $cartInsert);
if ($rescartInsert){
    $success = 'Berhasil Custom Produk!';
    
} 

echo "Success";
    exit;


?>