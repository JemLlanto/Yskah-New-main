<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = intval($_POST['order_id']);

    $stmt = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>
    alert('Order successfully canceled!');
    window.location = 'admin_order.php';
    </script>";
    exit();
} else {
    header("Location: admin_order.php");
    exit();
}
?>