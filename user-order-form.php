<?php
include("sessionchecker.php");
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $total_price = floatval($_POST['totalPrice']);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Ensure selected_items is received and decode it
    $selected_items = isset($_POST['selected_items']) ? json_decode($_POST['selected_items'], true) : [];

    if (empty($selected_items)) {
        echo "<script>
            alert('No items selected.');
            window.location = 'user_cart.php';
        </script>";
        exit();
    }

    $conn->begin_transaction();

    try {
        // Insert into notification_table
        $stmt1 = $conn->prepare("INSERT INTO notification_table (user_id, title, description, status) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("isss", $user_id, $title, $description, $status);
        $stmt1->execute();
        $stmt1->close();

        foreach ($selected_items as $order_id) {
            $sql = "SELECT * FROM order_table WHERE order_id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $order_id, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($item = $result->fetch_assoc()) {
                $product_id = $item['product_id'];
                $product_name = $item['product_name'];
                $image_file = $item['image_file'];
                $price = $item['price'];
                $quantity = $item['quantity'];

                // Insert each item into order_items table with correct order_id
                $stmt_insert_item = $conn->prepare("INSERT INTO order_items (order_id, user_id, product_id, product_name, image_file, price, quantity, total_price, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
                $stmt_insert_item->bind_param("iiissiii", $order_id, $user_id, $product_id, $product_name, $image_file, $price, $quantity, $total_price);
                $stmt_insert_item->execute();
                $stmt_insert_item->close();

                // Remove item from order_table
                $stmt_delete = $conn->prepare("DELETE FROM order_table WHERE order_id = ?");
                $stmt_delete->bind_param("i", $order_id);
                $stmt_delete->execute();
                $stmt_delete->close();
            }
        }

        $conn->commit();

        echo "<script>
            alert('Order placed successfully.');
            window.location = 'user_order.php';
        </script>";
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
            alert('Failed to place order. Please try again.');
            window.location = 'user_cart.php';
        </script>";
        exit();
    }
} else {
    header("Location: user_cart.php");
    exit();
}
