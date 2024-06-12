<?php
session_start();
include ('../conn.php');

if (!isset($_SESSION['userid']) || (trim($_SESSION['userid']) == '')) {
	header('location:../');
	exit();
}

$sq = mysqli_query($conn, "select * from `user` where userid='" . $_SESSION['userid'] . "'");
$srow = mysqli_fetch_array($sq);

if ($srow['access'] != 2) {
	header('location:../');
	exit();
}

$user = $srow['username'];