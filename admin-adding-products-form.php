<?php
    include("sessionchecker.php");
    include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css\adding-product-form.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <script defer src="js\bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="navi-bar">
    <div class="navi-items">
        <div class="logo_search">
            <div class="logo"><a href="admin.php"><img src="LOGO.png"></a></div>
        </div>
        <div class="navi-btn">
            <div class="buttons "><i class='bx bx-home-alt'></i><a href="admin.php">Home</a></div>
            <div class="buttons active"><i class='bx bx-shopping-bag' ></i><a href="admin-products.php">Products</a></div>
            <div class="buttons"><i class='bx bx-cart' ></i><a href="user_table.php">Users</a></div>
        </div>
        <div class="btn-group">
            <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="user">
                <div class="name">
                <p><?php echo $_SESSION['username'] ?></p>
                </div>
                <div class="photo">
                <img src="img\default-profile.jpg" alt="">
                </div>
            </div>
            </button>
            <ul class="dropdown-menu">
                <li><a href="user_setting.php">Account</a></li>
                <li> 
                    <div>
                        <form action="logout.php" method="post">
                            <button type="submit" name="logout" class="btn btn-danger">Log out</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="add-product">
    <form action="admin-add-producs.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <label for="product_name">Product Name: </label>
        <input type="text" name="product_name" id="product_name" required>
        <label for="price">Price: </label>
        <input type="number" name="price" id="price" required>
        <input type="file" name="image_file" accept=".jpg, .jpeg, .png">
        <button type="submit" name="submit">Submit</button>

    </form>
</div>

</div>
</body>
</html>