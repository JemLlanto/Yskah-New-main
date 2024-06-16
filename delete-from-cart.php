<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = intval($_POST['order_id']);

    $stmt = $conn->prepare("DELETE FROM order_table WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>
    alert('Product removed from cart');
    window.location = 'user_cart.php';
    </script>";
    exit();
} else {
    header("Location: user_cart.php");
    exit();
}
?>