<?php
	require("helper.php");

    $sizevalue = $_REQUEST['sizevalue'];    

    if($sizevalue == "s"){
        echo "<img src='./ukuran_kaos/kaos-s.jpg' style='width: 40vw; height: auto;'>";
    }
    else if($sizevalue == "m"){
        echo "<img src='./ukuran_kaos/kaos-m.jpg' style='width: 40vw; height: auto;'>";
    }
    else if($sizevalue == "l"){
        echo "<img src='./ukuran_kaos/kaos-l.jpg' style='width: 40vw; height: auto;'>";
    }
    else if($sizevalue == "xl"){
        echo "<img src='./ukuran_kaos/kaos-xl.jpg' style='width: 40vw; height: auto;'>";
    }
?>
	