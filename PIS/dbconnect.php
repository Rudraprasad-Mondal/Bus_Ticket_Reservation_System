<?php
    $DB_HOST="localhost";
    $DB_USER="root";
    $DB_PASS="";
    $DB_NAME="database";

    $db=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
    if(mysqli_connect_error()){
        die ("Database Connection Error");
    }
?>