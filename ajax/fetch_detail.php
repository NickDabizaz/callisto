<?php
require("helper.php");

$id = $_REQUEST['pro_id'];

$select_query = "SELECT * FROM product WHERE pro_id = '".$id."' ";
$res = $con->query($select_query);

$row = $res->fetch_assoc();



?>


