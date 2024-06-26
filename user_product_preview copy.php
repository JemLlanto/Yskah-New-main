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
    <link rel="stylesheet" href="css\admin_product_preview6.css" />
    <style>
        @import url("head.php");

        .add_to_cart,
        .order_now {
            transition: .3s;
        }

        .add_to_cart:hover {
            background-color: var(--ter_color);
            color: white
        }

        .order_now:hover {
            background-color: rgb(223, 64, 36);
        }

        .product_description {
            height: 350px;
            overflow: scroll;
            overflow-x: hidden;
            background-color: #f2f2f2;
        }

        .radio-container {
            background-color: var(--main_color);
            padding: 0;
            transition: .3s;
        }

        .radio-container:hover {
            background-color: var(--ter_color);
            color: white;

        }

        .radio-container input[type="radio"] {
            display: none;
        }

        .radio-container input[type="radio"]:checked+.label-text {
            background-color: var(--ter_color);
            color: white;
        }

        .label-text {
            display: flex;
            align-items: center;
            padding: 0.5em;
            border-radius: 5px;
            width: 100%;
        }

        .radio-circle {
            background-color: white;
            height: 20px;
            width: 20px;
            border-radius: 5px;
            margin-right: 10px;
        }
    </style>


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

                <a id="img" class="navbar-brand" href="user_landing_page.php">
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
                        <?php
                        $notifs = mysqli_query($conn, "SELECT * FROM notification_table WHERE user_id = '" . $_SESSION["user_id"] . "' ");
                        while ($notif = mysqli_fetch_assoc($notifs)) {
                            ?>
                            <a href="#" style="text-decoration: none;">
                                <div class="notification_section">
                                    <div class="notif_container">
                                        <div class="notif_title">
                                            <p><?php echo $notif["title"] ?></p>
                                        </div>
                                        <div class="notif_message">
                                            <p class="ms-2"><?php echo $notif["description"] ?></p>
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
                    <li class="nav-item ps-3 active">
                        <a class="nav-link text-dark text-start" href="user_products.php">Product</a>
                    </li>
                    <li class="nav-item ps-3">
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
                        <a class="nav-link text-dark active" href="user_products.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="user_cart.php">Cart</a>
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
                        <?php
                        $notifs = mysqli_query($conn, "SELECT * FROM notification_table WHERE user_id = '" . $_SESSION["user_id"] . "' ");
                        while ($notif = mysqli_fetch_assoc($notifs)) {
                            ?>
                            <a href="#" style="text-decoration: none;">
                                <div class="notification_section">
                                    <div class="notif_container">
                                        <div class="notif_title">
                                            <p><?php echo $notif["title"] ?></p>
                                        </div>
                                        <div class="notif_message">
                                            <p class="ms-2"><?php echo $notif["description"] ?></p>
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

    <?php
    if (isset($_GET['product_id'])) {
        $product_id = intval($_GET['product_id']);

        $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $product_id");
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            ?>

            <div id="container" class="container-fluid rounded d-flex mb-3 mt-3 py-2">
                <div class="row row-cols-1 row-cols-md-2 gx-1 gy-4 gy-md-0">
                    <div class="col">
                        <div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel" data-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="product-images/<?php echo $row['image_file'] ?>" class="d-block w-100 rounded"
                                        alt="...">
                                </div>
                                <?php
                                $res = mysqli_query($conn, "SELECT * FROM product_samples WHERE product_id = $product_id");
                                while ($samples = mysqli_fetch_assoc($res)) {

                                    ?>
                                    <div class="carousel-item  " data-bs-interval="3000">
                                        <img src="product-images/product_samples/<?php echo $samples['image_file'] ?>"
                                            class="d-block w-100 rounded" alt="...">
                                    </div>
                                <?php } ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="col">
                        <div class="container-fluid">
                            <div class="product_name_price rounded d-flex justify-content-between p-3 align-items-center">
                                <h1><?php echo $row['product_name'] ?></h1>
                                <?php
                                // Initialize variables for minimum and maximum prices
                                $min_combined_price = PHP_INT_MAX;
                                $max_combined_price = 0;

                                // Fetch all variants for the product
                                $variants_query = mysqli_query($conn, "SELECT * FROM variant_table WHERE product_id = $product_id");
                                $variants = mysqli_fetch_all($variants_query, MYSQLI_ASSOC);

                                // Function to calculate minimum and maximum combined prices recursively
                                function calculateMinMaxCombinedPrices($current_variant_index, $current_price)
                                {
                                    global $variants, $conn, $product_id, $min_combined_price, $max_combined_price;

                                    // Base case: reached end of variants array
                                    if ($current_variant_index >= count($variants)) {
                                        // Update min_combined_price if current combination's price is lower
                                        if ($current_price < $min_combined_price) {
                                            $min_combined_price = $current_price;
                                        }
                                        // Update max_combined_price if current combination's price is higher
                                        if ($current_price > $max_combined_price) {
                                            $max_combined_price = $current_price;
                                        }
                                        return;
                                    }

                                    // Fetch contents for current variant
                                    $variant_id = $variants[$current_variant_index]['variant_id'];
                                    $contents_query = mysqli_query($conn, "SELECT * FROM variant_content WHERE variant_id = $variant_id");
                                    $contents = mysqli_fetch_all($contents_query, MYSQLI_ASSOC);

                                    // Iterate over each content option of current variant
                                    foreach ($contents as $content) {
                                        // Calculate new price considering current content option
                                        $new_price = $current_price + floatval($content['price']);

                                        // Recursive call for next variant
                                        calculateMinMaxCombinedPrices($current_variant_index + 1, $new_price);
                                    }
                                }

                                // Start recursion from first variant
                                calculateMinMaxCombinedPrices(0, 0);

                                ?>
                                <h3>Php <?php echo number_format($min_combined_price, 2) ?> -
                                    <?php echo number_format($max_combined_price, 2) ?>
                                </h3>
                            </div>



                            <div class="product_description w-100 mt-2">
                                <p>
                                    <?php echo $row['description'] ?>
                                </p>
                            </div>
                            <div class="variation_ordernow d-flex flex-column w-100">



                                <div class="quantity_buttons">


                                    <div class="add_to_cart_order_now mt-4 p-2">
                                        <button class="add_to_cart rounded" data-bs-toggle="modal"
                                            data-bs-target="#add_to_cart_modal">
                                            <h5>Add to Cart</h5>
                                        </button>
                                        <button class="order_now ms-2 rounded" style="border:none;" onclick="orderNow()">
                                            <h5>Order Now</h5>
                                        </button>
                                    </div>

                                    <!-- Add to Cart Modal -->
                                    <div class="modal fade" id="add_to_cart_modal" tabindex="-1"
                                        aria-labelledby="addToCartLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title w-100" id="addToCartLabel">
                                                        <div class="w-100 d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h5 class="m-0">Add to Cart</h5>
                                                            </div>
                                                            <div class="m-0" id="cartTotalPrice">
                                                                Php <?php echo $row['price'] ?>.00
                                                            </div>
                                                        </div>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="add-to-cart-form" action="add-to-cart-form.php" method="POST">
                                                        <!-- Include variant selection similar to Order Now -->
                                                        <?php
                                                        $product_id = $row['product_id'];
                                                        $variants = mysqli_query($conn, "SELECT * FROM variant_table WHERE product_id = $product_id");

                                                        while ($variant = mysqli_fetch_assoc($variants)) {
                                                            ?>
                                                            <div class="row w-100 border border-3 rounded m-auto pt-2 mb-2">
                                                                <div
                                                                    class="d-flex justify-content-between border-bottom align-content-center border-3 mb-2 pb-1">
                                                                    <h5 class="m-0"><?php echo $variant['name']; ?></h5>
                                                                </div>
                                                                <div
                                                                    class="m-0 mb-3 pt-2 d-flex justify-content-start flex-wrap gap-1">
                                                                    <?php
                                                                    $variant_id = $variant['variant_id'];
                                                                    $contents = mysqli_query($conn, "SELECT * FROM variant_content WHERE variant_id = $variant_id");
                                                                    while ($content = mysqli_fetch_assoc($contents)) {
                                                                        ?>
                                                                        <label class="shadow-sm radio-container rounded">
                                                                            <input type="radio"
                                                                                name="variants[<?php echo $variant['variant_id']; ?>]"
                                                                                value="<?php echo $content['variant_content_id'] . '-' . $content['price']; ?>">
                                                                            <div class="label-text m-auto">
                                                                                <div class="radio-circle"></div>
                                                                                <?php echo $content['option']; ?>
                                                                            </div>
                                                                        </label>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <input type="hidden" name="product_id"
                                                            value="<?php echo $row['product_id']; ?>">
                                                        <input type="hidden" name="product_name"
                                                            value="<?php echo $row['product_name']; ?>">
                                                        <input type="hidden" id="cart_total_price" name="price"
                                                            value="<?php echo $row['price']; ?>">
                                                        <input type="hidden" name="image_file"
                                                            value="<?php echo $row['image_file']; ?>">
                                                        <div class="input-group mt-3">
                                                            <label for="cart_quantity">
                                                                <h5>Quantity</h5>
                                                            </label>
                                                            <input type="number" class="form-control w-100 rounded py-2 ps-2"
                                                                id="cart_quantity" name="quantity" value="1" min="1">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="submitCartForm()">Add
                                                        to Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Order Now Modal -->
                                    <div class="modal fade" id="order_now_modal" tabindex="-1" aria-labelledby="orderNowLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title w-100" id="orderNowLabel">
                                                        <div class="w-100 d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h5 class="m-0">Order Now</h5>
                                                            </div>
                                                            <div class="m-0" id="orderTotalPrice">
                                                                Php <?php echo $row['price'] ?>.00
                                                            </div>
                                                        </div>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="order-now-form" action="order-now.php" method="POST">
                                                        <!-- Include variant selection similar to Add to Cart -->
                                                        <?php
                                                        $product_id = $row['product_id'];
                                                        $variants = mysqli_query($conn, "SELECT * FROM variant_table WHERE product_id = $product_id");

                                                        while ($variant = mysqli_fetch_assoc($variants)) {
                                                            ?>
                                                            <div class="row w-100 border border-3 rounded m-auto pt-2 mb-2">
                                                                <div
                                                                    class="d-flex justify-content-between border-bottom align-content-center border-3 mb-2 pb-1">
                                                                    <h5 class="m-0"><?php echo $variant['name']; ?></h5>
                                                                </div>
                                                                <div
                                                                    class="m-0 mb-3 pt-2 d-flex justify-content-start flex-wrap gap-1">
                                                                    <?php
                                                                    $variant_id = $variant['variant_id'];
                                                                    $contents = mysqli_query($conn, "SELECT * FROM variant_content WHERE variant_id = $variant_id");
                                                                    while ($content = mysqli_fetch_assoc($contents)) {
                                                                        ?>
                                                                        <label class="shadow-sm radio-container rounded">
                                                                            <input type="radio"
                                                                                name="order_variants[<?php echo $variant['variant_id']; ?>]"
                                                                                value="<?php echo $content['variant_content_id'] . '-' . $content['price']; ?>">
                                                                            <div class="label-text m-auto">
                                                                                <div class="radio-circle"></div>
                                                                                <?php echo $content['option']; ?>
                                                                            </div>
                                                                        </label>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <input type="hidden" name="product_id"
                                                            value="<?php echo $row['product_id']; ?>">
                                                        <input type="hidden" name="product_name"
                                                            value="<?php echo $row['product_name']; ?>">
                                                        <input type="hidden" id="order_total_price" name="price"
                                                            value="<?php echo $row['price']; ?>">
                                                        <input type="hidden" name="image_file"
                                                            value="<?php echo $row['image_file']; ?>">
                                                        <div class="input-group mt-3">
                                                            <label for="order_quantity">
                                                                <h5>Quantity</h5>
                                                            </label>
                                                            <input type="number" class="form-control w-100 rounded py-2 ps-2"
                                                                id="order_quantity" name="quantity" value="1" min="1">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="submitOrderForm()">Order Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <script>
                // Function to calculate total price for Add to Cart modal
                function calculateCartTotalPrice() {
                    let total = 0;
                    const radios = document.querySelectorAll('input[name^="cart_variants"]:checked');
                    radios.forEach((radio) => {
                        total += parseFloat(radio.value.split('-')[1]);
                    });
                    document.getElementById('cart_total_price').value = total.toFixed(2);
                    document.getElementById('cartTotalPrice').innerText = 'Price: Php ' + total.toFixed(2);
                }

                // Function to submit Add to Cart form
                function submitCartForm() {
                    calculateCartTotalPrice();
                    document.getElementById('add-to-cart-form').submit();
                }

                // Function to calculate total price for Order Now modal
                function calculateOrderTotalPrice() {
                    let total = 0;
                    const radios = document.querySelectorAll('input[name^="order_variants"]:checked');
                    radios.forEach((radio) => {
                        total += parseFloat(radio.value.split('-')[1]);
                    });
                    document.getElementById('order_total_price').value = total.toFixed(2);
                    document.getElementById('orderTotalPrice').innerText = 'Price: Php ' + total.toFixed(2);
                }

                // Function to handle Order Now button click
                function orderNow() {
                    calculateOrderTotalPrice();
                    const modal = new bootstrap.Modal(document.getElementById('order_now_modal'));
                    modal.show();
                }

                // Function to submit Order Now form
                function submitOrderForm() {
                    calculateOrderTotalPrice();
                    document.getElementById('order-now-form').submit();
                }

                // Event listener when DOM is loaded
                document.addEventListener('DOMContentLoaded', (event) => {
                    // Add event listeners for radio inputs in Add to Cart modal
                    document.querySelectorAll('input[name^="cart_variants"]').forEach((radio) => {
                        radio.addEventListener('change', calculateCartTotalPrice);
                    });

                    // Add event listeners for radio inputs in Order Now modal
                    document.querySelectorAll('input[name^="order_variants"]').forEach((radio) => {
                        radio.addEventListener('change', calculateOrderTotalPrice);
                    });
                });

            </script>

            <?php
        } else {
            echo "<p>Product not found.</p>";
        }
    } else {
        echo "<p>No product selected.</p>";
    }
    ?>

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