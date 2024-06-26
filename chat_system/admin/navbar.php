<nav class="navbar navbar-default "
    style="height: 70px; align-content: center; display: block;  background-color: white">
    <div class="container-fluid" style=" align-items: center; justify-content: space-around !important; ">


        <ul class="nav navbar-nav" style="display: flex; justify-content: space-evenly; align-items: center;">
            <a id="img" class="" href="../../admin.php">
                <img src="../../img/LOGOO.png" alt="YsakaLogo" class="" style="width: 110px; vertical-align: baseline;">
            </a>
            <li><a href="index.php"><span class="glyphicon glyphicon-list"></span> Chat Rooms</a></li>
            <li><a href="user.php"><span class="glyphicon glyphicon-user"></span> Users</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link text-dark" href="../../admin-products.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../../admin_orders.php.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../../admin_sale_report.php">Sales Report</a>
            </li>
            <li><a href="#account" data-toggle="modal"><span class=""></span>
                    <?php echo $user; ?></a></li>

        </ul>
    </div>
</nav>