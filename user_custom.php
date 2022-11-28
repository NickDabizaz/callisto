<?php
require('helper.php');
if(!isset($_SESSION['userLogin'])) header('location:login.php');


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
        .nav-border{
            border: 1px solid gray;
            margin-bottom: 3vh;
        }

        .custom-container{
            width: 40vw;
            padding: 2vh;
            margin: auto;

            /* background-color: yellow; */
        }
    </style>
</head>

<body onload="load_img()">
    <!--Main Navigation-->
    <header>
        <!-- Jumbotron -->
        <div class="p-3 text-center bg-white nav-border">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item me-3 me-lg-0 mt-4">
                                <!-- lupa cara biar klik link open new windows -->
                                <a class="nav-link" href="https://www.facebook.com/Maisonfashion">
                                    <i class="fab fa-facebook" style="height:50px ; width:50px ;"></i>
                                </a>
                            </li>
                            <li class="nav-item me-3 me-lg-0 ms-2 mt-4">
                                <a class="nav-link" href="https://www.instagram.com/maisonde_fashion/">
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

                            <?php

                                $sql = "SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."' ";
                                $res = mysqli_query($con, $sql);
                                $rows = mysqli_fetch_assoc($res);

                            ?>

                            <!-- User -->
                            <div class="dropdown">
                                <a class="text-reset dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <img src="img_profile/<?= $rows['acc_profile'] ?>" class="rounded-circle" height="25" alt="" loading="lazy" />
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="user_profile.php">My profile</a></li>
                                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->



    </header>
    <!--Main Navigation-->

        <div class="container">
            <div class="custom-container">

                <h1 class="text-center">CUSTOM</h1>
                <div class="row">
                    <div class="col-sm"></div>
                    <form>
                        Size : <br>
                        
                        <div class="form-check form-check-inline mb-2">
                            <input onclick="fetch_size(this)" class="form-check-input" type="radio" name="size" id="size" value="s">
                            <label class="form-check-label" for="size">S</label>
                        </div>
                        
                        <div class="form-check form-check-inline my-2">
                            <input onclick="fetch_size(this)" class="form-check-input" type="radio" name="size" id="size" value="m">
                            <label class="form-check-label" for="size">M</label>
                        </div>
                        
                        <div class="form-check form-check-inline my-2">
                            <input onclick="fetch_size(this)" class="form-check-input" type="radio" name="size" id="size" value="l">
                            <label class="form-check-label" for="size">L</label>
                        </div>
                        
                        <div class="form-check form-check-inline my-2">
                            <input onclick="fetch_size(this)" class="form-check-input" type="radio" name="size" id="size" value="xl">
                            <label class="form-check-label" for="size">XL</label>
                        </div>
                        <br>

                        <div id="sizeimg">
                        </div>
                        
                        <div class="form-group my-2">
                            <label for="detail">Detail</label>
                            <input type="text" class="form-control" id="detail" aria-describedby="emailHelp" placeholder="Detail Custom here...">
                        </div>
                        
                        <button type="submit" class="btn btn-success mt-2" name="btnRequest">REQUEST</button>
                    </form>
                    <div class="col-sm"></div>
                </div>
            </div>
        </div>
        
        

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>

<script>
    function load_img() {
        sizeimg =  document.getElementById("sizeimg");
	}

    function fetch_size(obj) {	
        sizevalue = obj.value    
		r = new XMLHttpRequest();
		r.onreadystatechange = function() {
			if ((this.readyState==4) && (this.status==200)) {
				sizeimg.innerHTML = this.responseText;
			}
		}

        r.open('POST', `fetch_size.php`);
		r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		r.send(`sizevalue=${sizevalue}`);
	}    
</script>
</html>