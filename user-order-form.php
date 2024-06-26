<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $total = floatval($_POST['totalPrice']);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $to_user = 0;

    $a_title = $_POST['a_title'];
    $a_description = $_POST['a_description'];
    $to_admin = $_POST['to_admin'];

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
        // Generate the order number
        $order_number = mt_rand(1000000, 9999999);

        // Add order number to the notification description
        // $description_with_order_number = $description . " Order Number: " . $order_number;

        // Insert notification with order number
        $stmt1 = $conn->prepare("INSERT INTO notification_table (user_id, title, description, status, order_number, to_admin) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("issssi", $user_id, $title, $description, $status, $order_number, $to_user);
        $stmt1->execute();
        $stmt1->close();

        $stmt2 = $conn->prepare("INSERT INTO notification_table (user_id, title, description, to_admin, order_number) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("issss", $user_id, $a_title, $a_description, $to_admin, $order_number);
        $stmt2->execute();
        $stmt2->close();

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
                $total_price = $price * $quantity;

                $variant_ids = $item['variant_ids'];
                $variant_content_ids = $item['variant_content_ids'];

                $stmt_insert_item = $conn->prepare("INSERT INTO order_items (order_id, user_id, product_id, product_name, image_file, price, quantity, total_price, total, status, order_number, variant_ids, variant_content_ids) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?, ?)");
                $stmt_insert_item->bind_param("iiissiiiisss", $order_id, $user_id, $product_id, $product_name, $image_file, $price, $quantity, $total_price, $total, $order_number, $variant_ids, $variant_content_ids);
                $stmt_insert_item->execute();
                $stmt_insert_item->close();

                $stmt_delete = $conn->prepare("DELETE FROM order_table WHERE order_id = ?");
                $stmt_delete->bind_param("i", $order_id);
                $stmt_delete->execute();
                $stmt_delete->close();
            }
            $stmt->close();
        }

        // Commit transaction
        $conn->commit();

        echo "<script>
            alert('Order placed successfully.');
            window.location = 'user_order.php';
        </script>";
        exit();
    } catch (Exception $e) {
        // Rollback on failure
        $conn->rollback();
        echo "<script>
            alert('Failed to place order. Please try again.');
            window.location = 'user_cart.php';
        </script>";
        exit();
    }
} else {
    // Redirect if not a POST request
    header("Location: user_cart.php");
    exit();
}
?>