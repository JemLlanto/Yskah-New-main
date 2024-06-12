<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "thesis";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error){
        die("Mission Failed" . $conn->connect_error);
    }

?>