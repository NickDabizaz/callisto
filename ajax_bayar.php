<?php
	require("helper.php");
    if(!isset($_SESSION['userLogin'])) header('location:login.php');

    function generatePaymentID(){
        global $con;
        //cari max dari id
        $query = "SELECT MAX(pay_id) as 'id' FROM `payment`";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        //ambil id
        if($row['id'] == null){
            return "PM001";
        }else{
            $getId = substr($row['id'],2);
            //nambah no urut
            if($res = null) $noUrut = 0;
            $noUrut = (int) $getId;
            $noUrut++;
            $noUrut = str_pad($noUrut,3,"0",STR_PAD_LEFT);
            //return id dengan no urut naik
            return "PM" . $noUrut;
        }
    }

   //bikin payment (insert into payment)
    $acc_query = "SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."'"; 
    $res_acc = mysqli_query($con,$acc_query);
    $row_acc = mysqli_fetch_assoc($res_acc);

    $ht_query = "SELECT * FROM h_trans WHERE ht_customer_id = '".$row_acc['acc_id']."'"; 
    $ht_acc = mysqli_query($con,$ht_query);
    $row_ht = mysqli_fetch_assoc($ht_acc);

    $query = "INSERT INTO payment VALUES ( '".generatePaymentID()."' , '".$row_ht['ht_invoice']."' , '".$row_acc['acc_id']."' )";
    $res = mysqli_query($con , $query);

    ?>
