<?php
require('helper.php');
unset($_SESSION["userLogin"]);
$error = "";

if (isset($_REQUEST["login"])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    if($username == "barang" && $password == "barang")
        $_SESSION["userLogin"] = "barang";
        header('location:barang_home.php');
    if ($username == "" || $password == ""){
        $error = "Ada isian kosong!";
    } else {

            $result = mysqli_query($con, "select * from account where acc_user = '" . $username . "' or acc_email = '" . $username . "'");
            if ($result) {
                $result_row = mysqli_fetch_array($result);
                if ($result_row != NULL) {
                    if ($result_row["acc_pass"] == $password) {
                        $_SESSION["userLogin"] = $result_row['acc_user'];
                        header('location:user_home.php');
                        // ke user home
                    } else {
                        $error = "Password salah!";
                    }
                } else {
                    $error = "Username tidak terdaftar!";
                }
            } else $error = "Username tidak terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


    <title>Callisto</title>
    <style>
        body {
            background-color: lightgray;
        }

        .error {
            color: rgb(185, 80, 90);
        }

        .box-login {
            width: 500px;
            height: fit-content;
            margin: auto;
            margin-top: 27vh;
            border: 1px solid gray;
            border-radius: 20px;
            padding: 20px;
            background-color: white;
            box-shadow: 5px 10px #888888;
        }

        button {
            background-color: transparent;
            text-decoration: underline;
            color: #2774fc;
            border: 1px solid transparent;
        }

        button:hover {
            color: #1861cd;
        }
    </style>
</head>

<body>
    <div class="box-login">
        <img src="./asset/logo.png" alt="logo" width="250px" height="125px" style="margin-left:100px">
        <form action="./login.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder=" " id="username" name="username">
                <label for="username">Username/Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" placeholder=" " id="password" name="password">
                <label for="password">Password</label>
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

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-dark" name="login">Login</button>
            </div>
        </form>

        <div class="gap-4 mt-2 text-center">
            <form action="" method="post">
                <div>Don't have an account? <a href="./register.php">Register</a></div>
            </form>
        </div>
    </div>
</body>

</html>