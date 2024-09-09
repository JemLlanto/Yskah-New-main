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
    <link rel="stylesheet" href="css\sale_report.css" />
    <style>
        @import url("head.php");

        .tbl_header {
            background-color: var(--ter_color);
            color: white;
        }

        @media only screen and (max-width: 425px) and (min-width: 320px) {
            #table {
                font-size: 12px;
            }

            th {
                font-size: 10px;
            }

            #report_title>h5 {
                font-size: 14px;
            }

            #timeline {
                font-size: 14px;
            }
        }
    </style>
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
                        <li class="nav-item ps-3 ">
                            <a class="nav-link text-dark text-start" href="admin_order.php">Orders</a>
                        </li>
                        <li class="nav-item ps-3 active">
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
                            <a class="nav-link text-dark " href="admin_order.php">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark active" href="admin_sale_report.php">Sale Report</a>
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

    <?php } ?>

    <div id="container" class="container-fluid-sm container-md rounded mb-3 mt-1 p-3 mb-5">
        <div class="row">

            <div class="col-12 rounded p-2">
                <div id="report" class="w-100 rounded p-2">
                    <div id="timeline" class="w-100 p-2">
                        <a class="rounded mx-1 p-2" href="admin_sale_report.php">Week</a>
                        <a class="rounded mx-1 p-2" href="admin_sale_report_month.php">Month</a>
                        <a class="rounded mx-1 p-2 active" href="admin_sale_report_year.php">Year</a>
                    </div>
                    <div id="report_title" class="my-3 d-flex justify-content-center align-items-center gap-3">
                        <h5 class="m-0">Sale Summary by Year</h5>
                        <form method="GET" action="admin_sale_report_year.php" id="yearForm">
                            <select name="year" id="year" class="form-select w-auto d-inline"
                                onchange="document.getElementById('yearForm').submit();">
                                <?php
                                $current_year = date('Y');
                                $selected_year = isset($_GET['year']) ? $_GET['year'] : $current_year;

                                // Generate options for years, adjust the range as per your needs
                                for ($y = $current_year - 5; $y <= $current_year + 5; $y++) {
                                    $selected = $y == $selected_year ? 'selected' : '';
                                    echo "<option value='$y' $selected>$y</option>";
                                }
                                ?>
                            </select>
                        </form>
                    </div>

                    <div id="table">
                        <?php
                        // Get the selected year or default to the current year
                        $selected_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

                        // Calculate start and end dates for the selected year
                        $start_of_year = date('Y-01-01', strtotime("$selected_year-01-01"));
                        $end_of_year = date('Y-12-t', strtotime("$selected_year-12-01"));

                        $sales = mysqli_query($conn, "SELECT * FROM sales");
                        $total_sales = 0;
                        ?>

                        <div class="rounded">
                            <table id="table" class="table table-striped table-hover">
                                <thead>
                                    <tr class="tbl_header">
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Items Sold</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_sales = 0;

                                    while ($sale = mysqli_fetch_assoc($sales)) {
                                        $product_id = $sale['product_id'];

                                        // SQL query to fetch order items where delivered_date is within the selected year
                                        $solds = mysqli_query($conn, "SELECT * FROM order_items WHERE status = 'Delivered' AND product_id = '$product_id' AND delivered_date BETWEEN '$start_of_year' AND '$end_of_year'");

                                        $item_sold = 0;
                                        $price = 0;

                                        // Calculate total items sold for the selected year
                                        while ($sold = mysqli_fetch_assoc($solds)) {
                                            $item_sold += $sold['quantity'];
                                            $price += $sold['total_price'];
                                        }

                                        $total = $price;
                                        $total_sales += $total;
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $sale['product_id']; ?></th>
                                            <td><?php echo $sale['product_name']; ?></td>
                                            <td>₱ <?php echo number_format($sale['price'], 2); ?></td>
                                            <td><?php echo $item_sold; ?></td>
                                            <td>₱ <?php echo number_format($total, 2); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div id="total_sale" class="w-100 pe-2">
                            <p class="m-0">Total Sales:</p>
                            <h5 id="price" class="m-0">₱ <?php echo number_format($total_sales, 2); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
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