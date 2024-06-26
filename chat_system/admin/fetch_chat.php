<?php
include ('../conn.php');
if (isset($_POST['fetch'])) {
	$id = $_POST['id'];

	$query = mysqli_query($conn, "SELECT * FROM chat LEFT JOIN user ON user.userid = chat.userid WHERE chatroomid = '$id' ORDER BY chat_date ASC") or die(mysqli_error($conn));
	while ($row = mysqli_fetch_array($query)) {
		?>
		<div>
			<img src="../<?php if (empty($row['photo'])) {
				echo "upload/profile.jpg";
			} else {
				echo $row['photo'];
			} ?>" style="height:30px; width:30px; position:relative; top:15px; left:10px;">
			<span
				style="font-size:12px; position:relative; top:7px; left:15px;"><i><?php echo date('M-d-Y h:i A', strtotime($row['chat_date'])); ?></i></span><br>
			<span style="font-size:20px; position:relative; top:-2px; left:50px;"><strong><?php echo $row['uname']; ?></strong>:
				<?php echo $row['message']; ?></span><br>
			<?php if (!empty($row['image'])) { ?>
				<img src="<?php echo $row['image']; ?>" style="max-width: 70%; margin-left: 50px;">
			<?php } ?>
		</div>
		<div style="height:5px;"></div>
		<?php
	}
}
?>