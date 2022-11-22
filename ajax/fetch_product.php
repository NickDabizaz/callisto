<?php
require("helper.php");

$select_query = "SELECT * FROM product";
$res = $con->query($select_query);

$ctr = 0;

while ($row = $res->fetch_assoc()) {
	$ctr++;
    
}

if ($ctr == 0) {
	echo "Belum ada Product!";
}


?>