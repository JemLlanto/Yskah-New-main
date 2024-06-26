<div class="col-lg-8" style="float:none;margin:auto;">
	<div class="panel panel-default" style="height:50px; margin-bottom: 0px; background-color: rgb(248, 244, 0);">
		<span style="font-size:18px; margin-left:10px; position:relative; top:13px;"><strong><span
					id="user_details"><span class="glyphicon glyphicon-user"></span>
					Yskah</strong></span>
		<div class="showme hidden" style="position: absolute; left:-120px; top:20px; ">
			<div class="well">
				<div style="height: 10px;"></div>
				<?php
				$rm = mysqli_query($conn, "select * from chat_member left join `user` on user.userid=chat_member.userid where chatroomid='$id'");
				while ($rmrow = mysqli_fetch_array($rm)) {
					?>
					<span>
						<?php
						$creq = mysqli_query($conn, "select * from chatroom where chatroomid='$id'");
						$crerow = mysqli_fetch_array($creq);

						if ($crerow['userid'] == $rmrow['userid']) {
							?>
							<span class="glyphicon glyphicon-user"></span>
							<?php
						}

						?>
						<?php echo $rmrow['uname']; ?></span><br>
					<?php
				}

				?>

			</div>
		</div>
		<div class="pull-right" style="margin-right:10px; margin-top:7px;">
			<?php
			if ($chatrow['userid'] == $_SESSION['id']) {
				?>
				<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Lobby</a>
				<a href="#delete_room" data-toggle="modal" class="btn btn-danger">Delete Room</a>
				<a href="#add_member" data-toggle="modal" class="btn btn-primary">Add Member</a>
				<?php
			} else {
				?>

				<?php
			}
			?>
		</div>
	</div>
	<div>
		<div class="panel panel-default" style="height: 500px; margin-bottom: 0px">
			<div style="height:10px;"></div>
			<span style="margin-left:10px;font-size:18px">Welcome to Chatroom</span><br>
			<span style="font-size:16px; margin-left:10px;"><i>Note: Avoid using foul language and hate speech to
					avoid banning of account</i></span>
			<div style="height:10px;"></div>
			<div id="chat_area" style="margin-left:10px; max-height:400px; overflow-y:scroll;">
			</div>
		</div>

		<div class="input-group">
			<input type="text" class="form-control" placeholder="Type message..." id="chat_msg" style="height:50px;">
			<span class="input-group-btn">
				<input type="file" id="chat_image" style="display:none;">
				<button class="btn btn-info" type="button" id="upload_image"
					style="height:50px; background-color: rgb(255, 72, 40);">
					<span class="glyphicon glyphicon-picture"></span> Image
				</button>
				<button class="btn" type="submit" id="send_msg" value="<?php echo $id; ?>"
					style="height:50px; background-color: rgb(248, 244, 0);">
					<span class="glyphicon glyphicon-comment"></span> Send
				</button>
			</span>
		</div>


	</div>
</div>
<script>
	$(document).ready(function () {
		setInterval(function () {
			displayChat();
		}, 5000);

		$('#upload_image').click(function () {
			$('#chat_image').click();
		});

		$('#chat_image').change(function () {
			sendImage();
		});

		$('#send_msg').click(function () {
			var msg = $('#chat_msg').val();
			if (msg != '') {
				sendMessage(msg);
				$('#chat_msg').val('');
			}
		});

		function sendMessage(msg) {
			var id = $('#send_msg').val();
			$.ajax({
				type: "POST",
				url: "send_message.php",
				data: { msg: msg, id: id },
				success: function () {
					displayChat();
				}
			});
		}

		function sendImage() {
			var id = $('#send_msg').val();
			var formData = new FormData();
			formData.append('id', id);
			formData.append('image', $('#chat_image')[0].files[0]);

			$.ajax({
				type: "POST",
				url: "send_image.php",
				data: formData,
				contentType: false,
				processData: false,
				success: function () {
					displayChat();
				}
			});
		}
	});
</script>