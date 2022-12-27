<?php
require('helper.php');
if (isset($_REQUEST['logout'])) {
    unset($_SESSION["userLogin"]);
    header("Location: user_home.php");
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
        body{
            background-color: #f7fbfc;
        }

        .nav-border {
            border-bottom: 1px solid gray;
            margin-bottom: 3vh;
            background-color: #f7fbfc;
        }

        div#contain-cart:hover{
            border: 10px sollid gray !important;
            box-shadow: 0px 0px 10px #888888;
        }
    </style>
</head>

<body onload="load_product()">
    <!--Main Navigation-->
    <header>
        <!-- Jumbotron -->
        <div class="p-3 text-center bg-white nav-border">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item me-3">
                                <!-- lupa cara biar klik link open new windows -->
                                <a class="nav-link" href="https://www.facebook.com/Maisonfashion">
                                    <i class="fab fa-facebook""></i>
                                </a>
                            </li>
                            <li class="nav-item me-3">
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
                                <span><i class="fas fa-tshirt"></i></span>
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
                                        <img src="img_profile/<?= $row['acc_profile'] ?>" class="rounded-circle" height="25" width="25" alt="" loading="lazy" />
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

    <?php if (isset($_SESSION['userLogin'])) { ?>
        <?php 
            $resultt = mysqli_query($con,"SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."' ");
            $rows = mysqli_fetch_assoc($resultt);

            $counter = mysqli_query($con, "SELECT COUNT(*) AS 'jumlah' FROM product p JOIN cart c on p.pro_id = c.cart_pro_id WHERE cart_customer_id = '".$rows['acc_id']."'"); 
            $ctr = mysqli_fetch_assoc($counter);

            if($ctr['jumlah'] < 2){            
        ?>
        <div class="container" style="height: 75vh;">
            <div id="semuacart">
                <!-- semua barang di cart -->

            </div>
        </div>

        <?php 
            }
            else{
        ?>

        <div class="container" style="height: fit-content;">
            <div id="semuacart">
                <!-- semua barang di cart -->

            </div>
        </div>

        <?php } ?>

    <?php } else { 
        header("Location: login.php");
        ?>
    <?php } ?>

    

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        // ajax delete
        function load_product() {
            semuacart = document.getElementById("semuacart");
            fetch_cart();
        }

        function fetch_cart() {
            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                    semuacart.innerHTML = this.responseText;
                }
            }

            r.open('GET', 'fetch_cart.php');
            r.send();
        }

        function deleteItem(obj) {
            delete_id = obj.value;
            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                    fetch_cart();
                }
            }

            r.open('GET', 'delete_cart_item.php?delete_id=' + delete_id);
            r.send();
        }
    </script>
</body>

</html>