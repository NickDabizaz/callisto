<?php
require("helper.php");

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
        #myProgress {
            width: 100%;
            background-color: grey;
            border-radius: 10px;

        }

        #myBar {
            width: 10%;
            height: 30px;
            background-color: #04AA6D;
            text-align: center;
            /* To center it horizontally (if you want) */
            line-height: 30px;
            /* To center it vertically */
            color: white;
            border-radius: 10px;
        }

        .kotak {
            width: 300px;
            height: 100px;
            display: none;
        }

        #text {
            color: gray;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- tabel semua isi cart -->
    <?php //your code here  
    ?>
    <!-- tombol bayar -->
    <button class="btn btn-primary" onclick="animasi()">BAYAR</button>
    <!-- animasi loading bayar -->
    <div class="kotak" id="kotak">
        <div id="text">Processing...</div>
        <div id="myProgress">
            <div id="myBar">1%</div>
        </div>
    </div>
    <script>
        var i = 0;
        var elem = document.getElementById("myBar");
        var text = document.getElementById("text");
        var kotak = document.getElementById("kotak");

        // animasi
        function animasi() {
            //animasi
            if (i == 0) {
                i = 1;
                kotak.style.display = 'block';
                var width = 1;
                var id = setInterval(frame, 40);

                function frame() {
                    if (width >= 100) {
                        clearInterval(id);
                        clearInterval(t);
                        i = 0;
                        text.innerHTML = "Payment Succes!";
                        text.style.color = "green";
                        text.style.visibility = '';
                    } else {
                        width++;
                        elem.style.width = width + "%";
                        elem.innerHTML = width + "%";
                    }
                }
                var blink_speed = 200; // every 1000 == 1 second, adjust to suit
                var t = setInterval(function() {
                    text.style.visibility = (text.style.visibility == 'hidden' ? '' : 'hidden');
                    text.innerHTML = "Proccesing...";
                    text.style.color = "gray";
                }, blink_speed);
            }

            //ajax bayar
            konfirmasi();
            bayar();


        }

        function konfirmasi() {
                // bikin htrans

            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                }
            }

            r.open('POST', `ajax_confirmasi.php`);
            r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            r.send();
        }

        function bayar() {
                // bikin payment

            r = new XMLHttpRequest();
            r.onreadystatechange = function() {
                if ((this.readyState == 4) && (this.status == 200)) {
                }
            }

            r.open('POST', `ajax_bayar.php`);
            r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            r.send();
        }
    </script>
</body>

</html>