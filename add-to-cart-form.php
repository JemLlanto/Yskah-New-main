<?php
include("sessionchecker.php");
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = floatval($_POST['price']);
    $image_file = $_POST['image_file'];
    $quantity = intval($_POST['quantity']);

    // Check if the product already exists in the cart
    $stmt_check = $conn->prepare("SELECT order_id, quantity FROM order_table WHERE user_id = ? AND product_id = ?");
    $stmt_check->bind_param("ii", $user_id, $product_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row = $result_check->fetch_assoc()) {
        // Product already in cart, update the quantity and total price
        $order_id = $row['order_id'];
        $quantity = $row['quantity'] + $quantity;
        $total = $quantity * $price;

        $stmt_update = $conn->prepare("UPDATE order_table SET quantity = ?, total = ? WHERE order_id = ?");
        $stmt_update->bind_param("iii", $quantity, $total, $order_id);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        // Product not in cart, insert a new row
        $total = $quantity * $price;

        $stmt_insert = $conn->prepare("INSERT INTO order_table (user_id, product_id, product_name, image_file, price, quantity, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("iissiii", $user_id, $product_id, $product_name, $image_file, $price, $quantity, $total);
        $stmt_insert->execute();
        $stmt_insert->close();
    }

    $stmt_check->close();

    echo "<script>
        alert('Item added to cart successfully.');
        window.location = 'user_cart.php';
    </script>";
    exit();
} else {
    header("Location: user_cart.php");
    exit();
}