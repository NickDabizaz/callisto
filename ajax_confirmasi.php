<?php
	require("helper.php");
    if(!isset($_SESSION['userLogin'])) header('location:login.php');

    function generateDtransId(){
        global $con;
        //cari max dari id
        $query = "SELECT MAX(acc_id) as 'dtrans' FROM `account`";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        //ambil id
        $getId = substr($row['id'],2);
        //nambah no urut
        $noUrut = (int) $getId;
        $noUrut++;
        $noUrut = str_pad($noUrut,3,"0",STR_PAD_LEFT);
        //return id dengan no urut naik
        return "AC" . $noUrut;
    }
    //bikin htrans (insert into htrans)
        #your code here

   //pindah semua isi cart ke dtrans (insert into dtrans)
        #your code here


    echo "konfirmasi";

    ?>
