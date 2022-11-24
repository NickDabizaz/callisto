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

        .form-container{
            width: fit-content;
            padding: 2vh;
            margin: auto;

            /* background-color: yellow; */
        }

        .nav-border{
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
        <div class="form-container">

            <h1 class="text-center">Master Barang Insert</h1>
            
            <div class="row">
                <h3 class="text-center">Form Tambah Barang</h3>
                <form role="form" action="insert.php" method="post">
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
                    
                    <div class="form-group my-2">
                        <label>Detail Baju</label>
                        <input type="text" name="detail" class="form-control">
                    </div>
                    
                    <div class="form_group my-2">
                        <label>Gambar Baju</label>
                        <input type="file" name="foto" id="imageFile" class="form-control" onchange="viewImage()">
                    </div>

                    <img id="uploadedImage" width="200" />	

                    <button type="submit" class="btn btn-primary btn-block">Tambah Item</button>
                </form>
                
            </div>
            
        </div>
    </div>
    
    <script lang="javascript">
        function viewImage(){
            // document.getElementById("uploadedImage").innerHTML = document.getElementById("imageFile").value;
            var uploadedImage = document.getElementById('uploadedImage');
            uploadedImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>