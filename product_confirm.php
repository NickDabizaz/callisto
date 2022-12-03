<?php
require('helper.php');

if (isset($_REQUEST['product'])) {
    $name = $_REQUEST['product'];
}
if (isset($_REQUEST['submit'])) {
    header("location:product_detail.php?size=" . $_REQUEST['size'] . "&name=" . $_REQUEST['nama'] . "");
}

$curProduct = $_REQUEST['product'];

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
            background-color: lightgray;
        }
    </style>
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

        <div class="m-auto" style='width: fit-content'>
            <div class="col-sm">
                <?php
                    $select_query = "SELECT * FROM product WHERE pro_name = '$curProduct' GROUP BY pro_name";
                    $res = mysqli_query($con, $select_query);
                    $row = mysqli_fetch_assoc($res);
                    

                    echo "<img src='img_product/" . $row['pro_picture'] . "' width='300px'>";
                ?>
            </div>
            <form>
                Size : <br>

                <div class="form-check form-check-inline mb-2">
                    <input class="form-check-input" type="radio" name="size" id="size" value="s">
                    <label class="form-check-label" for="size">S</label>
                </div>

                <div class="form-check form-check-inline my-2">
                    <input class="form-check-input" type="radio" name="size" id="size" value="m">
                    <label class="form-check-label" for="size">M</label>
                </div>

                <div class="form-check form-check-inline my-2">
                    <input class="form-check-input" type="radio" name="size" id="size" value="l">
                    <label class="form-check-label" for="size">L</label>
                </div>

                <div class="form-check form-check-inline my-2">
                    <input class="form-check-input" type="radio" name="size" id="size" value="xl">
                    <label class="form-check-label" for="size">XL</label>
                </div>
                <br>
                <input type="hidden" name="nama" value="<?= $name ?>">
                <button type="submit" class="btn btn-danger mt-2" formaction="./user_home.php">CANCEL</button>
                <button type="submit" class="btn btn-success mt-2" name="submit">SUBMIT</button>
            </form>
            <div class="col-sm"></div>
        </div>
    </div>

    <!-- template detail product -->




    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        // code ajax
        qty = document.querySelector("#qty");

        function addCart() {
            //add ajax add cart
            alert('add ke carttt sebanyak' + qty.value);
        }
    </script>
</body>

</html>