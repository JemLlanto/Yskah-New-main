<?php
include ("connection.php");
include ("head.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css\index1.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div
            class="container-fluid ms-0 ms-md-3 d-flex align-items-center justify-content-space justify-content-md-between d-lg-none">
            <a class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" style="width:15px"></span>
            </a>

            <a id="img" class="navbar-brand" href="index.php">
                <img src="img\LOGOO.png" alt="YsakaLogo" class="d-inline-block float-start" style="width: 110px">
            </a>
        </div>

        <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <div id="offcanvasExampleLabel"
                    class="offcanvas-title d-flex flex-row align-items-center justify-content-center justify-content-md-end  me-2">
                    <div class="">
                        <img src="img\default-profile.jpg" alt="profile" class=""
                            style="width: 40px; border-radius: 50%;">
                    </div>
                    <a href="login_form.php" class="ms-2" style="text-decoration: none; color: black">
                        <div id="login-link" class="me-0 me-md-2 ">
                            <p class="mb-0">Log in</p>
                        </div>
                    </a>

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav nav-fill gap-2 p-0" id="navbarNav">
                    <li class="nav-item w-100 active">
                        <a class="nav-link text-dark text-start ms-2" href="index.php">Home</a>
                    </li>
                    <li class="nav-item w-100 ">
                        <a class="nav-link text-dark text-start ms-2" aria-current="page"
                            href="index-products.php">Product</a>
                    </li>

                </ul>
            </div>
        </div>

        <div
            class="container-fluid ms-0 ms-md-3 d-none d-md-flex align-items-center justify-content-space justify-content-md-between">
            <a id=" img" class="navbar-brand" href="index.php">
                <img src="img\LOGOO.png" alt="YsakaLogo" class=" d-lg-inline-block float-start d-none"
                    style="width: 110px">
            </a>

            <div class="container navbar-collapse d-flex d-md-none" id="navbarNav">
                <ul class="navbar-nav nav-fill gap-2 p-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="index-products.php">Product</a>
                    </li>
                </ul>
            </div>

            <div
                class="d-flex flex-row d-md-none d-lg-flex align-items-center justify-content-center justify-content-md-end  me-2">
                <a href="login_form.php" class="" style="text-decoration: none; color: black">

                    <div id="login-link" class="me-0 me-md-2 ">
                        <p class="mb-0">Log in</p>
                    </div>
                </a>

                <div class="">
                    <img src="img\default-profile.jpg" alt="profile" class="" style="width: 50px">
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid d-flex align-items-end justify-content-center flex-column position-absolute pe-2 gap-3 pb-0 pe-lg-5 "
        id="Intro">
        <div class="d-flex flex-column align-items-end text-end">
            <h1>Introduction</h1>
            <h5 id="introText" class="">Hello! Welcome to Yskah Creations, we offer customized Glass Art Painting, Phone
                Case Painting, and Keychain Painting, you can choose from faceless vector art, pets, or anime art
                styles, we've got you covered in handmade art with love that you will cherish. Thank you for choosing
                Yskah Creation. We look forward to creating something special just for you!</h5>
        </div>
        <a href="index-products.php"><button type="button" class="btn btn-lg btn-light p-3 w-100">Order Now</button></a>
    </div>

    <div class="overflow-hidden d-flex justify-content-center" style=" height: 60dvh">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active " data-bs-interval="3000">
                    <img src="img\homepic1.jpg" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="img\homepic2.jpg" class="d-block w-100  img-fluid" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="img\homepic3.jpg" class="d-block w-100  img-fluid" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="img\homepic4.jpg" class="d-block w-100  img-fluid" alt="...">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-5" style="">
        <div class=" d-flex justify-content-center">
            <h3 class=" pt-4 ps-4 ">Products</h3>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 m-1 mt-4 mb-4 d-flex justify-content-center">
            <?php
            $res = mysqli_query($conn, "SELECT * FROM products");
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="col">
                    <div class="card w-100 mb-2">
                        <img src="product-images/<?php echo $row['image_file'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name'] ?></h5>
                            <p class="card-text">
                            <p>Php <?php echo $row['price'] ?>.00</p>
                            </p>
                            <a href="index_product_preview.php?product_id=<?php echo $row['product_id']; ?>"
                                class="w-100 btn btn-primary py-1">View
                                Product</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
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