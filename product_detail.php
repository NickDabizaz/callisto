<?php
require('helper.php');
if (isset($_REQUEST['logout'])) {
    unset($_SESSION["userLogin"]);
}

if (isset($_REQUEST['product'])) {
    $name = $_REQUEST['product'];
}
$err = "";

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
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body onload="load_product()">
    <!--Main Navigation-->
    <header>
        <!-- Jumbotron -->
        <div class="p-3 text-center bg-white nav-border" style="background-color: lightgray !important;">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item me-3 me-lg-0 mt-4">
                                <!-- lupa cara biar klik link open new windows -->
                                <a class="nav-link" href="https://www.facebook.com/Maisonfashion" target="_blank">
                                    <i class="fab fa-facebook" style="height:50px ; width:50px ;"></i>
                                </a>
                            </li>
                            <li class="nav-item me-3 me-lg-0 ms-2 mt-4">
                                <a class="nav-link" href="https://www.instagram.com/maisonde_fashion/" target="_blank">
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



                            <?php if (isset($_SESSION['userLogin'])) { ?>
                                <?php

                                $query = "SELECT * FROM account WHERE acc_user = '" . $_SESSION['userLogin'] . "' ";
                                $res = mysqli_query($con, $query);
                                $row = mysqli_fetch_assoc($res);

                                ?>
                                <!-- User -->
                                <div class="dropdown">
                                    <a class="text-reset dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                        <img src="img_profile/<?= $row['acc_profile'] ?>" class="rounded-circle" height="25" width='25' alt="" loading="lazy" />
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="user_profile.php">My profile</a></li>
                                        <li>
                                            <form method="post"><button type="submit" name="logout" class="dropdown-item">Log out</button></form>
                                        </li>
                                    </ul>
                                </div>
                            <?php } else { ?>
                                <a href="login.php"><button class="btn btn-primary">Login</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </header>
    <!--Main Navigation-->


        <!-- template detail product -->
        <div class="container">
            <?php

            $sql2 = "SELECT * FROM product WHERE pro_name = '" . $name . "' AND pro_size = 's' ";
            $res2 = mysqli_query($con, $sql2);
            $rows2 = mysqli_fetch_assoc($res2);

            ?>
            <div class="card mx-auto mt-4" style="width: 100%;">
                <div class='row no-gutters'>
                    <div style='width: 30%; margin-left: 5%;'>
                        <div style="margin: auto; width: fit-content;">
                            <img src="img_product/<?= $rows2['pro_picture'] ?>" class='card-img-top' style='width: 40vh; height: 40vh;'>
                        </div>
                    </div>
                    <di style="width: 60%; margin-left: 5%;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $rows2['pro_name'];  ?></h5>
                            <p class="card-text" id="harga"></p>
                            <p class="card-text">Tersedia : <?= $rows2['pro_stock'];  ?></p>

                            Size : <br>

                            <div class="form-check form-check-inline mb-2">
                                <input class="form-check-input" type="radio" name="size" id="size" value="s" onchange="update_size()" checked>
                                <label class="form-check-label" for="size">S</label>
                            </div>

                            <div class="form-check form-check-inline my-2">
                                <input class="form-check-input" type="radio" name="size" id="size" value="m" onchange="update_size()">
                                <label class="form-check-label" for="size">M</label>
                            </div>

                            <div class="form-check form-check-inline my-2">
                                <input class="form-check-input" type="radio" name="size" id="size" value="l" onchange="update_size()">
                                <label class="form-check-label" for="size">L</label>
                            </div>

                            <div class="form-check form-check-inline my-2">
                                <input class="form-check-input" type="radio" name="size" id="size" value="xl" onchange="update_size()">
                                <label class="form-check-label" for="size">XL</label>
                            </div>
                            <br>

                            <p class="card-text">Detail : <?= $rows2['pro_detail'];  ?></p>
                            <input type="number" style="width:50px ;" class="mx-auto" min="1" value="1" max="$row['stok']" id="qty"> <br><br>
                            <div id="successmsg"></div>
                            
                            <?php 
                            if(isset($_SESSION['userLogin'])){
                                ?>
                                <button class="btn btn-warning mx-auto" onclick="addCart(this)" value="<?= $name ?>">
                                    <li class=" fas fa-shopping-cart"></li> ADD TO CART
                                </button>
                                <?php
                            }else{
                                ?>
                                <span style="color: red;">Harus login untuk berbelanja</span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- template detail product -->





    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        // code ajax
        function load_product() {
            detailprodcut = document.getElementById("detailprodcut");
            qty = document.querySelector("#qty");
            harga = document.querySelector("#harga");
            successmsg = document.querySelector("#successmsg");
            fetch_harga_product();
        }

        function fetch_harga_product() {
            const sizes = document.querySelectorAll('input[name="size"]');
            var size;
            for (const s of sizes) {
                if (s.checked) {
                    size = s.value;
                }
            }
            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                    harga.innerHTML = this.responseText;
                }
            }

            r.open('GET', 'fetch_harga_product.php?name='+ '<?= $name; ?>' + '&size=' + size);
            r.send();
        }

        function update_size(){
            const sizes = document.querySelectorAll('input[name="size"]');
            var size;
            for (const s of sizes) {
                if (s.checked) {
                    size = s.value;
                }
            }
            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                    fetch_harga_product();
                }
            }

            r.open('GET', 'fetch_harga_product.php?name='+ '<?= $name; ?>' + '&size=' + size);
            r.send();
        }

        function addCart(obj) {
            name = obj.value;
            const sizes = document.querySelectorAll('input[name="size"]');
            var size;
            for (const s of sizes) {
                if (s.checked) {
                    size = s.value;
                }
            }

            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                    successmsg.innerHTML = this.responseText;
                    qty.value = "1";
                }
            }

            r.open('GET', 'fetch_add_cart.php?pro_name=' + name + '&qty=' + qty.value + '&size=' + size);
            r.send();

        }
    </script>
</body>

</html>