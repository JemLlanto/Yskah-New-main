<?php
include ("sessionchecker.php");
include ("connection.php");
include ("head.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css\admin_order_status.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light m-0 p-0">
        <div
            class="container-fluid ms-0 ms-md-3 d-flex align-items-center justify-content-space justify-content-md-between d-lg-none w-100">
            <div>
                <a id="off_nav_button" class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample"
                    role="button" aria-controls="offcanvasExample">
                    <span class="navbar-toggler-icon" style="width:15px"></span>
                </a>

                <a id="img" class="navbar-brand" href="admin.php">
                    <img src="img/LOGOO.png" alt="YsakaLogo" class="d-inline-block" style="width: 110px">
                </a>
            </div>

            <div class="off d-lg-none my-2">
                <button id="notif_button" class="btn p-1" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRightSmall" aria-controls="offcanvasRightSmall" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" title="Notifications">
                    <div class="orders">
                        <div class="notif">
                            <p>9+</p>
                        </div>
                        <div class="order_button">
                            <i class='bx bxs-bell'></i>
                        </div>
                    </div>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightSmall"
                    aria-labelledby="offcanvasRightLabelSmall">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabelSmall">Notifications</h5>
                        <button id="btn-close" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="notification_section">
                            <a href="#">
                                <div class="notif_container">
                                    <div class="notif_title">
                                        <p>Notification Title</p>
                                    </div>
                                    <div class="notif_message">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, sequi.
                                        </p>

                                    </div>
                                    <div class="notif_details">
                                        <p>Product name x 00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="notification_section">
                            <a href="#">
                                <div class="notif_container">
                                    <div class="notif_title">
                                        <p>Notification Title</p>
                                    </div>
                                    <div class="notif_message">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, sequi.
                                        </p>

                                    </div>
                                    <div class="notif_details">
                                        <p>Product name x 00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="notification_section">
                            <a href="#">
                                <div class="notif_container">
                                    <div class="notif_title">
                                        <p>Notification Title</p>
                                    </div>
                                    <div class="notif_message">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, sequi.
                                        </p>

                                    </div>
                                    <div class="notif_details">
                                        <p>Product name x 00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <div id="offcanvasExampleLabel"
                    class="offcanvas-title d-flex flex-row align-items-center justify-content-center justify-content-md-end me-2">
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="user-off">
                                <div class="photo ms-2 me-1">
                                    <img src="img/default-profile.jpg" alt="">
                                </div>
                                <div class="name ms-1 mt-1">
                                    <p><?php echo $_SESSION['username'] ?></p>
                                </div>
                            </div>
                        </button>
                        <ul class="dropdown-menu p-2">
                            <li>
                                <div class="drop_items ">
                                    <a class="ms-2 mt-3" href="admin_setting.php">Account</a>
                                </div>
                            </li>
                            <li>
                                <div id="log_out" class="drop_items">
                                    <form action="logout.php" method="post">
                                        <button id="log_out_button" type="submit" name="logout"
                                            class="btn p-0 ps-2 text-start">Log
                                            out</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav nav-fill gap-2 p-0">
                    <li class="nav-item ps-3 ">
                        <a class="nav-link text-dark text-start" href="admin.php">Home</a>
                    </li>
                    <li class="nav-item ps-3">
                        <a class="nav-link text-dark text-start" href="admin_products.php">Product</a>
                    </li>
                    <li class="nav-item ps-3 active">
                        <a class="nav-link text-dark text-start" href="admin_order.php">Orders</a>
                    </li>
                    <li class="nav-item ps-3">
                        <a class="nav-link text-dark text-start" href="admin_sale_report.php">Sale Report</a>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="container-fluid ms-0 ms-md-3 d-none d-md-flex align-items-center justify-content-space justify-content-md-between">
            <a id="img" class="navbar-brand" href="admin.php">
                <img src="img/LOGOO.png" alt="YsakaLogo" class="d-lg-inline-block float-start d-none"
                    style="width: 110px">
            </a>

            <div class="container navbar-collapse d-flex d-md-none" id="navbarNav">
                <ul class="navbar-nav nav-fill gap-2 p-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark " href="admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="admin-products.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark active" href="admin_order.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="admin_sale_report.php">Sale Report</a>
                    </li>

                </ul>
            </div>

            <div class="right_nav d-none d-lg-flex">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightLarge"
                    aria-controls="offcanvasRightLarge" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="Notifications">
                    <div class="orders">
                        <div class="notif">
                            <p>9+</p>
                        </div>
                        <div class="order_button">
                            <i class='bx bxs-bell'></i>
                        </div>
                    </div>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightLarge"
                    aria-labelledby="offcanvasRightLabelLarge">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabelLarge">Notifications</h5>
                        <button id="btn-close" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="notification_section">
                            <a href="#">
                                <div class="notif_container">
                                    <div class="notif_title">
                                        <p>Notification Title</p>
                                    </div>
                                    <div class="notif_message">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, sequi.
                                        </p>

                                    </div>
                                    <div class="notif_details">
                                        <p>Product name x 00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="notification_section">
                            <a href="#">
                                <div class="notif_container">
                                    <div class="notif_title">
                                        <p>Notification Title</p>
                                    </div>
                                    <div class="notif_message">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, sequi.
                                        </p>

                                    </div>
                                    <div class="notif_details">
                                        <p>Product name x 00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="notification_section">
                            <a href="#">
                                <div class="notif_container">
                                    <div class="notif_title">
                                        <p>Notification Title</p>
                                    </div>
                                    <div class="notif_message">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, sequi.
                                        </p>

                                    </div>
                                    <div class="notif_details">
                                        <p>Product name x 00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="btn-group">
                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="user">
                            <div class="name">
                                <p class="text-end mt-1"><?php echo $_SESSION['username'] ?></p>
                            </div>
                            <div class="photo">
                                <img src="img/default-profile.jpg" alt="">
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu p-2">
                        <li>
                            <div class="drop_items ">
                                <a class="me-2" href="admin_setting.php">Account</a>
                            </div>
                        </li>
                        <li>
                            <div id="log_out" class="drop_items ">
                                <form action="logout.php" method="post">
                                    <button type="submit" name="logout" class="btn p-0 py-1 text-end pe-2">Log
                                        out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="container" class="container-fluid-sm container-md rounded mb-3 mt-3 p-3">
        <div id="shipping_information"
            class="container rounded d-flex justify-content-start align-items-start flex-column mt-3 p-3">
            <div class="w-100 mb-3 d-flex align-items-center justify-content-between py-2">
                <h5 class="m-0">Shipping Information</h5>
                <p id="shipping_information_text" class="m-0">Waiting for Seller's confirmation</p>
            </div>
            <div class="w-100 d-flex align-items-center justify-content-between ">
                <p id="payment_details_text" class=" m-0 ms-2">Order ID</p>
                <p id="payment_details_text" class="m-0 me-2">000000</p>
            </div>
            <div class="w-100 d-flex align-items-center justify-content-between">
                <p id="payment_details_text" class="m-0 ms-2 ">Order Time</p>
                <p id="payment_details_text" class="m-0 me-2">mm/dd/yy</p>
            </div>

        </div>

        <div id="address"
            class="container rounded d-flex justify-content-between align-items-start flex-column mb-2 p-2">
            <div id="address_head" class="w-100 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="m-0 "><img id="location_icon" class="mb-1 me-1" src="img\location.png" alt="">Delivery
                        Address</h5>
                </div>
            </div>
            <div id="address_details" class="d-flex flex-column align-items-start ms-4 mt-2">
                <p class="m-0 mb-1 ms-2">Customer Name | 09(Customer Number)</p>
                <p class="ms-2 me-2 ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut nam molestias iste
                    voluptatum, consequatur neque! Illum odit quasi consequuntur exercitationem. Lorem, ipsum dolor sit
                    amet consectetur adipisicing elit. Modi ipsum, fugit blanditiis natus accusamus animi rem non
                    delectus repudiandae quibusdam!</p>

            </div>
        </div>

        <div id="order_item" class="rounded mt-3 p-2">

            <div id="product_details" class="w-100 rounded d-flex justify-content-between align-items-center p-2">
                <div class="product_image d-flex justify-content-center align-items-center">
                    <img src="img\homepic1.jpg" alt="" class="rounded me-2">
                    <div class="product_variation">
                        <h5>Product asd asdasd</h5>
                        <p>variation x 00</p>
                    </div>
                </div>

                <div id="product_description">
                    <div class="container d-flex align-items-center justify-content-center p-0">
                        <p id="price" class="me-2 mt-2 mb-0">₱ 00.00</p>
                    </div>
                </div>

            </div>
        </div>
        <div id="payment_details"
            class="container rounded d-flex justify-content-start align-items-start flex-column mt-3 mb-2 p-3">
            <div class="mb-3">
                <h5>Payment Details</h5>
            </div>
            <div class="w-100 d-flex align-items-center justify-content-between ">
                <p id="payment_details_text" class=" m-0 ms-2">Merchandise Subtotal</p>
                <p id="payment_details_text" class="m-0 me-2">₱ 00.00</p>
            </div>
            <div class="w-100 d-flex align-items-center justify-content-between">
                <p id="payment_details_text" class="m-0 ms-2 ">Shipping Subtotal (Luzon/Visayas/Mindanao)</p>
                <p id="payment_details_text" class="m-0 me-2">₱ 00.00</p>
            </div>
            <div class="w-100 d-flex align-items-center justify-content-between mt-3">
                <h5 class="ms-2">Total Payment</h5>
                <h5 id="total_payment" class="me-2">₱ 00.00</h5>
            </div>
        </div>
        <div id="confirm_button" class="">
            <button class="p-3 px-5 rounded">Confirm</button>
        </div>
    </div>

    <footer>
        <div class="footer_content flex-wrap">
            <div class="footer_logo">
                <img id="footer-logo" src="img\LOGO.png" alt="">
            </div>
            <div class="footer_details">
                <h4>SOCIALS</h4>
                <div class="socials">
                    <a href="#">
                        <p><i class='bx bxl-facebook-circle'></i>Facebook</p>
                    </a>
                    <a href="#">
                        <p><i class='bx bxl-tiktok'></i>Tiktok</p>
                    </a>
                    <a href="#">
                        <p><i class='bx bxl-instagram-alt'></i>Instagram</p>
                    </a>
                </div>
                <div class="copyright">
                    <p><i class='bx bx-copyright'></i>2021 Jessa Mae O. Figueroa | All Rights Reserve</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>