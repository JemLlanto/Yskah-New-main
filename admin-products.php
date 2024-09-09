<?php
include ("sessionchecker.php");
include ("connection.php");
include ("head.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css\admin-product9.css" />
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
                                <a href="user_order.php" style="text-decoration: none;">
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
                                    <div class="drop_items ">
                                        <a class="ms-2 mt-3" href="add_admin_form.php">Add Admin</a>
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
                        <li class="nav-item ps-3 active">
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
                            <a class="nav-link text-dark " href="admin.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark active" href="admin-products.php">Product</a>
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
                                <div class="drop_items ">
                                    <a class="w-100 me-2 text-end" href="add_admin_form.php">Add Admin</a>
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

    <div class="chat">
        <a href="chat_system\admin\">
            <button value=" <?php echo $row['chatroomid']; ?>" type="button" class="btn  border-0"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                <img src="img\chat_icon.png" />
            </button>
        </a>
    </div>

    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-4 d-flex flex-row m-1 mt-4 mb-4 gy-2">
            <?php
            $res = mysqli_query($conn, "SELECT * FROM products");
            while ($row = mysqli_fetch_assoc($res)) {

                ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="card w-100">
                        <img src="product-images/<?php echo $row['image_file'] ?>" class="card-img-top" alt="..." />
                        <div class="product_button">
                            <div class="remove_button">
                                <form action="admin_delete_product.php" method="POST"
                                    onsubmit="return confirm('Are you sure you want to remove this product?');">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <button type="submit" name="remove">Remove</button>
                                </form>
                            </div>
                            <div class="add_sample_button">
                                <button id="add_sample_button" type="button" class="btn  col-sm-6 col-lg-3"
                                    data-bs-toggle="modal" data-bs-target="#addsample<?php echo $row['product_id']; ?>">
                                    Manage Samples
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addsample<?php echo $row['product_id']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Manage Product Sample</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="d-flex justify-content-start flex-wrap">
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
                                                                    <div
                                                                        class="notif_title d-flex align-content-center justify-content-between">
                                                                        <p class="m-0"><?php echo $notif["title"]; ?></p>
                                                                        <p class="m-0 mt-1" style="font-size: 15px">
                                                                            <?php echo $date; ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="notif_message">
                                                                        <p class="m-0 ms-2">Order #:
                                                                            <?php echo $notif['order_number']; ?>
                                                                        </p>
                                                                        <p class="ms-2"><?php echo $notif["description"]; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php } ?>
                                                </div>

                                                <div class="add-product ">
                                                    <form action="admin_adding_sample.php" method="POST" autocomplete="off"
                                                        enctype="multipart/form-data">
                                                        <div class="mt-1 mb-1">
                                                            <input class="w-100 p-2" type="number" name="product_id"
                                                                id="product_id" value="<?php echo $row['product_id']; ?>"
                                                                hidden>
                                                        </div>
                                                        <div class="m-2 p-0">
                                                            <h5>Add Sample Image</h5>
                                                            <div class="input-group mb-1 w-100">
                                                                <input type="file" class="form-control w-100"
                                                                    id="image_file" name="image_file"
                                                                    value="<?php echo $row['image_file']; ?>"
                                                                    accept=".jpg, .jpeg, .png">
                                                            </div>
                                                        </div>



                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="addsample" class="btn btn-primary">Add
                                                    Sample</button>

                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add_variation_button">
                                <button id="add_sample_button" type="button" class="btn  col-sm-6 col-lg-3"
                                    data-bs-toggle="modal" data-bs-target="#addvariant<?php echo $row['product_id']; ?>">
                                    Manage Variation
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addvariant<?php echo $row['product_id']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollablemodal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Manage Variant</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div
                                                    class="mt-0 d-flex justify-content-center flex-column align-items-center">
                                                    <h5 class="w-100 text-start">Edit Variant</h5>
                                                    <?php
                                                    $product_id = $row['product_id'];
                                                    $variants = mysqli_query($conn, "SELECT * FROM variant_table WHERE product_id = $product_id");

                                                    while ($variant = mysqli_fetch_assoc($variants)) {
                                                        ?>
                                                        <div class="row w-100 border border-3 rounded pt-2 mb-2">
                                                            <div
                                                                class="d-flex justify-content-between border-bottom align-content-center border-3 mb-2 pb-1">
                                                                <h5 class="m-0"><?php echo $variant['name']; ?>
                                                                </h5>
                                                                <div class="remove_button">
                                                                    <form action="admin_delete_variant.php" method="POST"
                                                                        onsubmit="return confirm('Are you sure you want to remove this variant?');">
                                                                        <input type="hidden" name="variant_id"
                                                                            value="<?php echo $variant['variant_id']; ?>">
                                                                        <button type="submit"
                                                                            name="removevariant">Remove</button>
                                                                    </form>
                                                                </div>
                                                                <!-- <button class="btn btn-danger"
                                                                    style="border:none; color: white;">Delete</button> -->
                                                            </div>

                                                            <div class=" m-0 mb-3 pt-2 d-flex justify-content-start flex-wrap">
                                                                <div class="d-flex flex-wrap gap-1">
                                                                    <?php
                                                                    $variant_id = $variant['variant_id'];
                                                                    $contents = mysqli_query($conn, "SELECT * FROM variant_content WHERE variant_id = $variant_id");
                                                                    while ($content = mysqli_fetch_assoc($contents)) {
                                                                        ?>
                                                                        <div class=" p-1 position-relative pe-2 d-flex align-items-center rounded"
                                                                            style="background-color: lightgray; width:auto;">
                                                                            <div class="rounded"
                                                                                style="background-color: white; height:20px; width: 20px;">
                                                                            </div>
                                                                            <p class="m-0 ms-2 me-2">
                                                                                <?php echo $content['option']; ?>
                                                                            </p>
                                                                            <form action="admin_delete_option.php" method="POST"
                                                                                onsubmit="return confirm('Are you sure you want to remove this option?');">
                                                                                <input type="hidden" name="variant_content_id"
                                                                                    value="<?php echo $content['variant_content_id']; ?>">
                                                                                <button type="submit" class="btn p-0 mt-1 mx-2"
                                                                                    style="right:3px; color:gray; font-size:15px;"
                                                                                    name="removeoption">x</button>
                                                                            </form>

                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <div class="p-0 m-0 d-flex align-items-center justify-content-center rounded"
                                                                        style="background-color: lightgray;;">
                                                                        <button
                                                                            class="m-0 py-1 px-2 d-flex align-items-center justify-content-center rounded"
                                                                            style="background-color:transparent;" type="button"
                                                                            data-bs-toggle="offcanvas"
                                                                            aria-controls="offcanvasScrolling"
                                                                            data-bs-target="#add_variant_option<?php echo $variant['variant_id']; ?>">
                                                                            <h5 class="m-0">+</h5>
                                                                        </button>


                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="offcanvas offcanvas-end" data-bs-scroll="true"
                                                                data-bs-backdrop="false" tabindex="-1"
                                                                id="add_variant_option<?php echo $variant['variant_id']; ?>"
                                                                aria-labelledby="offcanvasScrollingLabel">
                                                                <div class="offcanvas-header">
                                                                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Add
                                                                        variant
                                                                        option
                                                                        for <?php echo $variant['name']; ?></h5>
                                                                    <button type="button" class="btn-close text-reset"
                                                                        data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                </div>
                                                                <div class="offcanvas-body">
                                                                    <form action="admin_add_option.php" method="POST">
                                                                        <input type="hidden" name="variant_id" id="variant_id"
                                                                            value="<?php echo $variant_id ?>">
                                                                        <div
                                                                            class="w-100 border border-2 rounded input-group mb-3 p-2 d-flex flex-column">
                                                                            <h5>Option 1</h5>
                                                                            <input type="text"
                                                                                class="w-100 form-control rounded my-1"
                                                                                name="option_name1" id="option_name1"
                                                                                placeholder="Option name"
                                                                                aria-describedby="basic-addon1">
                                                                            <input type="number"
                                                                                class="w-100 form-control rounded my-1"
                                                                                name="option_price1" id="option_price1"
                                                                                placeholder="Option price"
                                                                                aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div
                                                                            class="w-100 border border-2 rounded input-group mb-3 p-2 d-flex flex-column">
                                                                            <h5>Option 2</h5>
                                                                            <input type="text"
                                                                                class="w-100 form-control rounded my-1"
                                                                                name="option_name2" id="option_name2"
                                                                                placeholder="Option name"
                                                                                aria-describedby="basic-addon1">
                                                                            <input type="number"
                                                                                class="w-100 form-control rounded my-1"
                                                                                name="option_price2" id="option_price2"
                                                                                placeholder="Option price"
                                                                                aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div
                                                                            class="w-100 border border-2 rounded input-group mb-3 p-2 d-flex flex-column">
                                                                            <h5>Option 3</h5>
                                                                            <input type="text"
                                                                                class="w-100 form-control rounded my-1"
                                                                                name="option_name3" id="option_name3"
                                                                                placeholder="Option name"
                                                                                aria-describedby="basic-addon1">
                                                                            <input type="number"
                                                                                class="w-100 form-control rounded my-1"
                                                                                name="option_price3" id="option_price3"
                                                                                placeholder="Option price"
                                                                                aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div>
                                                                            <button class="w-100 btn btn-primary" style="submit"
                                                                                name="addoption">Add
                                                                                to Option</button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="add-product ">
                                                    <form action="admin_adding_variant.php" method="POST" autocomplete="off"
                                                        enctype="multipart/form-data">
                                                        <div class="mt-3 mb-3">
                                                            <h5 class="">Add new Variant</h5>

                                                            <input class="w-100 p-2" type="hidden" name="product_id"
                                                                id="product_id" value="<?php echo $row['product_id']; ?>">
                                                            <input type="text"
                                                                class="w-100 form-control border border-2 rounded my-1"
                                                                name="name" id="name" placeholder="Variant Name">

                                                        </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="addvariant" class="btn btn-primary">Add
                                                    Variant</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edit_button">
                                <button id="edit_button" type="button" class="btn  col-sm-6 col-lg-3" data-bs-toggle="modal"
                                    data-bs-target="#editproduct<?php echo $row['product_id']; ?>">
                                    Edit Product
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editproduct<?php echo $row['product_id']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Product Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="add-product ">
                                                    <form action="admin_edit_product_details.php" method="POST"
                                                        autocomplete="off" enctype="multipart/form-data">
                                                        <div class="mt-1 mb-1">
                                                            <input type="hidden" name="product_id" id="product_id"
                                                                value="<?php echo $row['product_id']; ?>">
                                                            <input class="w-100 p-2" type="text" name="product_name"
                                                                id="product_name"
                                                                placeholder="<?php echo $row['product_name']; ?>"
                                                                value="<?php echo $row['product_name']; ?>">
                                                        </div>
                                                        <div class="mt-1 mb-1">

                                                            <input class="w-100 p-2" type="number" name="price" id="price"
                                                                placeholder="<?php echo $row['price']; ?>"
                                                                value="<?php echo $row['price']; ?>">
                                                        </div>
                                                        <div class="mt-2 mb-1">
                                                            <h5>Product Image</h5>
                                                            <div class="input-group">
                                                                <span class="input-group-text">Edit Description</span>
                                                                <textarea class="form-control" aria-label="With textarea"
                                                                    name="description"
                                                                    placeholder="<?php echo $row['description']; ?>"><?php echo $row['description']; ?></textarea>
                                                            </div>

                                                            <div class="mt-3 mb-1">
                                                                <h5>Change Product Thumbnail</h5>
                                                                <div class="input-group mb-1">
                                                                    <input type="file" class="form-control" id="image_file"
                                                                        name="image_file"
                                                                        value="<?php echo $row['image_file']; ?>">
                                                                </div>
                                                                <div class="product_image"><img
                                                                        src="product-images/<?php echo $row['image_file'] ?>"
                                                                        alt="" class="m w-100"></div>


                                                            </div>
                                                        </div>



                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="editproduct" class="btn btn-primary">Edit
                                                    Product</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name'] ?></h5>
                            <p class="card-text">
                            <p class="m-0">Product ID: <?php echo $row['product_id']; ?></p>
                            <p class="m-0">Php <?php echo $row['price'] ?>.00</p>
                            </p>
                            <a href="admin_product_preview.php?product_id=<?php echo $row['product_id']; ?>"
                                class="btn btn-primary w-100 m-auto">View
                                Product</a>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn  col-sm-6 col-lg-3" data-bs-toggle="modal" data-bs-target="#addproduct">
                <div class="add_button_container pt-3 rounded">
                    <div id="add_button" class="card w-100 p-2">
                        <!-- <div class="add_button"> -->
                        <img src="img\Add_Button.png" class="card-img-top mb-3" alt="..." />
                        <!-- </div> -->
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">
                            Add Product
                        </h3>
                    </div>
                </div>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="add-product ">
                                <form action="admin_add_products.php" method="POST" autocomplete="off"
                                    enctype="multipart/form-data">

                                    <div class="mt-1 mb-1">
                                        <input class="w-100 p-2" type="text" name="product_name" id="product_name"
                                            placeholder="Product name" required>
                                    </div>

                                    <div class="mt-1 mb-1">
                                        <input class="w-100 p-2" type="number" name="price" id="price"
                                            placeholder="Product price" required>
                                    </div>

                                    <div class="mt-2 mb-1">
                                        <div class="input-group">
                                            <span class="input-group-text">Description</span>
                                            <textarea class="form-control" aria-label="With textarea"
                                                name="description"></textarea>
                                        </div>

                                        <div class=" mt-3 mb-1">
                                            <h5>Choose Product Thumbnail</h5>
                                            <div class="input-group mb-1">
                                                <input type="file" class="form-control" id="image_file"
                                                    name="image_file" accept=".jpg, .jpeg, .png">
                                            </div>
                                        </div>
                                    </div>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer_content flex-wrap flex-lg-nowrap">
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