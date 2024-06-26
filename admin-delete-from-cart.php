<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_number = intval($_POST['order_number']);
    $user_id = $_POST['user_id'];
    $title = ($_POST['title']);
    $description = ($_POST['description']);

    // $description_with_order_number = $description . " Order Number: " . $order_number;

    // Insert notification with order number
    $stmt1 = $conn->prepare("INSERT INTO notification_table (user_id, title, description, order_number) VALUES (?, ?, ?, ?)");
    $stmt1->bind_param("issi", $user_id, $title, $description, $order_number);
    $stmt1->execute();
    $stmt1->close();

    $stmt = $conn->prepare("DELETE FROM order_items WHERE order_number = ?");
    $stmt->bind_param("i", $order_number);
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