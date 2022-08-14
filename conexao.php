<?php

    $server ="localhost";
    $user = "root";
    $pass = "123456";
    $bd = "glib";

    if ($conn = mysqli_connect ($server, $user, $pass, $bd)) {

        // echo "Conectado";

    } else {
        header ('Location:GLIB/index.html');
        // echo "Erro";
    }

?>