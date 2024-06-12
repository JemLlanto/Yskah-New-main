<?php
include ("sessionchecker.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['index']) && filter_var($_POST['index'], FILTER_VALIDATE_INT) !== false) {
        $index = $_POST['index'];
        $order_id = $_POST['order_id'];

        if (isset($_SESSION['cart'][$index])) {
            if (!empty($order_id)) {
                include ("connection.php");

                $stmt = $conn->prepare("DELETE FROM order_table WHERE order_id = ?");
                $stmt->bind_param("i", $order_id);
                $stmt->execute();

                $stmt->close();
                $conn->close();

                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            } else {
                echo "Error: order_id is missing.";
                exit();
            }
        }
    }

    header("Location: user_cart.php");
    exit();
} else {
    header("Location: user_products.php");
    exit();
}