<?php
require("helper.php");

$lim = $_REQUEST['lim'];

$select_query = "SELECT * FROM product WHERE pro_cust_id IS NULL GROUP BY pro_name ORDER BY pro_id asc LIMIT " . $lim;
$res = mysqli_query($con,$select_query);

$ctr = 0;

echo "<div>";
while ($row = mysqli_fetch_assoc($res)) {
	$ctr++;
    // echo    
    // "<div class='card ms-2' style='width: 19.5%; display: flex;'>
    //     <img src='img_product/".$row['pro_picture']."' class='card-img-top' width='150px' height='300px'>
    //     <div class='card-body m-auto'>
    //         <h5 class='card-title text-center'>".$row['pro_name']."</h5>
    //         <form action='product_confirm.php' method='post'>
    //             <input type='hidden' name='product_name' value='".$row['pro_picture']."'>
    //             <button type='submit' class='btn btn-primary'>CHOOSE</button>
    //         </form>
    //     </div>
    // </div>";
    
    if(($ctr-1) % 5 != 0){
        echo 
        "<a class='card ms-2' style='width: 19%; background-color: lightgray; height: fit-content;font-size: 1vw;' id='card' href='product_detail.php?product=".$row['pro_name']."'>
            <img src='img_product/" . $row['pro_picture'] . "' class='card-img-top' width='150px' height='300px'>
            <div class='card-body m-auto'>
                <div style='height: 15vh'>
                    <div class='card-title text-center fw-bolder' style=''>" . $row['pro_name'] . "</div>
                </div>
            </div>
            <div style='width: 1%'>
            </div>
        </a>";


        // echo 
        // "<div class='card ms-2' style='width: 20vw; background-color: lightgray; height: fit-content;font-size: 1vw;' id='card'>
        //     <img src='img_product/" . $row['pro_picture'] . "' class='card-img-top'>
        //     <div class='card-body m-auto'>
        //         <div style='height: 15vh'>
        //             <div class='card-title text-center fw-bolder' style=''>" . $row['pro_name'] . "</div>
        //         </div>
        //         <div class='m-auto' style='width: fit-content'>
        //             <form action='product_confirm.php' method='get'>
        //                 <input type='hidden' name='product' value='" . $row['pro_name'] . "'>
        //                 <button type='submit' class='btn btn-primary'>CHOOSE</button>
        //             </form>
        //         </div>
        //     </div>
        //     <div style='width: 2vh'>
        //     </div>
        // </div>";
    }else{
        if($ctr != 1){
            echo "</div>";
        }

        echo 
        "<div class='card-container my-2' style='flex-wrap: no-wrap;'>
            <a class='card ms-2' style='width: 19%; background-color: lightgray; height: fit-content;font-size: 1vw;' id='card' href='product_detail.php?product=".$row['pro_name']."'>
                <img src='img_product/" . $row['pro_picture'] . "' class='card-img-top' width='150px' height='300px'>
                <div class='card-body m-auto'>
                    <div style='height: 15vh'>
                        <div class='card-title text-center fw-bolder' style=''>" . $row['pro_name'] . "</div>
                    </div>
                </div>
                <div style='width: 1%'>
                </div>
            </a>";

        // echo 
        // "<div class='card-container' style='flex-wrap: no-wrap; height: 80vh;'>
        //     <div class='card ms-2' style='width: 20vw; background-color: lightgray; height: fit-content;font-size: 1vw;' id='card'>
        //         <img src='img_product/" . $row['pro_picture'] . "' class='card-img-top'>
        //         <div class='card-body m-auto'>
        //             <div style='height: 15vh'>
        //                 <div class='card-title text-center fw-bolder' style=''>" . $row['pro_name'] . "</div>
        //             </div>
        //             <div class='m-auto' style='width: fit-content'>
        //                 <form action='product_confirm.php' method='get'>
        //                     <input type='hidden' name='product' value='" . $row['pro_name'] . "'>
        //                     <button type='submit' class='btn btn-primary'>CHOOSE</button>
        //                 </form>
        //             </div>
        //         </div>
        //         <div style='width: 2vh'>
        //         </div>
        //     </div>";
    }
}
echo "</div>";

$select_query = "SELECT * FROM product where pro_cust_id is null GROUP BY pro_name";
$result = mysqli_query($con,$select_query);
$datacnt = mysqli_num_rows($result);
if($lim < $datacnt){
    echo 
    "<div>
        <button class='btn btn-light' style='width: 100%;' onclick='uplim()'>See More</button>
    </div>";
}

if ($ctr == 0) {
	echo "Belum ada Product!";
}


?>