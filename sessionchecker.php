<?php

session_start();

if (isset($_SESSION["username"]) && isset($_SESSION["user_id"]) && isset($_SESSION["id"]) && isset($_SESSION["chat_name"])) {
    $user_id = $_SESSION['user_id'];
    $userid = $_SESSION['id'];
    $chat_name = $_SESSION['chat_name'];
    header("user_landing_page.php");
} else {
    echo "<script>
    alert('You must be login to view this page');
    window.location='index.php';
    </script>";
    exit();
}
?>