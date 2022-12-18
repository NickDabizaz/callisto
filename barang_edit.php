<?php
require('helper.php');

$err = "";


if (!isset($_SESSION['idproduk'])) {
    header('location: ./barang_home.php');
} else {
    $id = $_SESSION['idproduk'];
}


if (isset($_POST['back'])) {
    header('location: ./barang_home.php');
}

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
        document.location.href = './barang_edit.php';
        </script>
        ";
    } elseif ($imageSize > 1200000) {
        echo
        "
        <script>
        alert('Image Size Is Too Large');
        document.location.href = './barang_edit.php';
        </script>
        ";
    } else {
        $query2 = "UPDATE product SET pro_picture = '" . $_FILES["image"]["name"] . "' WHERE pro_id = '" . $id . "'";
        mysqli_query($con, $query2);
        move_uploaded_file($tmpName, 'img_product/' . $_FILES["image"]["name"]);
        echo
        "
        <script>
            document.location.href = './barang_edit.php';
        </script>
        ";
    }
}

if (isset($_POST['edit'])) {
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $detail = $_POST['detail'];

    if ($price == "") {
        $err = "Price tidak boleh kosong";
    } else {
        if (strpos($detail, "'") !== false) {
            $modify = str_split($detail);
            for ($i = 0; $i < count($modify); $i++) {
                if ($modify[$i] == "'") {
                    $modify[$i] = "\'";
                }
            }

            $detail = join("", $modify);
        }

        $updatequery = "update product set pro_price = '" . $price . "', pro_stock = '" . $stock . "', pro_detail = '" . $detail . "' where pro_id = '" . $id . "'";
        mysqli_query($con, $updatequery);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Barang</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        a {
            text-decoration: none;
            color: black;
            font-size: 14pt;
        }

        a:hover {
            font-weight: bold;
            color: black;
        }

        .round {
            position: absolute;
            bottom: 0;
            right: 0;
            left: 85%;
            top: 48%;
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
        body{
            background-color: #f7fbfc;
        }

        .nav-border {
            border-bottom: 1px solid gray;
            margin-bottom: 3vh;
            background-color: #f7fbfc;
        }
    </style>
</head>

<body>
    <header>
        <div class="p-3 text-center bg-white nav-border">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item">
                                <a href="barang_home.php">Home</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a href="barang_insert.php">Insert</a>
                            </li>
                            <li class="nav-item">
                                <a href="barang_admin.php">Admin</a>
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
                            <a href="user_home.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <h1 class="text-center">EDIT BARANG</h1>
    <?php
    $query = "SELECT * FROM product WHERE pro_id='" . $id . "'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="card mx-auto" style="width: 30rem;">
        <form method="post" class="form" id="form" enctype="multipart/form-data">
            <img src="./img_product/<?php echo $row['pro_picture']; ?>" class="card-img-top" width="150px" height="550px" title="<?php echo $row['pro_picture']; ?>">
            <!-- gnti profile -->
            <div class="round">
                <input type="hidden" name="id" value="<?php echo $row['pro_id']; ?>">
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                <i class="fa fa-camera" style="color: #fff;"></i>
            </div>
        </form>
        <form method="post">
            <div class="card-body mx-auto">
                <?php
                if ($err != "") {
                    echo "<div style='color:green;'>" . $err . "</div>";
                }
                ?>
                <h5><?= $row['pro_name'] ?></h5>
                <p style="font-weight: 500;">Size : <?= $row['pro_size'] ?></p>
                <div class="form-floating mb-3">
                    Product Price : (In Rupiah) <br>
                    <input type="text" class="form-control" id="price" name="price" value="<?= $row['pro_price'] ?>" style="height: 35px;">
                </div>
                <div class="form-floating mb-3">
                    Product Stock : <br>
                    <input type="number" class="form-control" min="0" id="stock" name="stock" value="<?= $row['pro_stock'] ?>" style="height: 35px;">
                </div>
                <div class="form-floating mb-3">
                    Product Detail : <br>
                    <input type="text" class="form-control" id="detail" name="detail" value="<?= $row['pro_detail'] ?>" style="height: 35px;">
                </div>
                <button type="submit" name="edit" class="btn btn-primary">Save</button>
                <button type="submit" name="back" class="btn btn-primary">Back</button>
            </div>
        </form>
    </div>

    <footer class="bg-light text-center text-lg-start mt-4" style="border-top: 1px solid gray">
    <!-- Copyright -->
    <div class="text-center p-3">
        &copy;Melvin - 221116971; Nicklaus - 221116978; Reza - 221116984; Steven T - 221116992
    </div>
    <!-- Copyright -->
    </footer>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script type="text/javascript">
        document.getElementById("image").onchange = function() {
            document.getElementById("form").submit();
        };
    </script>
</body>

</html>