<nav class="navbar navbar-default"
    style="height: 70px; align-content: center; display: block; background-color: rgb(235, 235, 235);">
    <div class="container-fluid" style=" align-items: center; justify-content: space-around !important;">


        <a id="img" class="" href="../../user_landing_page.php">
            <img src="../../img/LOGOO.png" alt="YsakaLogo" class="d-inline-block" style="width: 110px">
        </a>

        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link text-dark" href="../../user_products.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../../user_cart.php">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="../../user_order.php">Orders</a>
            </li>
            <li><a href="#account" data-toggle="modal"><span class=""></span>
                    <?php echo $user; ?></a></li>
        </ul>
    </div>
</nav>