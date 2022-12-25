<?php
require('helper.php');


if (isset($_REQUEST['confirm'])) {
    $invoice = $_REQUEST['invoice'];
    $updatequery = "update h_trans set ht_status = 'success' where ht_invoice = '" . $invoice . "'";
    mysqli_query($con, $updatequery);
}

if (isset($_REQUEST['reject'])) {
    $invoice = $_REQUEST['invoice'];
    $updatequery = "update h_trans set ht_status = 'reject' where ht_invoice = '" . $invoice . "'";
    mysqli_query($con, $updatequery);
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

        .prod-id {
            font-size: 10pt;
            /* background-color: red; */
        }

        .prod-name {
            font-size: 24pt;
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



    <div class="container" style="min-height: 80vh;">
        <table class="table">
            <tr>
                <td width='20%'>Invoice</td>
                <td width='20%'>Total</td>
                <td width='20%'>Customer ID</td>
                <td width='20%'>Status</td>
                <td width='20%'>Action</td>
            </tr>
            <?php
            $query = "SELECT ht.ht_invoice 'invoice' , ht.ht_total 'total' , ht.ht_customer_id 'id' , ht.ht_status 'status' FROM h_trans ht JOIN `account` acc ON acc.acc_id = ht.ht_customer_id";
            $res = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) { ?>
                <tr>
                    <td><?= $row['invoice'] ?></td>
                    <td><?= rupiah($row['total']) ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <?php if ($row['status'] == 'pending') { ?>
                        <td>
                            <form method="post">
                                <input type="hidden" name="invoice" value="<?= $row['invoice'] ?>">
                                <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
                                <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                            </form>
                        </td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                </tr>
            <?php } ?>
        </table>
    </div>

    <footer class="bg-light text-center text-lg-start mt-2" style="border-top: 1px solid gray">
    <!-- Copyright -->
    <div class="text-center p-3">
        &copy;Melvin - 221116971; Nicklaus - 221116978; Reza - 221116984; Steven T - 221116992
    </div>
    <!-- Copyright -->
    </footer>

</body>


</html>