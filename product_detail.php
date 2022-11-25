<?php
require('helper.php');

$size = $_REQUEST['size'];
$picture = $_REQUEST['name'];
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

<body>
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

                            $sql = "SELECT * FROM account WHERE acc_user = '" . $_SESSION['userLogin'] . "' ";
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
    </div>


    <!-- template detail product -->
    <div class="container">
        <?php

        $sql2 = "SELECT * FROM product WHERE pro_picture = '" . $picture . "' AND pro_size = '" . $size . "' ";
        $res2 = mysqli_query($con, $sql2);
        $rows2 = mysqli_fetch_assoc($res2);

        ?>
        <div class="card mx-auto" style="width: 30rem;">
            <img src="img_product/<?= $rows2['pro_picture'] ?>" class='card-img-top' width='150px' height='300px'>
            <div class="card-body mx-auto">
                <!-- <?php isset($_REQUEST[`id product`]) ?> -->
                <h5 class="card-title"><?= $rows2['pro_name'];  ?></h5>
                <p class="card-text">Harga : <?= $rows2['pro_price'];  ?></p>
                <p class="card-text">Tersedia : <?= $rows2['pro_stock'];  ?></p>
                <p class="card-text">Size : <?= $rows2['pro_size'];  ?></p>
                <p class="card-text">Detail : <?= $rows2['pro_detail'];  ?></p>
                <input type="number" style="width:50px ;" class="mx-auto" min="1" value="1" max="$row['stok']" id="qty"> <br>
                <button class="btn btn-warning mx-auto" onclick="addCart(this)" value="<?= $rows2['pro_id'] ?>">
                    <li class=" fas fa-shopping-cart"></li> ADD TO CART
                </button>
                <div style="color:green ;">
                    <?php 
                        if($err != "")
                            echo $err;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- template detail product -->




    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        // code ajax
        qty = document.querySelector("#qty");

        function addCart(obj) {
            update_id = obj.value;
            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                    <?php $err = "BERHASIL TAMBAHKAN KE KERANJANG!" ?>
                    qty.value = "1";
                }
            }

            r.open('GET', 'fetch_add_cart.php?pro_id=' + update_id + '&qty=' + qty.value + '');
            r.send();
        }
    </script>
</body>

</html>