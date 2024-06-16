<?php
include("sessionchecker.php");
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);
    $product_name = trim($_POST['product_name']);
    $image_file = trim($_POST['image_file']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    $stmt = $conn->prepare("INSERT INTO order_table (user_id, product_id, product_name, image_file, price, quantity) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissdi", $user_id, $product_id, $product_name, $image_file, $price, $quantity);
    $stmt->execute();
    $stmt->close();

    echo "<script>
    alert('Product added to cart');
    window.location = 'user_cart.php';
    </script>";
    exit();
} else {
    header("Location: user_products.php");
    exit();
}
