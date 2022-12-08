<?php
	require("helper.php");

    $imagecustom = $_REQUEST['imagecustom'];
    $custom = substr($imagecustom, 12);

    echo "<div>";
    echo "<img src='./kaos_custom/kaos.png' style='width: 40vw; height: auto;'>";
    echo "<img src='./kaos_custom/".$custom."' style='width: 16vw; height: auto; position: absolute; top: 70vh; left: 43vw;'>";
    echo "</div>";
?>