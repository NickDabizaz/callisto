<?php
require('helper.php');




// if (isset($_POST['btnRequest'])) {
//     if (isset($_POST['size'])) {
//         $size = $_POST['size'];
//     } else {
//         $size = "";
//     }


//     if ($size == "") {
//         $error = "Size Tidak Boleh Kosong";
//     } else {
//         $getId = mysqli_query($con, "SELECT * FROM account WHERE acc_user = '" . $_SESSION['userLogin'] . "' ");
//         $rowId = mysqli_fetch_assoc($getId);
//         $customer_id = $rowId['acc_id'];

//         $product_id = generateIdProduct();

//         if ($size == "s") {
//             $name = "Custom - Size S";
//             $price = 12000000;
//             $img = "kaos-s.jpg";
//         } else if ($size == "m") {
//             $name = "Custom - Size M";
//             $price = 17000000;
//             $img = "kaos-m.jpg";
//         } else if ($size == "l") {
//             $name = "Custom - Size L";
//             $price = 22000000;
//             $img = "kaos-l.jpg";
//         } else if ($size == "xl") {
//             $name = "Custom - Size XL";
//             $price = 27000000;
//             $img = "kaos-xl.jpg";
//         }

//         $queryInsert = "INSERT INTO product VALUES ( '" . $product_id . "' , '" . $name . "' , '" . $price . "' , 1, '" . $size . "' , '" . $detail . "' , '" . $img . "' , 1, '" . $customer_id . "')";
//         $resInsert = mysqli_query($con, $queryInsert);

//         $cartInsert = "INSERT INTO cart VALUES ('" . $customer_id . "' , '" . $product_id . "' , 1)";
//         $rescartInsert = mysqli_query($con, $cartInsert);
//         if ($resInsert) $success = 'Berhasil Custom Produk!';
//     }
// }


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
        body {
            background-color: #f7fbfc;
        }

        .nav-border {
            border-bottom: 1px solid gray;
            margin-bottom: 3vh;
            background-color: #f7fbfc;
        }

        .custom-container {
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
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item me-3">
                                <!-- lupa cara biar klik link open new windows -->
                                <a class="nav-link" href="https://www.facebook.com/Maisonfashion">
                                    <i class="fab fa-facebook"></i>
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

                            <?php
                            if (isset($_SESSION['userLogin'])) {
                                $sql = "SELECT * FROM account WHERE acc_user = '" . $_SESSION['userLogin'] . "' ";
                                $res = mysqli_query($con, $sql);
                                $rows = mysqli_fetch_assoc($res);
                            } else {
                                header("Location: login.php");
                            }

                            ?>

                            <!-- User -->
                            <div class="dropdown">
                                <a class="text-reset dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <img src="img_profile/<?= $rows['acc_profile'] ?>" class="rounded-circle" height="25" width="25" alt="" loading="lazy" />
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

    <div class="container" style="height: 119vh;">
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
                        <input class="form-check-input" type="radio" name="size" id="size" value="s" checked>
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

                    <div id="customimg">
                        <img src='./kaos_custom/kaos.png' id="kaospolos" style='width: 40vw; height: auto;'>
                        <img src="" id="customPicture" style='width: 16vw; height: auto; position: absolute; top: 53vh; left: 43vw;'>
                    </div>

                    <div class="form-group my-2">
                        Choose Custom Image :<br>
                        <input type="file" name="fileImg" id="fileImg" accept=".jpg, .jpeg, .png">
                    </div>

                    <button class="btn btn-success mt-2" name="btnRequest" onclick="submitData()">REQUEST</button>
                </form>
                <div class="col-sm"></div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start" style="border-top: 1px solid gray;height: 5vh;"> -->
        <!-- Copyright -->
        <div class="text-center p-3">
            &copy;Melvin - 221116971; Nicklaus - 221116978; Reza - 221116984; Steven T - 221116992
        </div>
        <!-- Copyright -->
    </footer>



    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        fileImg.onchange = evt => {
            const [file] = fileImg.files
            if (file) {
                $("#kaospolos").show();
                customPicture.src = URL.createObjectURL(file)
            }
        }

        function load_img() {
            $("#kaospolos").hide();
        }

        function submitData() {            
            size = $('input[name="size"]:checked').val();
            $(document).ready(function() {
                var size = $('input[name="size"]:checked').val();
                var formData = new FormData();
                var files = $('#fileImg')[0].files;
                formData.append('fileImg', files[0]);
                formData.append('size', size);

                $.ajax({
                    url: 'fetch_custom.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false                    
                });
            });
        }
    </script>
</body>

</html>