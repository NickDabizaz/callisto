<?php
require("helper.php");

$id = $_REQUEST['pro_id'];

$select_query = "SELECT * FROM product WHERE pro_id = '".$id."' ";
$res = $con->query($select_query);

$row = $res->fetch_assoc();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>