<nav class="navbar navbar-default">
	<div class="container-fluid">

		<ul class="nav navbar-nav">
			<li><a href="index.php"><span class="glyphicon glyphicon-list"></span> Chat Rooms</a></li>
			<li><a href="user.php"><span class="glyphicon glyphicon-user"></span> Users</a></li>
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