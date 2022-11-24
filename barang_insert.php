<?php
require('helper.php');

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
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="barang_home.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="barang_insert.php">Insert</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="login.php">Logout</a>
                    </li>
                </ol>
            </nav>
        </div>
    </nav>
    <h1>Master Barang Insert</h1>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <h3>Form Tambah Barang</h3>
                <form role="form" action="insert.php" method="post">
                    <div class="form-group">
                        <label>Nama Baju</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="size" value="s">
                            <label class="form-check-label" for="size">S</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="size" value="m">
                            <label class="form-check-label" for="size">M</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="size" value="l">
                            <label class="form-check-label" for="size">L</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="size" value="xl">
                            <label class="form-check-label" for="size">XL</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Detail Baju</label>
                        <input type="text" name="detail" class="form-control">
                    </div>
                    <div class="form_group">
                        <label>Gambar Baju</label>
                        <input type="file" name="foto" id="" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Tambah Buku</button>
                </form>

            </div>

        </div>
    </div>

</body>

</html>