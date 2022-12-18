<?php

require('helper.php');
$success = "";
$error = "";

function generateIdAccount()
{
    global $con;
    //cari max dari id
    $query = "SELECT MAX(acc_id) as 'id' FROM `account`";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    if ($row['id'] == null) {
        return "DT001";
    } else {
        //ambil id
        $getId = substr($row['id'], 2);
        //nambah no urut
        $noUrut = (int) $getId;
        $noUrut++;
        $noUrut = str_pad($noUrut, 3, "0", STR_PAD_LEFT);
        //return id dengan no urut naik
        return "AC" . $noUrut;
    }
}

if (isset($_REQUEST['register'])) {

    $username = $_REQUEST['username'];
    $fname = $_REQUEST['fname'];
    $email = $_REQUEST['email'];
    $telp = $_REQUEST['telp'];
    $alamat = $_REQUEST['alamat'];
    $tglLahir = $_REQUEST['tglLahir'];
    $password = $_REQUEST['password'];
    $cpassword = $_REQUEST['cpassword'];
    $gender = $_REQUEST['gender'];

    if ($username != "" && $password != "" && $cpassword != "" && $fname != "" && $email != "" && $gender != ""  && $tglLahir != "" && $alamat != "" && $telp != "") {
        if ($password == $cpassword) {
            $result = mysqli_query($con, "select * from account where acc_user = '" . $username . "' or acc_email = '" . $email . "'");

            while ($result_row = mysqli_fetch_array($result)) {
                if ($result_row["acc_user"] == $username) {
                    $error = "username sudah terdaftar!";
                } else {
                    if ($result_row['acc_email'] == $email) {
                        $error = "email sudah terdaftar!";
                    }
                }
            }

            if ($error == "") {
                $result = mysqli_query($con, "INSERT INTO `ACCOUNT` VALUES ( '" . generateIdAccount() . "' , '" . $email . "' , '" . $username . "' , '" . $fname . "' , '" . $password . "' , '" . $telp . "' , '" . $gender . "' , '" . $alamat . "' , 'no-profile.jpg' , '" . $tglLahir . "' )");
                if ($result) {
                    $error = "Register berhasil";
                } else {
                    $error = "Register gagal";
                }
            }
        } else {
            $error = "Password dan confirm password berbeda";
        }
    } else {
        $error = "Ada isian kosong!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Callisto</title>
    <style>
        body{
            background-color: #f7fbfc;
        }

        .success {
            color: rgb(50, 195, 90);
        }

        .error {
            color: rgb(185, 80, 90);
        }

        .box-register {
            width: 750px;
            height: fit-content;
            margin: auto;
            margin-top: 5vh;
            border: 1px solid gray;
            border-radius: 20px;
            padding: 20px;
            background-color: white;
            box-shadow: 5px 10px #888888;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // autoGen("", ""); 
        ?>
        <div class="box-register">

            <img src="./asset/logo.png" alt="logo callisto" width="250px" height="125px" style="margin-left:240px">


            <form action="./register.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder=" " id="username" name="username">
                    <label for="username">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder=" " id="fname" name="fname">
                    <label for="fname">Full Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="emai" class="form-control" placeholder=" " id="email" name="email">
                    <label for="email">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder=" " id="telp" name="telp">
                    <label for="telp">No Telp</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder=" " id="alamat" name="alamat">
                    <label for="alamat">Alamat</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" class="form-control" placeholder=" " id="tglLahir" name="tglLahir">
                    <label for="tglLahir">Tanggal Lahir</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder=" " id="password" name="password">
                    <label for="password">Password</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder=" " id="cpassword" name="cpassword">
                    <label for="cpassword">Confirm Password</label>
                </div>

                <div class="form-floating mb-3">
                    <h6>Gender</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="0" />
                        <label class="form-check-label" for="male">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="1" />
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>


                <div class="success">
                    <?php
                    if (isset($success)) {
                        if (strlen($success) > 0) {
                            echo $success;
                        }
                    }
                    ?>
                </div>

                <div class="error">
                    <?php
                    if (isset($error)) {
                        if (strlen($error) > 0) {
                            echo $error;
                        }
                    }
                    ?>
                </div>

                <div class="d-grid mt-4 mb-4">
                    <button type="submit" class="btn btn-dark" name="register">Register</button>
                </div>

                <div class="text-center">Already have an account? <a href="./login.php">Log In</a></div>
            </form>
        </div>
        <br><br>
    </div>

</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</html>

<!-- email, username, name, password, no telp, gender, alamat -->