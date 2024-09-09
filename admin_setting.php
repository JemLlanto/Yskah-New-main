<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setting</title>
    <link rel="stylesheet" href="css\user_settings8.css" />
</head>

<body>
    <?php
    include ("sessionchecker.php");
    include ("connection.php");
    include ("head.php");

    $sql = "SELECT * FROM user_table WHERE username='" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);


        if (count($_POST) > 0) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $sex = $_POST['sex'];
            $phone = $_POST['phone'];
            $username = $_POST['username'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $province = $_POST['province'];
            $zip = $_POST['zip'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $image_file = $_POST['image_file'];

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($conn, "UPDATE user_table SET
            first_name='$first_name',
            last_name='$last_name',
            sex='$sex',
            phone='$phone',
            address='$address',
            city='$city',
            province='$province',
            zip='$zip',
            username='$username',
            email='$email',
            image_file='$image_file',
            password='$hashed_password' WHERE user_id='" . $_POST['user_id'] . "'");
            echo "<script>
          alert('Record Successfully modified');
          window.location='admin_setting.php';
          </script>";
        }
        ?>
        <!-- Modal -->
        <div class="modal fade" id="change_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="update_photo.php" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="image_file" name="image_file"
                                    accept=".jpg, .jpeg, .png">
                                <label class="input-group-text" for="image_file">Upload</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                        <li class="nav-item ps-3">
                            <a class="nav-link text-dark text-start" href="admin.php">Home</a>
                        </li>
                        <li class="nav-item ps-3">
                            <a class="nav-link text-dark text-start" href="admin_products.php">Product</a>
                        </li>
                        <li class="nav-item ps-3">
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
                            <a class="nav-link text-dark" href="admin.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="admin-products.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="admin_order.php">Orders</a>
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


        <div id="container" class="container-fluid mt-3 d-flex flex-column align-items-center justify-content-center">
            <div class="card  m-3 w-100">
                <div class="card-header d-flex justify-content-between align-items-center p-3">
                    <p class="card-text m-0">Profile</p>
                    <p class="card-text">ID: <?php echo $row['user_id']; ?></p>
                </div>

                <div class="row g-0 p-2 mb-2 border-bottom border-2">
                    <div id="user_image"
                        class="col-md-4 d-flex flex-column align-items-center justify-content-center pt-3 pb-3 px-2 "
                        style="">
                        <div class="profile m-0 p-0 position-relative">
                            <div class="w-100" style="border-radius: 50%; overflow: hidden; border: 3px solid gray;">
                                <img class="w-100 m-0" src="profile_picture/<?php echo $row['image_file'] ?>" alt="">

                            </div>
                            <button type="button" class="btn btn-primary p-0 position-absolute" data-bs-toggle="modal"
                                data-bs-target="#change_profile"
                                style="border-radius:50%; width: 50px; height: 50px; right: 10px; bottom: 20px; border: 2px solid white;">
                                <h1 class="m-0">+</h1>
                        </div>

                    </div>

                    <div class="col-md-8 wrapper ">
                        <h5 class="fw-bolder">User Details</h5>
                        <form action="setting_update_details.php" method="POST">
                            <div class="row pb-3 g-2">
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                <div class="form-floating col-md-6">
                                    <input type="text" class="form-control" id="firstName" name="first_name"
                                        placeholder="John" value="<?php echo $row['first_name']; ?>" />
                                    <label for="firstName" class="form-label text-secondary ps-3">First name</label>
                                </div>
                                <div class="form-floating col-md-6">
                                    <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Doe"
                                        value="<?php echo $row['last_name']; ?>" />
                                    <label for="lastName" class="form-label text-secondary ps-3">Last name</label>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label class="input-group-text" for="sex">Sex</label>
                                <select class="form-select" id="sex" name="sex" value="<?php echo $row['sex']; ?>">
                                    <option selected><?php echo $row['sex']; ?></option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>

                            <div class="form-floating mb-3 w-100">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="name@example.com" value="<?php echo $row['email']; ?>" />
                                <label for="email" class="form-label text-secondary">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="63+"
                                    value="<?php echo $row['phone']; ?>" />
                                <label for="phone" class="form-label text-secondary">Phone</label>
                            </div>


                            <div class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                <div class="w-100  d-flex justify-content-end align-items-center">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="wrapper p-2 pt-2 w-100 border-bottom border-2">
                    <h5 class="fw-bolder">Delivery Address</h5>
                    <form action="setting_update_delivery_details.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <div class="row pb-2">
                            <div class="form-floating col-md-6 mb-2">
                                <input type="text" class="form-control" id="blockLot" name="blockLot" placeholder="blockLot"
                                    value="<?php echo $row['blockLot']; ?>" />
                                <label for="firstName" class="form-label text-secondary  ps-4">House
                                    No./Block/Lot/Phase/Street
                                </label>
                            </div>
                            <div class="form-floating col-md-3 mb-2">
                                <input type="text" class="form-control" id="subdivision" name="subdivision"
                                    placeholder="Subdivision" value="<?php echo $row['subdivision']; ?>" />
                                <label for="firstName" class="form-label text-secondary ps-4 ">Subdivision</label>
                            </div>
                            <div class="form-floating col-md-3 mb-2">
                                <input type="text" class="form-control" id="barangay" name="barangay" placeholder="barangay"
                                    value="<?php echo $row['barangay']; ?>" />
                                <label for="firstName" class="form-label text-secondary ps-4 ">Barangay</label>
                            </div>

                        </div>
                        <div class="row pb-2">
                            <div class="form-floating col-md-4 mb-2">
                                <input type="text" class="form-control" id="city" name="city" placeholder="city"
                                    value="<?php echo $row['city']; ?>" />
                                <label for="firstName" class="form-label text-secondary ps-4 ">City</label>
                            </div>
                            <div class="form-floating col-md-4 mb-2">
                                <input type="text" class="form-control" id="province" name="province" placeholder="province"
                                    value="<?php echo $row['province']; ?>" />
                                <label for="firstName" class="form-label text-secondary ps-4 ">Province</label>
                            </div>
                            <div class="form-floating col-md-4 mb-2">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="zip"
                                    value="<?php echo $row['zip']; ?>" />
                                <label for="firstName" class="form-label text-secondary ps-4 ">Zip</label>
                            </div>

                        </div>


                        <div class="my-2 d-flex flex-row justify-content-between align-items-center">
                            <div class="w-100  d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
            <div class="wrapper px-2 pt-3 w-100">
                <h5 class="fw-bolder">Username and Password</h5>
                <form action="setting_update_account_details.php" method="POST">
                    <div class="row ">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <div class="form-floating col-md-6 mb-3 ">
                            <input type="text" class="form-control" id="username" placeholder="username" name="username"
                                value="<?php echo $row['username']; ?>" />
                            <label for="username" class="form-label text-secondary ps-4">Username</label>
                        </div>
                        <div class="form-floating col-md-3 mb-3 ">
                            <input type="password" class="form-control" id="password" placeholder="password"
                                name="password" />
                            <label for="password" class="form-label text-secondary ps-4">Password</label>
                        </div>
                        <div class="form-floating col-md-3 mb-3 ">
                            <input type="password" class="form-control" id="confirm_password" placeholder="confirm_password"
                                name="confirm_password" />
                            <label for="confirm_password" class="form-label text-secondary ps-4">Confirm Password</label>
                        </div>
                    </div>
                    <div class="mb-2 d-flex flex-row justify-content-between align-items-center">
                        <div class="w-100  d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
    } else {
        echo "User not found.";
    }
    ?>

    <footer>
        <div class="footer_content">

            <div class="footer_logo">
                <img src="img\LOGO.png" alt="">
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