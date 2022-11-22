<?php
session_start();

function alert($message)
{
    echo "<script>alert('$message');</script>";
}

//untuk membuat sebuah koneksi ke database MySQL dan dimasukkan ke variabel
$con = mysqli_connect('localhost', 'root', '', 'db_callisto');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>