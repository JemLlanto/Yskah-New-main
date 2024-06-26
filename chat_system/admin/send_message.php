<?php
include ('../conn.php');
session_start();
if (isset($_POST['msg'])) {
	$msg = $_POST['msg'];
	$id = $_POST['id'];
	mysqli_query($conn, "INSERT INTO chat (chatroomid, message, userid, chat_date) VALUES ('$id', '$msg', '" . $_SESSION['id'] . "', NOW())") or die(mysqli_error());
	mysqli_query($conn, "UPDATE chatroom SET latest_message = NOW() WHERE chatroomid = '$id'") or die(mysqli_error());
}
?>