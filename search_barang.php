<?php
	require("helper.php");
    $text = $_REQUEST['text'];

	$select_query = "SELECT * FROM product WHERE pro_name LIKE '%".$text."%'";
	$res = $con->query($select_query);


    while($row = $res->fetch_assoc()){
        echo 
        "<tr><td colspan='4'><hr></td></tr>
        <tr>
        <td>".
                        
        //ini gambar
        "<img src='./img_product/" . $row['pro_picture'] . "' width='200px'>" .

        "</td>" .
                        
        //ini buat spasi gamabr sama tulisan
        "<td style='width: 2vw;'></td>" .

        //ini tulisannya
        "<td style='width: 30vw;'> " .
            "<div class='prod-id mb-1'>&nbsp;" . $row['pro_id'] . "</div>" .
                            
            "<div class='prod-name mb-2' style='margin-top: -1rem;'>" . $row['pro_name'] . "</div>" .
                            
            "<div class='prod-price my-2'> Rp. " . $row['pro_price'] . "</div>" .
                            
            "<div class='prod-size mt-2'> Size : " . $row['pro_size'] . "</div>" .
                        
            "<div class='prod-stock my-2'> Stock : " . $row['pro_stock'] . "</div>" .
        "</td>" .
                            
        //ini actionnya
        "<td>
            <form method='post'>
            <div>
            <input type='hidden' name='id' value='" . $row['pro_id'] . "'>
            <button class='btn btn-primary mb-2' type='submit' name='edit'>Edit</button><br>
            <button onclick='delete_product(this)' value='".$row['pro_id']."' class='btn btn-danger'>Remove</button>
                            
            </div>
            </form>
        </td>
        </tr>
                        
    ";
    }
?>