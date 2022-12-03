<?php
require('helper.php');
if (isset($_REQUEST['logout'])) {
    unset($_SESSION["userLogin"]);
}

if (isset($_REQUEST['cancel'])) {
    $invoice = $_REQUEST['invoice'];
    $updatequery = "update h_trans set ht_status = 'cancel' where ht_invoice = '" . $invoice . "'";
    mysqli_query($con, $updatequery);
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
        .nav-border {
            border: 1px solid gray;
            margin-bottom: 3vh;
        }

        .round {
            position: absolute;
            bottom: 0;
            right: 0;
            left: 56%;
            top: 44%;
            background: #00B4FF;
            width: 32px;
            height: 32px;
            line-height: 33px;
            text-align: center;
            border-radius: 50%;
            overflow: hidden;
        }

        .round input[type="file"] {
            position: absolute;
            transform: scale(2);
            opacity: 0;
        }

        input[type=file]::-webkit-file-upload-button {
            cursor: pointer;
        }

        .fotoprofile {
            border-radius: 50%;
            border: 8px solid #DCDCDC;
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

    <div class="container">
        <h1 class="text-center">Profile</h1>

        <div class="row" style="display: block;">
            <div class="col-lg-4 m-auto">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <?php
                        $query = "SELECT * FROM account WHERE acc_user = '" . $_SESSION['userLogin'] . "'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <form method="post" class="form" id="form" enctype="multipart/form-data">
                            <img src="./img_profile/<?php echo $row['acc_profile']; ?>" class="fotoprofile" width="150px" height="150px" title="<?php echo $row['acc_profile']; ?>">
                            <!-- gnti profile -->
                            <div class="round">
                                <input type="hidden" name="id" value="<?php echo $row['acc_id']; ?>">
                                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                                <i class="fa fa-camera" style="color: #fff;"></i>
                            </div>
                        </form>

                        <h5 class="my-3"><?php echo $row['acc_name'];
                                            ?></h5>
                        <p class="text-muted mb-1"><?php echo $row['acc_id'];
                                                    ?></p>
                        <p class="text-muted mb-4"><?php echo $row['acc_alamat'];
                                                    ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 m-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ID</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo $row['acc_id'];
                                    ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Username</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo $row['acc_user'];
                                    ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo $row['acc_name'];
                                    ?></p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo $row['acc_email'];
                                    ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo $row['acc_telp'];
                                    ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo $row['acc_alamat'];
                                    ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <tr>
                <td>Invoice</td>
                <td>Total</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            <?php
            $query = "SELECT ht.ht_invoice 'invoice' , ht.ht_total 'total' , ht.ht_status 'status' FROM h_trans ht JOIN `account` acc ON acc.acc_id = ht.ht_customer_id WHERE acc.acc_user ='".$_SESSION['userLogin']."'";
            $res = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?= $row['invoice'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <?php if ($row['status'] == 'pending') { ?>
                        <td>
                            <form method="post">
                                <input type="hidden" name="invoice" value="<?= $row['invoice'] ?>">
                                <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                            </form>
                        </td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                </tr>
            <?php } ?>
        </table>


    </div>
    <!--Main Navigation-->

    <!-- MDB -->
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script type="text/javascript">
        document.getElementById("image").onchange = function() {
            document.getElementById("form").submit();
        };
    </script>
    <?php
    if (isset($_FILES["image"]["name"])) {
        $id = $_POST["id"];

        $imageName = $_FILES["image"]["name"];
        $imageSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        // Image validation
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
            "
    <script>
      alert('Invalid Image Extension');
      document.location.href = './user_profile.php';
    </script>
    ";
        } elseif ($imageSize > 1200000) {
            echo
            "
    <script>
      alert('Image Size Is Too Large');
      document.location.href = './user_profile.php';
    </script>
    ";
        } else {
            $query2 = "UPDATE account SET acc_profile = '" . $_FILES["image"]["name"] . "' WHERE acc_id = '" . $id . "'";
            mysqli_query($con, $query2);
            move_uploaded_file($tmpName, 'img_profile/' . $_FILES["image"]["name"]);
            echo
            "
    <script>
    document.location.href = './user_profile.php';
    </script>
    ";
        }
    }
    ?>
</body>

</html>