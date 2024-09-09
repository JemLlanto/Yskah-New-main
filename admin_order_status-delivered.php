<?php
include ("sessionchecker.php");
include ("connection.php");
include ("head.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_order'])) {
    $user_id = intval($_POST['user_id']);
    $order_number = intval($_POST['order_number']);

    // Update order status
    $sql_update = "
        UPDATE order_items 
        SET status = CASE 
            WHEN status = 'Pending' THEN 'Shipping' 
            WHEN status = 'Shipping' THEN 'Shipped' 
            WHEN status = 'Shipped' THEN 'Delivered' 
        END
        WHERE user_id = ? AND order_number = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $user_id, $order_number);
    $stmt_update->execute();
    $stmt_update->close();

    // Redirect after updating
    header("Location: admin_order.php");
    exit();
}
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

                    <a id="img" class="navbar-brand" href="admin.php">
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
                            $notifs = mysqli_query($conn, "SELECT * FROM notification_table WHERE  to_admin = '1' ORDER BY date desc");
                            while ($notif = mysqli_fetch_assoc($notifs)) {
                                $date = date("F j, Y, g:i a", strtotime($notif["date"]));
                                $user_id = $notif["user_id"]; // Assuming you have an order_id field in the notification_table
                                $title = $notif["title"];

                                ?>
                                <a href="admin_order.php" style="text-decoration: none;">
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
                                        <img src="profile_picture/<?php echo $row['image_file'] ?>" alt="">
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
                            $notifs = mysqli_query($conn, "SELECT * FROM notification_table WHERE  to_admin = '1' ORDER BY date desc");
                            while ($notif = mysqli_fetch_assoc($notifs)) {
                                $date = date("F j, Y, g:i a", strtotime($notif["date"]));
                                $user_id = $notif["user_id"]; // Assuming you have an order_id field in the notification_table
                                $title = $notif["title"];

                                ?>
                                <a href="admin_order.php" style="text-decoration: none;">
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
                                    <img src="profile_picture/<?php echo $row['image_file'] ?>" alt="">
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



        <?php
        $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
        $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $order_number = isset($_GET['order_number']) ? $_GET['order_number'] : 0;

        // Prepare and execute the SQL statement
        $sql = "SELECT oi.*, u.first_name, u.last_name, u.phone, u.blockLot, u.subdivision, u.barangay, u.province, u.city, u.zip
        FROM order_items oi
        LEFT JOIN user_table u ON oi.user_id = u.user_id
        WHERE oi.user_id = ? AND oi.order_number = ? AND oi.status = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $order_number, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        ?>

        <?php if ($items): ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div id="container" class="container-fluid-sm container-md rounded mb-3 mt-3 p-3">
                    <div id="shipping_information"
                        class="container rounded d-flex justify-content-start align-items-start flex-column mt-3 p-3">
                        <div class="w-100 mb-3 d-flex align-items-center justify-content-between py-2">
                            <h5 class="m-0">Shipping Information</h5>
                            <p id="shipping_information_text" class="m-0">
                                <?php
                                switch ($status) {
                                    case 'Pending':
                                        echo 'Waiting for Seller\'s confirmation';
                                        break;
                                    case 'Shipping':
                                        echo 'The seller is preparing the orders.';
                                        break;
                                    case 'Shipped':
                                        echo 'The order has been shipped.';
                                        break;
                                    case 'Delivered':
                                        echo 'The order has been delivered.';
                                        break;
                                    default:
                                        echo 'Unknown status';
                                        break;
                                }
                                ?>
                            </p>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between">
                            <p id="payment_details_text" class="m-0 ms-2">Order ID</p>
                            <p id="payment_details_text" class="m-0 me-2">
                                <?php echo htmlspecialchars($items[0]['order_number']); ?>
                            </p>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between">
                            <p id="payment_details_text" class="m-0 ms-2">Order Time</p>
                            <p id="payment_details_text" class="m-0 me-2">
                                <?php echo date('m/d/Y H:i:s', strtotime($items[0]['order_date'])); ?>
                            </p>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between">
                            <p id="payment_details_text" class="m-0 ms-2">Delivered Time</p>
                            <p id="payment_details_text" class="m-0 me-2">
                                <?php echo date('m/d/Y H:i:s', strtotime($items[0]['delivered_date'])); ?>
                            </p>
                        </div>

                    </div>

                    <div id="address"
                        class="container rounded d-flex justify-content-between align-items-start flex-column mb-2 p-2">
                        <div id="address_head" class="w-100 d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="m-0"><img id="location_icon" class="mb-1 me-1" src="img\location.png" alt="">Delivery
                                    Address</h5>
                            </div>
                        </div>
                        <div id="address_details" class="d-flex flex-column align-items-start ms-4 mt-2">
                            <p class="m-0 mb-1 ms-2">
                                <?php echo htmlspecialchars($items[0]['first_name'] . ' ' . $items[0]['last_name']); ?> |
                                <?php echo htmlspecialchars($items[0]['phone']); ?>
                            </p>
                            <p class="ms-2 me-2">
                                <?php echo htmlspecialchars($items[0]['blockLot'] . ' ' . $items[0]['subdivision'] . ', ' . $items[0]['barangay'] . ', ' . $items[0]['province'] . ', ' . $items[0]['city'] . ' ' . $items[0]['zip']); ?>
                            </p>
                        </div>
                    </div>

                    <?php
                    $totalPrice = 0;
                    foreach ($items as $item):
                        $totalPrice += $item['price'] * $item['quantity'];
                        ?>
                        <div id="order_item" class="rounded mt-3 p-2">
                            <div id="product_details" class="w-100 rounded d-flex justify-content-between align-items-center p-2">
                                <div class="product_image d-flex justify-content-center align-items-center">
                                    <img src="product-images/<?php echo htmlspecialchars($item['image_file']); ?>" alt=""
                                        class="rounded me-2">
                                    <div class="product_variation">
                                        <h5><?php echo htmlspecialchars($item['product_name']); ?></h5>
                                        <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                                    </div>
                                </div>
                                <div id="product_description">
                                    <div class="container d-flex align-items-center justify-content-center p-0">
                                        <p id="price" class="me-2 mt-2 mb-0">₱
                                            <?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                    <div id="payment_details"
                        class="container rounded d-flex justify-content-start align-items-start flex-column mt-3 mb-2 p-3">
                        <div class="mb-3">
                            <h5>Payment Details</h5>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between ">
                            <p id="payment_details_text" class="m-0 ms-2">Merchandise Subtotal</p>
                            <p id="payment_details_text" class="m-0 me-2">₱ <?php echo number_format($totalPrice, 2); ?></p>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between">
                            <p id="payment_details_text" class="m-0 ms-2">Shipping Subtotal (Luzon/Visayas/Mindanao)</p>
                            <p id="payment_details_text" class="m-0 me-2">₱ 00.00</p>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-between mt-3">
                            <h5 class="ms-2">Total Payment</h5>
                            <h5 id="total_payment" class="me-2">₱ <?php echo number_format($totalPrice, 2); ?></h5>
                        </div>
                    </div>
                    <?php if ($items[0]['status'] !== 'Delivered'): ?>
                        <div id="confirm_button" class="">
                            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                            <input type="hidden" name="order_number" value="<?php echo $order_number ?>">
                            <button type="submit" class="p-3 px-5 rounded" name="confirm_order">Confirm</button>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        <?php else: ?>
            <div id="empty_order"
                class="container rounded p-2 text-center d-flex align-items-center justify-content-center bg-light mt-1"
                style="height: 150px">
                <h5>Empty Order.</h5>
            </div>
        <?php endif; ?>

    <?php }

    ?>

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