<?php

$conn = mysqli_connect("localhost", "root", "", "thesis");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
