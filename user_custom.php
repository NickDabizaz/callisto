<?php
require('helper.php');

function generateIdProduct(){
    global $con;
    //cari max dari id
    $query = "SELECT MAX(pro_id) as 'id' FROM `product`";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    //ambil id
    $getId = substr($row['id'],2);
    //nambah no urut
    $noUrut = (int) $getId;
    $noUrut++;
    $noUrut = str_pad($noUrut,3,"0",STR_PAD_LEFT);
    //return id dengan no urut naik
    return "PD" . $noUrut;
}

if(!isset($_SESSION['userLogin'])) header('location:login.php');

if(isset($_POST['btnRequest'])){
    if(isset($_POST['size'])){
        $size = $_POST['size'];
    }
    else{
        $size = "";
    }
    
    $detail = $_POST['detail'];

    if($size == ""){
        $error = "Size Tidak Boleh Kosong";
    }
    else{
        if($detail == ""){
            $error = "Detail Custom Harus Diisi";
        }
        else{
            $getId = mysqli_query($con, "SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."' ");
            $rowId = mysqli_fetch_assoc($getId);
            $customer_id = $rowId['acc_id'];

            $product_id = generateIdProduct();

            if($size == "s"){                
                $name = "Custom - Size S";
                $price = 12000000;
                $img = "kaos-s.jpg";
            }
            else if($size == "m"){                
                $name = "Custom - Size M";
                $price = 17000000;
                $img = "kaos-m.jpg";
            }
            else if($size == "l"){                
                $name = "Custom - Size L";
                $price = 22000000;
                $img = "kaos-l.jpg";
            }
            else if($size == "xl"){                
                $name = "Custom - Size XL";
                $price = 27000000;
                $img = "kaos-xl.jpg";
            }

            $queryInsert = "INSERT INTO product VALUES ( '".$product_id."' , '".$name."' , '".$price."' , 1, '".$size."' , '".$detail."' , '".$img."' , 1, '".$customer_id."')";
            $resInsert = mysqli_query($con, $queryInsert);

            $cartInsert = "INSERT INTO cart VALUES ('".$customer_id."' , '".$product_id."' , 1)";
            $rescartInsert = mysqli_query($con, $cartInsert);
            if($resInsert) $success = 'Berhasil Custom Produk!';
        }
    }        
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Callisto</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />

    <style>
        .nav-border{
            border: 1px solid gray;
            margin-bottom: 3vh;
        }

        .custom-container{
            width: 40vw;
            padding: 2vh;
            margin: auto;

            /* background-color: yellow; */
        }
        .error {
            color: rgb(185, 80, 90);
        }
        .success {
            color: green;
        }
    </style>
</head>

<body onload="load_img()">
    <!--Main Navigation-->
    <header>
        <!-- Jumbotron -->
        <div class="p-3 text-center bg-white nav-border">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item me-3 me-lg-0 mt-4">
                                <!-- lupa cara biar klik link open new windows -->
                                <a class="nav-link" href="https://www.facebook.com/Maisonfashion">
                                    <i class="fab fa-facebook" style="height:50px ; width:50px ;"></i>
                                </a>
                            </li>
                            <li class="nav-item me-3 me-lg-0 ms-2 mt-4">
                                <a class="nav-link" href="https://www.instagram.com/maisonde_fashion/">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <a href="user_home.php">
                            <img src="asset/logo.png" height="70" />
                        </a>
                    </div>

                    <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
                        <div class="d-flex">
                            <!-- Cart -->
                            <a class="text-reset me-3" href="user_cart.php">
                                <span><i class="fas fa-shopping-cart"></i></span>
                                <span class="badge rounded-pill badge-notification bg-danger"></span>
                            </a>
                            <a class="text-reset me-3" href="user_custom.php">
                                <span><i class="fas fa-palette"></i></span>
                                <span class="badge rounded-pill badge-notification bg-danger"></span>
                            </a>

                            <?php

                                $sql = "SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."' ";
                                $res = mysqli_query($con, $sql);
                                $rows = mysqli_fetch_assoc($res);

                            ?>

                            <!-- User -->
                            <div class="dropdown">
                                <a class="text-reset dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <img src="img_profile/<?= $rows['acc_profile'] ?>" class="rounded-circle" height="25" alt="" loading="lazy" />
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="user_profile.php">My profile</a></li>
                                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->



    </header>
    <!--Main Navigation-->

        <div class="container">
            <div class="custom-container">

                <h1 class="text-center">CUSTOM</h1>
                <div class="row">
                    <div class="col-sm"></div>
                    <div class="error">
                        <?php
                        if (isset($error)) {
                            if (strlen($error) > 0) {
                                echo $error;
                            }
                        }
                        ?>
                    </div>
                    <div class="success">
                        <?php
                        if (isset($success)) {
                            if (strlen($success) > 0) {
                                echo $success;
                            }
                        }
                        ?>
                    </div>
                    <form method="post">
                        Size : <br>
                        
                        <div class="form-check form-check-inline mb-2">
                            <input onclick="fetch_size(this)" class="form-check-input" type="radio" name="size" id="size" value="s">
                            <label class="form-check-label" for="size">S</label>
                        </div>
                        
                        <div class="form-check form-check-inline my-2">
                            <input onclick="fetch_size(this)" class="form-check-input" type="radio" name="size" id="size" value="m">
                            <label class="form-check-label" for="size">M</label>
                        </div>
                        
                        <div class="form-check form-check-inline my-2">
                            <input onclick="fetch_size(this)" class="form-check-input" type="radio" name="size" id="size" value="l">
                            <label class="form-check-label" for="size">L</label>
                        </div>
                        
                        <div class="form-check form-check-inline my-2">
                            <input onclick="fetch_size(this)" class="form-check-input" type="radio" name="size" id="size" value="xl">
                            <label class="form-check-label" for="size">XL</label>
                        </div>
                        <br>
                        
                        <div id="customimg">
                        </div>

                        <div class="form-group my-2">                            
                            Choose Custom Image :<br>
                            <input type="file" name="custom" id="custom" accept=".jpg, .jpeg, .png">                            
                        </div>
                        
                        <div class="form-group my-2">
                            <label for="detail">Detail</label>
                            <input type="text" class="form-control" id="detail" name="detail" aria-describedby="emailHelp" placeholder="Detail Custom here...">
                        </div>                        
                        
                        <button type="submit" class="btn btn-success mt-2" name="btnRequest">REQUEST</button>
                    </form>
                    <div class="col-sm"></div>
                </div>
            </div>
        </div>
        
        

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>

<script>
    function load_img() {
        successmsg = document.querySelector("#successmsg");
        document.getElementById("custom").onchange = function() {
            customing = document.getElementById("custom");           
            fetch_custom(customing);            
        };
	}    
    
    function fetch_custom(imgcustom) { 
        imagecustom = imgcustom.value;             
        r = new XMLHttpRequest();
		r.onreadystatechange = function() {
			if ((this.readyState==4) && (this.status==200)) {
				customimg.innerHTML = this.responseText;
			}
		}

        r.open('POST', `fetch_custom.php`);
		r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		r.send(`imagecustom=${imagecustom}`);
    }
</script>
</html>