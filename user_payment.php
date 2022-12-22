<?php
require("helper.php");
if (isset($_REQUEST['logout'])) {
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
        body {
            background-color: #f7fbfc;
        }

        .nav-border {
            border-bottom: 1px solid gray;
            margin-bottom: 3vh;
            background-color: #f7fbfc;
        }

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

        tr {
            border: 1px solid transparent;
        }

        .prod-id {
            font-size: 10pt;
            /* background-color: red; */
        }

        .prod-name {
            margin-top: 5vh;
            font-size: 18pt;
            /* background-color: yellow; */
        }

        .prod-price {
            font-size: 14pt;
            /* background-color: pink; */
        }

        .prod-stock {
            font-size: 14pt;
            /* background-color: lightblue; */
        }

        .prod-size {
            font-size: 14pt;
            /* background-color: gray; */
        }

        .prod-list-container {
            width: fit-content;
            margin: auto;
        }

        .popup{
            position: fixed;
            height: 40vh;
            width: 50vw;
            top: 20vh;
            left: 25vw;
            background-color: white;
            border: 1px solid gray;
            padding: 3vh;
        }
    </style>
</head>

<body id="body">
    <!--Main Navigation-->
    <header>
        <!-- Jumbotron -->
        <div class="p-3 text-center bg-white nav-border">
            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center justify-content-md-start align-items-center">
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

                    <div class="col">
                        <a href="user_home.php">
                            <img src="asset/logo.png" height="70" />
                        </a>
                    </div>

                    <div class="col d-flex justify-content-center justify-content-md-end align-items-center">
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
    <!--Main Navigation-->


    <!-- tabel semua isi cart -->
    <?php //your code here  
    $nomer = 0;
    $total = 0;
    ?>
    <div class="container">
        <table class="table" style="width: 100%;">
            <!-- <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Size</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr> -->

            <?php
            $select_query = "SELECT p.pro_picture AS 'picture',p.pro_cust_id AS 'customer_id', p.pro_name AS 'nama' , p.pro_size AS 'size' , c.qty AS 'qty' , p.pro_price AS 'harga' , (c.qty * p.pro_price) AS 'subtotal' FROM cart c JOIN product p ON c.cart_pro_id = p.pro_id";
            $select = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($select)) { ?>
                <tr>

                    <td>
                        <?php if ($row['customer_id'] == null) { ?>
                            <img src='./img_product/<?= $row['picture'] ?>' width='200px'>
                        <?php } else { ?>
                            <!-- <img src='./kaos_custom/kaos.png<?= $row['picture'] ?>' width='200px'> -->
                            <img src='./kaos_custom/kaos.png' id="kaospolos" width='200px'>
                        <img src="./kaos_custom/<?= $row['picture'] ?>" id="customPicture" style='width: 4vw; height: auto; left:29vh; position: absolute; top: 27vh;'>
                    
                        <?php } ?>
                    </td>

                    <td style='width: 2vw;'></td>

                    <td style='width: 60vw;'>

                        <div class='prod-name mb-2'><?= $row['nama'] ?></div>

                        <div class='prod-price my-2'><?= rupiah($row['harga']) ?></div>

                        <div class='prod-size mt-2'> Size : <?= $row['size'] ?></div>

                        <div class='prod-stock my-2'> Stock : <?= $row['qty'] ?></div>
                    </td>

                    <!-- <td>
                        <form method='post'>
                        <div>
                        <input type='hidden' name='id' value='<?= $row['pro_id'] ?>'>
                        <button class='btn btn-primary mb-2' type='submit' name='edit'>Edit</button><br>
                        <button onclick='delete_product(this)' value='<?= $row['pro_id'] ?>' class='btn btn-danger'>Remove</button>
                                        
                        </div>
                        </form>
                    </td> -->
                </tr>
                <tr>
                    <td colspan="3">
                        <hr style="margin: 0;">
                    </td>
                </tr>
            <?php
                $total += $row['subtotal'];
            }
            ?>
            <!-- <tr>
                <td style="font-size: 14pt;">Subtotal : <?= rupiah($total); ?></td>
                <td></td>
                <td></td>
            </tr> -->
        </table>

        <!-- tombol bayar -->
        <div style="font-size: 14pt; margin-left: 3vh;" class="mb-4">
            Subtotal : <?= rupiah($total); ?>
            <button class="btn btn-primary ms-3" style="font-size: 10pt;" id="btn-bayar" onclick="pembayaran()">BAYAR</button>
        </div>
        <!-- animasi loading bayar -->
    </div>


    <script>
        function pembayaran() {

            // msg = document.querySelector("#msg");
            // msg.innerHTML = "Berhasil Bayar!";
            document.getElementById('body').innerHTML += "<div class='popup' id='popup'><div class='contain-popup' id='contain-popup'></div></div>";
            document.getElementById('contain-popup').innerHTML += "<div class='fas fa-info-circle'></div>&nbsp;Pembayaran<br><hr>Silahkan lakukan pembayaran pada rekening di bawah ini <br>Bank Indonesia (BI): 0001-01-123456-789 a.n Melvin Nicklaus Steven<br>Bank Negara Indonesia (BNI): 007-123-456-789 a.n Melvin Nicklaus Steven<br>Bank Rakyat Indonesia (BRI): 0098-01-123456-789 a.n Melvin Nicklaus Steven <br>Bank Mandiri: 008-123-456-789 a.n Melvin Nicklaus Steven<br><hr><button class='btn btn-secondary' onclick='hapus()'>OK</button>";

            //ajax bayar
            konfirmasi();
            bayar();
            btn = document.querySelector("#btn-bayar");
            btn.style.display = "none";
        }

        function hapus(){
            document.getElementById("popup").remove();
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