		<div class="col-lg-8" style="float:none;margin:auto;">
		    <div class="panel panel-default" style="height:50px;">
		        <span style="font-size:18px; margin-left:10px; position:relative; top:13px;"><strong><span
		                    id="user_details"><span class="glyphicon glyphicon-user"></span><span
		                        class="badge"><?php echo mysqli_num_rows($cmem); ?></span></span>
		                <?php echo $chatrow['chat_name']; ?></strong></span>
		        <div class="showme hidden" style="position: absolute; left:-120px; top:20px;">
		            <div class="well">
		                <strong>Room Member/s:</strong>
		                <div style="height: 10px;"></div>
		                <?php
						$rm=mysqli_query($conn,"select * from chat_member left join `user` on user.userid=chat_member.userid where chatroomid='$id'");
						while($rmrow=mysqli_fetch_array($rm)){
							?>
		                <span>
		                    <?php
								$creq=mysqli_query($conn,"select * from chatroom where chatroomid='$id'");
								$crerow=mysqli_fetch_array($creq);
								
								if ($crerow['userid']==$rmrow['userid']){
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
						if ($chatrow['userid']==$_SESSION['id']){
							?>
		            <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Lobby</a>
		            <a href="#delete_room" data-toggle="modal" class="btn btn-danger">Delete Room</a>
		            <a href="#add_member" data-toggle="modal" class="btn btn-primary">Add Member</a>
		            <?php
						}
						else{
							?>

		            <?php
						}
					?>
		        </div>
		    </div>
		    <div>
		        <div class="panel panel-default" style="height: 400px; margin-bottom: 0px">
		            <div style="height:10px;"></div>
		            <span style="margin-left:10px;font-size:18px">Welcome to Chatroom</span><br>
		            <span style="font-size:16px; margin-left:10px;"><i>Note: Avoid using foul language and hate speech to
		                    avoid banning of account</i></span>
		            <div style="height:10px;"></div>
		            <div id="chat_area" style="margin-left:10px; max-height:320px; overflow-y:scroll;">
		            </div>
		        </div>

		        <div class="input-group">
		            <input type="text" class="form-control" placeholder="Type message..." id="chat_msg" style="height:50px;">
		            <span class="input-group-btn">
		                <button class="btn btn-success" type="submit" id="send_msg" value="<?php echo $id; ?>"
		                    style="height:50px;">
		                    <span class="glyphicon glyphicon-comment"></span> Send
		                </button>
		            </span>
		        </div>

		    </div>
		</div>
		<script>
$(document).ready(function() {
    setInterval(function() {
        displayChat();
    }, 750)
})
		</script>