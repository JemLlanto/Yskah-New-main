<?php

session_start();

if (isset($_SESSION["username"]) && isset($_SESSION["userid"])) {
    $id = $_SESSION['userid'];
    header("user_landing_page.php");
} else {
    echo "<script>
    alert('You must be login to view this page');
    window.location='index.php';
    </script>";
    exit();
}
?>