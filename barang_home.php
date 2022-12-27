<?php
require('helper.php');

unset($_SESSION["idproduk"]);


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

<body onload="load_product()">
    
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

    <div class="container">
        
        <div class="prod-list-container">
            <h1 class="text-center">Product List</h1>
            
            <input type="text" name="" style="width: 30vh;" id="searchtext" onkeyup="filter()"><div class="fas fa-search ms-1"></div>
            <form action="" method="post">
                <table id="productlist">

                </table>
            </form>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-2" style="border-top: 1px solid gray">
    <!-- Copyright -->
    <div class="text-center p-3">
        &copy;Melvin - 221116971; Nicklaus - 221116978; Reza - 221116984; Steven T - 221116992
    </div>
    <!-- Copyright -->
    </footer>
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

    function filter(){
        text = searchtext.value;
			
			r = new XMLHttpRequest();
			r.onreadystatechange = function() {
				if ((this.readyState==4) && (this.status==200)) {
					// Selesai insert > Bersihkan input & Refresh table list user
					productlist.innerHTML = this.responseText; 
				}
			}

			r.open('GET', `search_barang.php?text=${text}`);
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