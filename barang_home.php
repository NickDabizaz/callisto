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
    <h1>Master Barang</h1>
    <form action="" method="post">
        <table border="1">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stok</th>
                <th>Size</th>
                <th>Action</th>
            </thead>
            <?php
            $query = "SELECT * FROM product";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo   "<tr>
                        <td>" . $row['pro_id'] . "</td>
                        <td>" . $row['pro_name'] . "</td>
                        <td>" . $row['pro_price'] . "</td>
                        <td>" . $row['pro_stock'] . "</td>
                        <td>" . $row['pro_size'] . "</td>
                        <td>
                        <input type='hidden' name='id' value='" . $row['pro_id'] . "'>
                        <button type='submit' name='addstok' formaction='barang_addstock.php' class='btn btn-primary'>ADD STOCK</button>
                        <button class='btn btn-primary'>DELETE</button>
                        </td>
                        </tr>
                        ";
            }
            ?>

        </table>
    </form>


</body>

</html>