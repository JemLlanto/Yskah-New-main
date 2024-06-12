<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {

    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['quantity'];


    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['product_id'] == $product_id) {

            $_SESSION['cart'][$index]['quantity'] = $new_quantity;


            $stmt = $conn->prepare("UPDATE order_table SET quantity = ? WHERE product_id = ?");
            $stmt->bind_param("ii", $new_quantity, $product_id);
            $stmt->execute();
            $stmt->close();

            break;
        }
    }
}

$conn->close();

header("Location: user_cart.php");
exit();
