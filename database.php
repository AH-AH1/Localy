<?php

    $db_server = "sql107.infinityfree.com";
    $db_user = "if0_39308609";
    $db_password = "namhoff21A";
    $database = "if0_39308609_localy"; 
    $port = 3306;
    $connection = mysqli_connect($db_server, $db_user, $db_password, $database, $port);

    if($connection === false){

        die("Connection failed: " . mysqli_connect_error());

    }

?>