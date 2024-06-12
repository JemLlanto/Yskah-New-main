<?php
    // include("sessionchecker.php");
    include("connection.php");
    include("head.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css\index_product_preview9.css" />
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div
        class="container-fluid ms-0 ms-md-3 d-flex align-items-center justify-content-space justify-content-md-between d-lg-none">
        <a class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
            aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon" style="width:15px"></span>
        </a>

        <a id="img" class="navbar-brand" href="#">
            <img src="img\LOGOO.png" alt="YsakaLogo" class="d-inline-block float-start" style="width: 110px">
        </a>
    </div>

    <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <div id="offcanvasExampleLabel"
                class="offcanvas-title d-flex flex-row align-items-center justify-content-center justify-content-md-end  me-2">
                <div id="login-link" class="me-0 me-md-2 ">
                    <a href="login_form.php" class="" style="text-decoration: none; color: black">
                        <p class="mb-0">Log in</p>
                    </a>
                </div>
                <div class="">
                    <img src="img\default-profile.jpg" alt="profile" class="" style="width: 50px">
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav nav-fill gap-2 p-0">
                <li class="nav-item">
                    <a class="nav-link text-dark " href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark active" href="index-products.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " aria-current="page" href="#">About Us</a>
                </li>
            </ul>
        </div>
    </div>

    <div
        class="container-fluid ms-0 ms-md-3 d-none d-md-flex align-items-center justify-content-space justify-content-md-between">
        <a id=" img" class="navbar-brand" href="#">
            <img src="img\LOGOO.png" alt="YsakaLogo" class=" d-lg-inline-block float-start d-none"
                style="width: 110px">
        </a>

        <div class="container navbar-collapse d-flex d-md-none" id="navbarNav">
            <ul class="navbar-nav nav-fill gap-2 p-0">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark active" href="index-products.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " aria-current="page" href="#">About Us</a>
                </li>
            </ul>
        </div>

        <div
            class="d-flex flex-row d-md-none d-lg-flex align-items-center justify-content-center justify-content-md-end  me-2">
            <div id="login-link" class="me-0 me-md-2 ">
                <a href="login_form.php" class="" style="text-decoration: none; color: black">
                    <p class="mb-0">Log in</p>
                </a>
            </div>
            <div class="">
                <img src="img\default-profile.jpg" alt="profile" class="" style="width: 50px">
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
                            <img src="product-images/<?php echo $row['image_file']?>" class="d-block w-100 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="product-images/<?php echo $row['image_file']?>" class="d-block w-100 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="product-images/<?php echo $row['image_file']?>" class="d-block w-100 rounded" alt="...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="container-fluid">
                    <div class="product_name_price rounded d-flex justify-content-between p-3 align-items-center">
                        <h1><?php echo $row['product_name']?></h1>
                        <h3>Php <?php echo $row['price']?>.00</h3>
                    </div>
                    <div class="product_description w-100 h-auto">
                        <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia velit est commodi architecto
                        labore natus perspiciatis hic iure odio ut! Quos maiores vero laudantium ex, quasi repellat cum
                        voluptatum veritatis.
                        </p>
                    </div>
                    <div class="variation_ordernow d-flex flex-column w-100">
                        <div
                            class="product_variation w-100 d-flex align-items-center flex-wrap justify-content-center justify-content-md-start gap-2 mt-md-5">
                            <div class="variation">
                                <button type="button" class="btn variation-btn">Variation 1</button>
                            </div>
                            <div class="variation">
                                <button type="button" class="btn variation-btn">Variation 2</button>
                            </div>
                            <div class="variation">
                                <button type="button" class="btn variation-btn">Variation 3</button>
                            </div>
                        </div>
                        
                        
                        <div class="quantity_buttons">

                                   
                                    <div class="add_to_cart_order_now mt-4 p-2">
                                        <button class="add_to_cart">
                                            <a href="login_form.php" style="text-decoration: none; color: var(--ter_color-); border:none;">
                                            <h5>Add to Cart</h5>
                                            </a>
                                        </button>
                                        <button class="order_now ms-2" style="border:none;">
                                            <a href="login_form.php" style="text-decoration: none; color: white; border:none;">
                                            <h5>Order Now</h5>
                                            </a>
                                        </button>
                                        
                                    </div>
                                    
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <?php
        } else {
            echo "<p>Product not found.</p>";
        }
    } else {
        echo "<p>No product selected.</p>";
    }
    ?>
    <footer>
        <div class="footer_content  flex-wrap flex-md-nowrap">
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