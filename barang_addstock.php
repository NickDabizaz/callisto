<?php
require('helper.php');

$err = "";

if (isset($_REQUEST['addstok'])) {
    $id = $_REQUEST['id'];
}

if (isset($_REQUEST['add'])) {
    $sql = "UPDATE product SET pro_stock = '" . $_REQUEST['qty'] . "' WHERE pro_id='" . $id . "'";
    $res = mysqli_query($con, $sql);
    if($res) $err = "BERHASIL MENAMBAH STOK SEBANYAK ".$_REQUEST['qty']." ";
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
    <h1>ADD STOCK</h1>
    <?php if($err != ""){
        echo "<div style='color:green;'>".$err."</div>";
    } ?>
    <?php
    $query = "SELECT * FROM product WHERE pro_id='" . $id . "'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="card mx-auto" style="width: 30rem;">
        <img src="asset/logo.jpg" class="card-img-top" width='150px' height='300px'>
        <div class="card-body mx-auto">
            <h5 class="card-title"><?= $row['pro_nama'] ?></h5>
            <p class="card-text"><?= $row['pro_price'] ?></p>
            <p class="card-text"><?= $row['pro_stock'] ?></p>
            <p class="card-text"><?= $row['pro_size'] ?></p>
            <p class="card-text"><?= $row['pro_detail'] ?></p>
            <form action="" method="post">
                <input type="number" style="width:50px ;" class="mx-auto" min="1" value="1" id="qty">
                <button type="submit" name="add" class="btn btn-primary">ADD STOK</button>
            </form>
        </div>
    </div>

</body>

</html>