<?php
require('helper.php');

unset($_SESSION["idproduk"]);

if(!isset($_SESSION['userLogin'])){
    header('location: ./login.php');
}
else{
    if($_SESSION['userLogin'] != "barang"){
        header(('location: ./login.php'));
    }
}

if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $_SESSION['idproduk'] = $id;
    header('location: ./barang_edit.php');
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
        a{
            text-decoration: none;
            color: black;
            font-size: 14pt;
        }

        a:hover{
            font-weight: bold;
            color: black;
        }

        .prod-id{
            font-size: 10pt;
            /* background-color: red; */
        }

        .prod-name{
            font-size: 24pt;
            /* background-color: yellow; */
        }

        .prod-price{
            font-size: 14pt;
            /* background-color: pink; */
        }

        .prod-stock{
            font-size: 14pt;
            /* background-color: lightblue; */
        }

        .prod-size{
            font-size: 14pt;
            /* background-color: gray; */
        }

        .prod-list-container{
            width: fit-content;
            margin: auto;
        }

        /* td{
            border: 1px solid black;
        }

        th{
            border: 1px solid black;
        } */

        .nav-border{
            border: 1px solid gray;
            margin-bottom: 3vh;
        }
    </style>
</head>

<body onload="load_product()">
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container"> -->
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="barang_home.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="barang_insert.php">Insert</a>
                    </li>
                    

                    <div class="col-md-4">
                        <a href="user_home.php">
                            <img src="asset/logo.jpg" height="70" />
                        </a>
                    </div>
                    
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="login.php">Logout</a>
                    </li>
                </ol>
            </nav> -->
    
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
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <a href="user_home.php">
                            <img src="asset/logo.png" height="70" />
                        </a>
                    </div>

                    <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
                        <div class="d-flex">
                            <a href="login.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">

        <div class="prod-list-container">

            <h1 class="text-center">Product List</h1>

            <form action="" method="post">
                <table id="productlist">
                    <!-- <thead>
                    <th style="width: 5vw;">ID</th>
                    <th style="width: 10vw;">Name</th>
                    <th style="width: 10vw;">Price</th>
                    <th style="width: 5vw;">Stok</th>
                    <th style="width: 10vw;">Size</th>
                    <th style="width: 10vw;">Action</th>
                    </thead> -->

                    <!-- Isi Tabel List Product Pindah Ke File fetch_product.php -->
                </table>
            </form>
        </div>
    </div>
</body>

<script>
    function load_product() {
        productlist =  document.getElementById("productlist");		
		fetch_product();
	}

    function fetch_product() {			
		r = new XMLHttpRequest();
		r.onreadystatechange = function() {
			if ((this.readyState==4) && (this.status==200)) {
				productlist.innerHTML = this.responseText;
			}
		}

		r.open('GET', 'fetch_barang.php');
		r.send();
	}

    function delete_product(obj){;
		product_id = obj.value;

		r = new XMLHttpRequest();
		r.onreadystatechange = function() {
			if ((this.readyState==4) && (this.status==200)) {
				fetch_product();
			}
		}
			
		r.open('POST', `delete_barang.php`);
		r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		r.send(`product_id=${product_id}`);
	}
</script>

</html>