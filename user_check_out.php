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
    <link rel="stylesheet" href="css\check_out8.css" />
</head>

<body>
    <?php
    $sql = "SELECT * FROM user_table WHERE username='" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        ?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light m-0 p-0">
            <div
                class="container-fluid ms-0 ms-md-3 d-flex align-items-center justify-content-space justify-content-md-between d-lg-none w-100">
                <div>
                    <a id="off_nav_button" class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample"
                        role="button" aria-controls="offcanvasExample">
                        <span class="navbar-toggler-icon" style="width:15px"></span>
                    </a>

                    <a id="img" class="navbar-brand" href="user_landing_page.php">
                        <img src="img/LOGOO.png" alt="YsakaLogo" class="d-inline-block" style="width: 110px">
                    </a>
                </div>

                <div class="off d-lg-none my-2">
                    <button id="notif_button" class="btn p-1" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRightSmall" aria-controls="offcanvasRightSmall" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Notifications">
                        <div class="orders">
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
                            <?php
                            $notifs = mysqli_query($conn, "SELECT * FROM notification_table WHERE user_id = '" . $_SESSION["user_id"] . "' AND to_admin = '0' ORDER BY date desc");
                            while ($notif = mysqli_fetch_assoc($notifs)) {
                                $date = date("F j, Y, g:i a", strtotime($notif["date"]));
                                $user_id = $notif["user_id"]; // Assuming you have an order_id field in the notification_table
                                $title = $notif["title"];

                                // Determine the URL based on the title
                                $url = "#";
                                if ($title == "Order Placed") {
                                    $url = "user_order.php";
                                } elseif ($title == "Order Cancelled") {
                                    $url = "user_order.php";
                                } elseif ($title == "Order Confirm") {
                                    $url = "user_order_to_ship.php";
                                } elseif ($title == "Order Shipped") {
                                    $url = "user_order_shipped.php";
                                } elseif ($title == "Order Delivered") {
                                    $url = "user_order_delivered.php";
                                }
                                ?>
                                <a href="<?php echo $url; ?>" style="text-decoration: none;">
                                    <div class="notification_section">
                                        <div class="notif_container">
                                            <div class="notif_title d-flex align-content-center justify-content-between">
                                                <p class="m-0"><?php echo $notif["title"]; ?></p>
                                                <p class="m-0 mt-1" style="font-size: 15px"><?php echo $date; ?></p>
                                            </div>
                                            <div class="notif_message">
                                                <p class="m-0 ms-2">Order #: <?php echo $notif['order_number']; ?></p>
                                                <p class="ms-2"><?php echo $notif["description"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
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
                                        <a class="ms-2 mt-3" href="user_setting.php">Account</a>
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
                            <a class="nav-link text-dark text-start" href="user_landing_page.php">Home</a>
                        </li>
                        <li class="nav-item ps-3 ">
                            <a class="nav-link text-dark text-start" href="user_products.php">Product</a>
                        </li>
                        <li class="nav-item ps-3 active">
                            <a class="nav-link text-dark text-start" href="user_cart.php">Cart</a>
                        </li>
                        <li class="nav-item ps-3">
                            <a class="nav-link text-dark text-start" href="user_order.php">Orders</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="container-fluid ms-0 ms-md-3 d-none d-md-flex align-items-center justify-content-space justify-content-md-between">
                <a id="img" class="navbar-brand" href="user_landing_page.php">
                    <img src="img/LOGOO.png" alt="YsakaLogo" class="d-lg-inline-block float-start d-none"
                        style="width: 110px">
                </a>

                <div class="container navbar-collapse d-flex d-md-none" id="navbarNav">
                    <ul class="navbar-nav nav-fill gap-2 p-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark " href="user_landing_page.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark " href="user_products.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark active" href="user_cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="user_order.php">Orders</a>
                        </li>

                    </ul>
                </div>

                <div class="right_nav d-none d-lg-flex">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightLarge"
                        aria-controls="offcanvasRightLarge" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Notifications">
                        <div class="orders">
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
                            <?php
                            $notifs = mysqli_query($conn, "SELECT * FROM notification_table WHERE user_id = '" . $_SESSION["user_id"] . "' AND to_admin = '0' ORDER BY date desc");
                            while ($notif = mysqli_fetch_assoc($notifs)) {
                                $date = date("F j, Y, g:i a", strtotime($notif["date"]));
                                $user_id = $notif["user_id"]; // Assuming you have an order_id field in the notification_table
                                $title = $notif["title"];

                                // Determine the URL based on the title
                                $url = "#";
                                if ($title == "Order Placed") {
                                    $url = "user_order.php";
                                } elseif ($title == "Order Cancelled") {
                                    $url = "user_order.php";
                                } elseif ($title == "Order Confirm") {
                                    $url = "user_order_to_ship.php";
                                } elseif ($title == "Order Shipped") {
                                    $url = "user_order_shipped.php";
                                } elseif ($title == "Order Delivered") {
                                    $url = "user_order_delivered.php";
                                }
                                ?>
                                <a href="<?php echo $url; ?>" style="text-decoration: none;">
                                    <div class="notification_section">
                                        <div class="notif_container">
                                            <div class="notif_title d-flex align-content-center justify-content-between">
                                                <p class="m-0"><?php echo $notif["title"]; ?></p>
                                                <p class="m-0 mt-1" style="font-size: 15px"><?php echo $date; ?></p>
                                            </div>
                                            <div class="notif_message">
                                                <p class="m-0 ms-2">Order #: <?php echo $notif['order_number']; ?></p>
                                                <p class="ms-2"><?php echo $notif["description"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
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
                                    <a class="me-2" href="user_setting.php">Account</a>
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

        <div id="container" class="container-fluid-sm container-md rounded d-flex flex-column mb-3 mt-3 p-3">
            <div id="address" class="container rounded d-flex justify-content-start align-items-start flex-column mb-2 p-2">
                <div id="address_head" class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5><img id="location_icon" class="mb-1 me-1" src="img/location.png" alt="">Delivery Address</h5>
                    </div>
                    <div id="change_address_button" class="rounded">
                        <a href="user_setting.php"><button id="change_address" class="border rounded p-2">Edit delivery
                                details</button></a>
                    </div>
                </div>
                <div id="address_details" class="d-flex flex-column align-items-start ms-4 mt-2">
                    <p id="payment_details_text" class="m-0 mb-1 ms-2">
                        <?php echo $row['first_name'] . ' ' . $row['last_name']; ?> | <?php echo $row['phone']; ?>
                    </p>
                    <p id="payment_details_text" class="ms-2 me-2">
                        <?php echo $row['blockLot'] . ' ' . $row['subdivision'] . ', ' . $row['barangay'] . ', ' . $row['province'] . ', ' . $row['city'] . ' ' . $row['zip']; ?>
                    </p>
                </div>
            </div>

            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_POST['selected_items']) && !empty($_POST['selected_items'])) {
                $selectedItems = json_decode($_POST['selected_items'], true);
                $totalPrice = 0;
                $user_id = $_SESSION['user_id'];

                foreach ($selectedItems as $order_id) {
                    $sql = "
                SELECT o.*, GROUP_CONCAT(vc.option SEPARATOR ', ') AS variant_options
                FROM order_table o
                LEFT JOIN variant_content vc ON FIND_IN_SET(vc.variant_content_id, o.variant_content_ids)
                WHERE o.user_id = $user_id AND o.order_id = $order_id
                GROUP BY o.order_id
            ";
                    $result = $conn->query($sql);
                    if ($item = $result->fetch_assoc()):
                        ?>
                        <div id="product_details" class="w-100 rounded border d-flex justify-content-between align-items-end mb-2 p-2">
                            <div class="product_image d-flex justify-content-center align-items-center">
                                <img src="product-images/<?php echo $item['image_file']; ?>" alt="" class="rounded me-2">
                                <div class="m-0">
                                    <h5><?php echo $item['product_name'] . ' | ' . $item['variant_options']; ?></h5>
                                    <p>Php <?php echo number_format($item['price'], 2); ?> </p>
                                </div>
                            </div>
                            <div id="product_description">
                                <div class="container p-0">
                                    <p id="price" class="me-2 mt-2 mb-0 text-end">₱
                                        <?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                        $totalPrice += $item['price'] * $item['quantity'];
                    endif;
                }

                $shippingCost = 150;
                $totalPayment = $totalPrice + $shippingCost;
                ?>

                <div id="payment_details"
                    class="container rounded d-flex justify-content-start align-items-start flex-column mb-2 p-3">
                    <div class="mb-3">
                        <h5>Payment Details</h5>
                    </div>
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <p id="payment_details_text" class="m-0 ms-2">Merchandise Subtotal</p>
                        <p id="payment_details_text" class="m-0 me-2">₱ <?php echo number_format($totalPrice, 2); ?></p>
                    </div>
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <p id="payment_details_text" class="m-0 ms-2">Shipping Subtotal (
                            <b><?php echo $row['island_group']; ?></b> )
                        </p>
                        <p id="payment_details_text" class="m-0 me-2">₱ <?php echo number_format($shippingCost, 2); ?></p>
                    </div>
                    <div class="w-100 d-flex align-items-center justify-content-between mt-3">
                        <h5 class="ms-2">Total Payment</h5>
                        <h5 id="total_payment" class="me-2">₱ <?php echo number_format($totalPayment, 2); ?></h5>
                    </div>
                </div>

                <div id="place_order" class="w-100 rounded d-flex align-items-center justify-content-end">
                    <div>
                        <p class="m-0">Total Payment</p>
                        <h5 id="price" class="m-0">₱ <?php echo number_format($totalPayment, 2); ?></h5>
                    </div>
                    <button id="place_order_button" type="button" class="btn py-3 px-4 ms-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Place Order
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Payment via GCASH</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="payment" class="d-flex flex-column align-items-center p-2">
                                        <div>
                                            <p>Scan the QR code to pay</p>
                                        </div>
                                        <div>
                                            <img src="img/Gcash.jpeg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form action="user-order-form.php" method="post">
                                        <input type="hidden" name="totalPrice" value="<?php echo $totalPayment; ?>">
                                        <input type="hidden" name="title" value="Order Placed">
                                        <input type="hidden" name="selected_items" id="selected_items"
                                            value='<?php echo json_encode($selectedItems); ?>'>
                                        <input type="hidden" name="description"
                                            value="Your Order has been placed successfully. Click for more details">
                                        <input type="hidden" name="status" value="Unread">

                                        <input type="hidden" name="a_title" value="New Order">
                                        <input type="hidden" name="a_description"
                                            value="New order from <?php echo $_SESSION['username']; ?>. Click for more details">
                                        <input type="hidden" name="to_admin" value="1">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button id="done_button" type="submit" class="btn btn-primary">Done</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
    } ?>
    </div>



    <footer>
        <div class="footer_content flex-wrap flex-md-nowrap">
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