<?php
include('../conn.php');
if (isset($_POST['fetch'])) {
	$id = $_POST['id'];

	$query = mysqli_query($conn, "SELECT * FROM `chat` LEFT JOIN `user` ON user.userid = chat.userid WHERE chatroomid = '$id' ORDER BY chat_date ASC") or die(mysqli_error($conn));
	while ($row = mysqli_fetch_array($query)) {
		$photo = !empty($row['photo']) ? $row['photo'] : 'default.jpg';
?>
		<div>
			<img src="../upload/<?php echo $photo; ?>" style="height:50px; width:50px; position:relative; top:15px; left:10px;">
			<span style="font-size:12px; position:relative; top:7px; left:20px;"><i><?php echo date('M-d-Y h:i A', strtotime($row['chat_date'])); ?></i></span><br>
			<span style="font-size:16px; position:relative; top:-2px; left:70px;"><strong><?php echo $row['uname']; ?></strong>: <?php echo $row['message']; ?></span><br>
		</div>
		<div style="height:5px;"></div>
<?php
	}
}
?>