<?php
	require("helper.php");
    $total = $_REQUEST['total'];
    function generateDtransId(){
        global $con;
        //cari max dari id
        $query = "SELECT MAX(dt_id) as 'id' FROM `d_trans`";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        //ambil id
        if($row['id'] == null){
            return "DT001";
        }else{
            $getId = substr($row['id'],2);
            //nambah no urut
            if($res = null) $noUrut = 0;
            $noUrut = (int) $getId;
            $noUrut++;
            $noUrut = str_pad($noUrut,3,"0",STR_PAD_LEFT);
            //return id dengan no urut naik
            return "DT" . $noUrut;
        }
    }

    function generateInvoice(){
        global $con;
        //cari max dari id
        $query = "SELECT MAX(ht_invoice) as 'invoice' FROM `h_trans`";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        if($row['invoice'] == null){
            $hasil = date("Ymd")."001";
        }else{
            $getId = substr($row['invoice'],8);
            $noUrut = (int) $getId;
            $noUrut++;
            $hasil = date("Ymd").str_pad($noUrut,3,"0",STR_PAD_LEFT);
        }
        return $hasil;
    }
    //bikin htrans (insert into htrans)
    $query_acc = "SELECT * FROM account WHERE acc_user = '".$_SESSION['userLogin']."' ";
    $res_acc = mysqli_query($con,$query_acc);
    $row_acc = mysqli_fetch_assoc($res_acc);

    $invoice = generateInvoice();
    $insert = "INSERT INTO h_trans VALUES ( '".$invoice."' , '".date("d-m-Y")."' , '".$total."' , '".$row_acc['acc_id']."' )";
    $res_insert = mysqli_query($con,$insert);

    //pindah semua isi cart ke dtrans (insert into dtrans)
    $query_cart = "SELECT p.pro_id AS 'id' ,p.pro_name AS 'nama' , p.pro_size AS 'size' , c.qty AS 'qty' , p.pro_price AS 'harga' , (c.qty * p.pro_price) AS 'subtotal' FROM cart c JOIN product p ON c.cart_pro_id = p.pro_id WHERE c.cart_customer_id = '".$row_acc['acc_id']."' ";
    $res_cart = mysqli_query($con,$query_cart);
    while($row = mysqli_fetch_assoc($res_cart)){
        $dtrans_query = "INSERT INTO d_trans VALUES ( '".generateDtransId()."' , '".$row['qty']."' , '".$row['subtotal']."' , '".$invoice."' , '".$row['id']."' )";
        $dtrans_res = mysqli_query($con,$dtrans_query);
    }

    //hapus isi semua cart 
    $delete = "DELETE FROM cart WHERE cart_customer_id = '".$row_acc['acc_id']."' ";
    $res_delete = mysqli_query($con,$delete);


    ?>
