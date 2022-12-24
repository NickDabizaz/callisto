<?php
session_start();

if (isset($_REQUEST['logout'])) {
    unset($_SESSION["userLogin"]);
    header('location:user_home.php');
}

function alert($message)
{
    echo "<script>alert('$message');</script>";
}

//untuk membuat sebuah koneksi ke database MySQL dan dimasukkan ke variabel
$con = mysqli_connect('localhost', 'root', '', 'db_callisto');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

?>