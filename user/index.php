<?php include('session.php'); ?>
<?php include('header.php'); ?>

<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">

			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Lobby</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="#account" data-toggle="modal"><span class="glyphicon glyphicon-lock"></span> <?php echo $user; ?></a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#photo" data-toggle="modal"><span class="glyphicon glyphicon-picture"></span> Update Photo</a></li>
						<li class="divider"></li>
						<li><a href="#logout" data-toggle="modal"><span class="glyphicon glyphicon-log-out"></span> Go back</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row" style=" display: flex; align-items:center; justify-content:center;">
			<div class="col-lg-10">
				<div class="panel panel-default" style="height:50px;">
					<span style="font-size:18px; margin-left:10px; position:relative; top:13px;"><strong><span class="glyphicon glyphicon-list"></span> List of Chat Rooms</strong></span>
					<div class="pull-right" style="margin-right:10px; margin-top:7px;">
						<a href="#add_chatroom" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</a>
					</div>
				</div>
				<table width="100%" class="table table-striped table-bordered table-hover" id="chatRoom">
					<thead>
						<tr>
							<th>Chat Room Name</th>
							<th>Date Created</th>
							<th><span class="glyphicon glyphicon-lock"></span> Password || <span class="glyphicon glyphicon-user"></span> Member</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "select * from chatroom order by date_created desc");
						while ($row = mysqli_fetch_array($query)) {
						?>
							<tr>
								<input type="hidden" value="
				<?php
							$usera = array();
							$m = mysqli_query($conn, "select * from chat_member where chatroomid='" . $row['chatroomid'] . "'");
							while ($mrow = mysqli_fetch_array($m)) {
								$usera[] = $mrow['userid'];
							}
							//1 member
							if (in_array($_SESSION['id'], $usera)) {
								echo "1";
							} else {
								//2 not member w/ pass
								if (!empty($row['chat_password'])) {
									echo "2";
								} else {
									//3 not member w/o pass
									echo "3";
								}
							}
				?>
				
				" id="status<?php echo $row['chatroomid']; ?>">
								<td>
									<?php
									$num = mysqli_query($conn, "select * from chat_member where chatroomid='" . $row['chatroomid'] . "'");
									?>
									<span class="badge"><?php echo mysqli_num_rows($num); ?></span> <?php echo $row['chat_name']; ?>
								</td>
								<td><?php echo date('M d, Y - h:i A', strtotime($row['date_created'])); ?></td>
								<td><button value="<?php echo $row['chatroomid']; ?>" class="btn btn-info join_chat"><span class="glyphicon glyphicon-comment"></span> Join</button> &nbsp;
									<?php
									if (!empty($row['chat_password'])) {
										echo '<span class="glyphicon glyphicon-lock"></span>&nbsp;';
									}
									$qq = mysqli_query($conn, "select * from chat_member where chatroomid='" . $row['chatroomid'] . "' and userid='" . $_SESSION['id'] . "'");
									if (mysqli_num_rows($qq) > 0) {
										echo '<span class="glyphicon glyphicon-user"></span>';
									}
									?>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Chat Room Password -->
	<div class="modal fade" id="join_chat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" id="myModalLabel">Input Password</h4>
					</center>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form method="POST" action="confirm_password.php">
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Password:</span>
								<input type="text" style="width:350px;" class="form-control" name="chat_pass" required>
								<input type="hidden" id="chatid" name="chatid">
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Confirm</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Add Chat Room -->
	<div class="modal fade" id="add_chatroom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" id="myModalLabel">Add New Chat Room</h4>
					</center>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form>
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Chat Room Name:</span>
								<input type="text" style="width:350px;" class="form-control" id="chat_name" required>
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Password:</span>
								<input type="text" style="width:350px;" class="form-control" id="chat_password">
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="sum" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					<button type="button" class="btn btn-primary" id="addchatroom"><span class="glyphicon glyphicon-check"></span> Add</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Leave Room -->
	<div class="modal fade" id="leave_room2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" id="myModalLabel">Leaving Room...</h4>
					</center>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<h3>
							<center>Are you sure?</center>
						</h3>
						<span style="font-size: 11px;">
							<center><i>Note: Once you leave the room and you wanted to come back, password is needed for a locked room.</i></center>
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					<button type="submit" class="btn btn-warning" id="confirm_leave2"><span class="glyphicon glyphicon-check"></span> Leave</button>

				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Delete Room -->
	<div class="modal fade" id="delete_room2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" id="myModalLabel">Deleting Room...</h4>
					</center>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<h3>
							<center>Are you sure?</center>
						</h3>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					<button type="submit" class="btn btn-danger" id="confirm_delete2"><span class="glyphicon glyphicon-check"></span> Delete</button>

				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Add Member -->
	<div class="modal fade" id="add_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" id="myModalLabel">Add Member</h4>
					</center>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form method="POST" action="addnewmember.php?id=<?php echo $id; ?>">
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Select:</span>
								<select style="width:350px;" class="form-control" name="user">
									<?php
									include('../conn.php');
									$mem = array();
									$um = mysqli_query($conn, "select * from `chat_member` where chatroomid='$id'");
									while ($umrow = mysqli_fetch_assoc($um)) {
										$mem[] = $umrow['userid'];
									}
									$users = implode("', '", $mem);

									$u = mysqli_query($conn, "select * from `user` where userid not in ('" . $users . "')");
									if (mysqli_num_rows($u) < 1) {
									?>
										<option value="">No User Available</option>
										<?php
									} else {
										while ($urow = mysqli_fetch_array($u)) {
										?>
											<option value="<?php echo $urow['userid']; ?>"><?php echo $urow['uname']; ?></option>
									<?php
										}
									}

									?>
								</select>
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Add</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Logout-->
	<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" id="myModalLabel">Go back...</h4>
					</center>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<center><strong><span style="font-size: 15px;">Username: <?php echo $user; ?></span></strong></center>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					<a href="logout.php" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span> Go back</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Update Photo-->
	<div class="modal fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" id="myModalLabel">Uploading Photo...</h4>
					</center>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form method="POST" enctype="multipart/form-data" action="update_photo.php">
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Photo:</span>
								<input type="file" style="width:350px;" class="form-control" name="image">
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span> Upload</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Account-->
	<div class="modal fade" id="account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<center>
						<h4 class="modal-title" id="myModalLabel">My Account</h4>
					</center>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form method="POST" action="update_account.php">
							<div style="height: 10px;"></div>
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Name:</span>
								<input type="text" style="width:350px;" class="form-control" name="mname" value="<?php echo $srow['uname']; ?>">
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Username:</span>
								<input type="text" style="width:350px;" class="form-control" name="musername" value="<?php echo $srow['username']; ?>">
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Password:</span>
								<input type="password" style="width:350px;" class="form-control" name="mpassword" value="<?php echo $srow['password']; ?>">
							</div>
							<hr>
							<span>Enter current password to save changes:</span>
							<div style="height: 10px;"></div>
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Password:</span>
								<input type="password" style="width:350px;" class="form-control" name="cpassword">
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon" style="width:150px;">Again:</span>
								<input type="password" style="width:350px;" class="form-control" name="apassword">
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<script src="../js/jquery.dataTables.min.js"></script>
	<script src="../js/dataTables.bootstrap.min.js"></script>
	<script src="../js/dataTables.responsive.js"></script>
	<script>
		$(document).ready(function() {

			$('#chatRoom').DataTable({
				"bLengthChange": true,
				"bInfo": true,
				"bPaginate": true,
				"bFilter": true,
				"bSort": false,
				"pageLength": 7
			});

			$('#myChatRoom').DataTable({
				"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
				"bLengthChange": false,
				"bInfo": false,
				"bPaginate": true,
				"bFilter": false,
				"bSort": false,
				"pageLength": 8
			});

			$(document).on('click', '.join_chat', function() {
				var cid = $(this).val();
				if ($('#status' + cid).val() == 1) {
					window.location.href = 'chatroom.php?id=' + cid;
				} else if ($('#status' + cid).val() == 2) {
					$('#join_chat').modal('show');
					$('.modal-body #chatid').val(cid);
				} else {
					$.ajax({
						url: "addmember.php",
						method: "POST",
						data: {
							id: cid,
						},
						success: function() {
							window.location.href = 'chatroom.php?id=' + cid;
						}
					});
				}
			});

			$(document).on('click', '#addchatroom', function() {
				chatname = $('#chat_name').val();
				chatpass = $('#chat_password').val();
				$.ajax({
					url: "add_chatroom.php",
					method: "POST",
					data: {
						chatname: chatname,
						chatpass: chatpass,
					},
					success: function(data) {
						window.location.href = 'chatroom.php?id=' + data;
					}
				});

			});
			//
			$(document).on('click', '.delete2', function() {
				var rid = $(this).val();
				$('#delete_room2').modal('show');
				$('.modal-footer #confirm_delete2').val(rid);
			});

			$(document).on('click', '#confirm_delete2', function() {
				var nrid = $(this).val();
				$('#delete_room2').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$.ajax({
					url: "deleteroom.php",
					method: "POST",
					data: {
						id: nrid,
						del: 1,
					},
					success: function() {
						window.location.href = 'index.php';
					}
				});
			});

			$(document).on('click', '.leave2', function() {
				var rid = $(this).val();
				$('#leave_room2').modal('show');
				$('.modal-footer #confirm_leave2').val(rid);
			});

			$(document).on('click', '#confirm_leave2', function() {
				var nrid = $(this).val();
				$('#leave_room2').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				$.ajax({
					url: "leaveroom.php",
					method: "POST",
					data: {
						id: nrid,
						leave: 1,
					},
					success: function() {
						window.location.href = 'index.php';
					}
				});
			});

		});
	</script>
</body>

</html>