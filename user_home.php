<?php
require('helper.php');


global $lim;
$lim = 10;

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

    <style>
        body{
            background-color: #f7fbfc;
        }

        .nav-border {
            border-bottom: 1px solid gray;
            margin-bottom: 3vh;
            background-color: #f7fbfc;
        }

        .card-container{
            width: 100%;
            height: fit-content;
            display: flex;
            flex-wrap: nowrap;

            /* background-color: pink; */
        }

        #card:hover{
            /* width: 23% !important; */

            /* background-color: black !important; */
            /* font-size: 1.25vw !important; */
            border: 10px sollid gray !important;
            box-shadow: 0px 0px 10px #888888;
        }

        /* #card:hover > img{
            width: 100%;
            height: 400px;
        } */

        a{
            text-decoration: none;
            color: black !important;
        }

        .card{
            background-color: #f7fbfc !important;
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
                                <a class="nav-link" href="https://www.facebook.com/Maisonfashion" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="nav-item me-3">
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
                                        <li><form method="post"><button type="submit" name="logout" class="dropdown-item">Log out</button></form></li>
                                    </ul>
                                </div>
                            <?php } else { ?>
                                <a href="login.php"><button class="btn btn-primary" style="margin-top: -0.5rem;">Login</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </header>
    <!--Main Navigation-->


    <div class="container">
        <div >
            <h1 style="text-align:center;">Best Seller</h1>
            <!-- php fetch top 5/10? (pakai limit) stok di order by dari kecil ke terbesar -->
            <?php
            $select_query2 = "SELECT * FROM product GROUP BY pro_name ORDER BY pro_stock desc LIMIT 5 ";
            $res2 = mysqli_query($con, $select_query2);

            echo "<div class='card-container'>";
            while ($row2 = mysqli_fetch_assoc($res2)) {
                echo 
                "<a class='card ms-2' style='width: 19%; height: fit-content;font-size: 1vw;' id='card' href='product_detail.php?product=".$row2['pro_name']."'>
                    <img src='img_product/" . $row2['pro_picture'] . "' class='card-img-top' width='150px' height='300px'>
                    <div class='card-body m-auto'>
                        <div style='height: 15vh'>
                            <div class='card-title text-center fw-bolder' style=''>" . $row2['pro_name'] . "</div>
                        </div>
                    </div>
                    <div style='width: 1%'>
                    </div>
                </a>";
            }
            echo "</div>";
            ?>
        </div>

        <div class="my-4">
            <h1 style="text-align:center;">Recomended Product</h1>
            <!-- php fetch top 5/10? (pakai limit) stok di order by dari besar ke kecil -->
            <?php
            // $select_query3 = "SELECT * FROM product GROUP BY pro_name ORDER BY pro_stock asc LIMIT 5 ";
            $select_query3 = "SELECT * FROM product GROUP BY pro_name ORDER BY pro_price asc LIMIT 5 ";
            $res3 = mysqli_query($con, $select_query3);

            echo "<div class='card-container'>";
            while ($row3 = mysqli_fetch_assoc($res3)) {
                echo 
                "<a class='card ms-2' style='width: 19%; height: fit-content;font-size: 1vw;' id='card' href='product_detail.php?product=".$row3['pro_name']."'>
                    <img src='img_product/" . $row3['pro_picture'] . "' class='card-img-top' width='150px' height='300px'>
                    <div class='card-body m-auto'>
                        <div style='height: 15vh'>
                            <div class='card-title text-center fw-bolder' style=''>" . $row3['pro_name'] . "</div>
                        </div>
                    </div>
                    <div style='width: 1%';>
                    </div>
                </a>";
            }
            echo "</div>";
            ?>
        </div>

        <h1 style="text-align:center;">ALL Product</h1>
        <!-- php select * from product pakai AJAX -->
        <div id="all_product" style="height: auto;">
            <!-- ajax fetch_product -->
        </div>

        <h4 class="mt-4">Request Your Custom style<a href="user_custom.php" class="ms-4"><button class="btn btn-primary">Custom Request</button></a></h4>
        <!-- <a href="user_custom.php" class="text-center"><button class="btn btn-primary">Custom Request</button></a> -->

        
    </div>

    <footer class="bg-light text-center text-lg-start" style="border-top: 1px solid gray">
    <!-- Copyright -->
    <div class="text-center p-3">
        &copy;Melvin - 221116971; Nicklaus - 221116978; Reza - 221116984; Steven T - 221116992
    </div>
    <!-- Copyright -->
    </footer>
    
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        // code ajax
        function load_product() {
            lim = <?= $lim?>;
            productlist = document.getElementById("all_product");
            fetch_product();
        }

        function fetch_product() {
            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                    productlist.innerHTML = this.responseText;
                }
            }

            r.open('GET', ('fetch_product.php?lim=' + lim));
            r.send();
        }

        function uplim(){
            lim += 10;
            fetch_product();
        }
    </script>
</body>

</html>