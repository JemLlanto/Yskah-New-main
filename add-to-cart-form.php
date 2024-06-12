<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['id'];
    $product_id = intval($_POST['product_id']);
    $product_name = trim($_POST['product_name']);
    $image_file = trim($_POST['image_file']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $index = isset($_POST['index']) ? intval($_POST['index']) : -1;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $new_item = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'image_file' => $image_file,
        'price' => $price,
        'quantity' => $quantity
    );

    if ($index >= 0) {
        $_SESSION['cart'][$index] = $new_item;
        $message = "Cart item updated successfully.";
    } else {
        $_SESSION['cart'][] = $new_item;
        $message = "Successfully added to cart.";

        $stmt = $conn->prepare("INSERT INTO order_table (id, product_id, product_name, image_file, price, quantity) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssi", $id, $product_id, $product_name, $image_file, $price, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    echo "<script>
    alert('$message');
    window.location = 'user_cart.php';
    </script>";
    exit();
} else {
    header("Location: user_products.php");
    exit();
}