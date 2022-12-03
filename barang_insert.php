<?php
require('helper.php');

$err = "";

function generateIdProduct()
{
    global $con;
    //cari max dari id
    $query = "SELECT MAX(pro_id) as 'id' FROM `product`";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    //ambil id
    if ($row['id'] == null) {
        return "DT001";
    } else {
        $getId = substr($row['id'], 2);
        //nambah no urut
        $noUrut = (int) $getId;
        $noUrut++;
        $noUrut = str_pad($noUrut, 3, "0", STR_PAD_LEFT);
        //return id dengan no urut naik
        return "PD" . $noUrut;
    }
}


if (isset($_REQUEST['add'])) {
    $nama = $_REQUEST['nama'];
    $size = $_REQUEST['size'];
    $harga = $_REQUEST['harga'];
    $detail = $_REQUEST['detail'];


    if (isset($_FILES['image']["name"])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        if ($file_size > 2097152) {
            $errors[] = 'File size must be exactly 2 MB';
        }

        if (empty($errors) == true && $file_name != "") {
            move_uploaded_file($file_tmp, "img_product/" . $file_name);
        } else {
            print_r($errors);
        }

        if ($nama != "" && $size != "" && $harga != "" && $file_name != "") {
            $queryInsert = "INSERT INTO product VALUES ( '" . generateIdProduct() . "' , '" . $nama . "' , '" . $harga . "' , '50' , '" . $size . "' , '" . $detail . "' , '" . $_FILES['image']['name'] . "' , 1, NULL)";
            $resInsert = mysqli_query($con, $queryInsert);
            if ($resInsert) $err = 'Product Berhasil ditambahkan!';
        } else {
            $err = 'Field Tidak Boleh Kosong!';
        }
    } else {
        $err = "Semua harus diisi!";
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

        .form-container {
            width: fit-content;
            padding: 2vh;
            margin: auto;

            /* background-color: yellow; */
        }

        .nav-border {
            border: 1px solid gray;
            margin-bottom: 3vh;
        }
    </style>
</head>

<body>
    <header>
        <div class="p-3 text-center bg-white nav-border">
            <div class="container mt-4">
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
                        <a href="barang_home.php">
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

    <div class="container">
        <div class="form-container">

            <h1 class="text-center">Master Barang Insert</h1>

            <div class="row">
                <h3 class="text-center">Form Tambah Barang</h3>
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group my-2">
                        <label>Nama Baju</label>
                        <input type="text" name="nama" class="form-control">
                    </div>

                    <div class="form-group my-2">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control">
                    </div>

                    <div class="form-group my-2">
                        <label>Ukuran</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="size" value="s" checked>
                            <label class="form-check-label" for="size">S</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="size" value="m">
                            <label class="form-check-label" for="size">M</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="size" value="l">
                                <label class="form-check-label" for="size">L</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="size" value="xl">
                                <label class="form-check-label" for="size">XL</label>
                            </div>
                        </div>

                        <div class="form-group my-2">
                            <label>Detail Baju</label>
                            <input type="text" name="detail" class="form-control">
                        </div>

                        <div class="form_group my-2">
                            <label>Gambar Baju</label>
                            <input type="file" name="image" id="imageFile" class="form-control" onchange="viewImage()" accept=".jpg, .jpeg, .png">
                        </div>

                        <img id="uploadedImage" width="200" />

                        <button type="submit" class="btn btn-primary btn-block mt-2" name="add">Tambah Item</button>
                        <div style="color:green;"><?= $err; ?></div>
                </form>

            </div>

        </div>
    </div>

    <script lang="javascript">
        function viewImage() {
            // document.getElementById("uploadedImage").innerHTML = document.getElementById("imageFile").value;
            var uploadedImage = document.getElementById('uploadedImage');
            uploadedImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>