<nav class="navbar navbar-default" style="height: 70px; align-content: center; display: block">
    <div class="container-fluid" style=" align-items: center; justify-content: space-around !important;">
        <div class="navbar-header">
        </div>

        <ul class="nav navbar-nav">
            <li><a href="/Yskah-new-main/user_landing_page.php"><span class="glyphicon glyphicon-home"></span> Home</a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#account" data-toggle="modal"><span class="glyphicon glyphicon-lock"></span>
                    <?php echo $user; ?></a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#photo" data-toggle="modal"><span class="glyphicon glyphicon-picture"></span> Update
                            Photo</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>