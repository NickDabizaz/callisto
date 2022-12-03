<?php
require("helper.php");
if(isset($_REQUEST['logout'])){
    unset($_SESSION["userLogin"]);
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
        #myProgress {
            width: 100%;
            background-color: grey;
            border-radius: 10px;

        }

        #myBar {
            width: 10%;
            height: 30px;
            background-color: #04AA6D;
            text-align: center;
            /* To center it horizontally (if you want) */
            line-height: 30px;
            /* To center it vertically */
            color: white;
            border-radius: 10px;
        }

        .kotak {
            width: 300px;
            height: 100px;
            display: none;
        }

        #text {
            color: gray;
            text-align: center;
        }
    </style>
</head>

<body>
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
                                        <img src="img_profile/<?= $row['acc_profile'] ?>" class="rounded-circle" height="25" alt="" loading="lazy" />
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="user_profile.php">My profile</a></li>
                                        <li><form method="post"><button type="submit" name="logout" class="dropdown-item">Log out</button></form></li>
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


    <!-- tabel semua isi cart -->
    <?php //your code here  
    $nomer = 0;
    $total = 0;
    ?>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>

        <?php
        $select_query = "SELECT p.pro_name AS 'nama' , p.pro_size AS 'size' , c.qty AS 'qty' , p.pro_price AS 'harga' , (c.qty * p.pro_price) AS 'subtotal' FROM cart c JOIN product p ON c.cart_pro_id = p.pro_id";
        $select = mysqli_query($con, $select_query);
        while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><?= ++$nomer; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['size']; ?></td>
                <td><?= $row['qty']; ?></td>
                <td><?= $row['harga']; ?></td>
                <td><?= $row['subtotal']; ?></td>
            </tr>
        <?php
            $total += $row['subtotal'];
        }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Subtotal : </td>
            <td><?= $total; ?></td>
        </tr>
    </table>

    <!-- tombol bayar -->
    <button class="btn btn-primary" onclick="animasi()">BAYAR</button>
    <!-- animasi loading bayar -->
    <div class="kotak" id="kotak">
        <div id="text">Processing...</div>
        <div id="myProgress">
            <div id="myBar">1%</div>
        </div>
    </div>
    <script>
        var i = 0;
        var elem = document.getElementById("myBar");
        var text = document.getElementById("text");
        var kotak = document.getElementById("kotak");

        // animasi
        function animasi() {
            //animasi
            if (i == 0) {
                i = 1;
                kotak.style.display = 'block';
                var width = 1;
                var id = setInterval(frame, 40);

                function frame() {
                    if (width >= 100) {
                        clearInterval(id);
                        clearInterval(t);
                        i = 0;
                        text.innerHTML = "Payment Succes!";
                        text.style.color = "green";
                        text.style.visibility = '';
                        var timeleft = 1;
                        var downloadTimer = setInterval(function() {
                            if (timeleft <= 0) {
                                clearInterval(downloadTimer);
                                location.reload();

                            }
                            timeleft -= 1;
                        }, 1000);

                    } else {
                        width++;
                        elem.style.width = width + "%";
                        elem.innerHTML = width + "%";
                    }
                }
                var blink_speed = 200; // every 1000 == 1 second, adjust to suit
                var t = setInterval(function() {
                    text.style.visibility = (text.style.visibility == 'hidden' ? '' : 'hidden');
                    text.innerHTML = "Proccesing...";
                    text.style.color = "gray";
                }, blink_speed);

            }

            //ajax bayar
            konfirmasi();
            bayar();

        }

        function konfirmasi() {
            // bikin htrans

            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {}
            }

            r.open('GET', 'ajax_confirmasi.php?total=<?= $total; ?>');
            r.send();
        }

        function bayar() {
            // bikin payment

            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {}
            }

            r.open('GET', `ajax_bayar.php`);
            r.send();
        }
    </script>
</body>

</html>