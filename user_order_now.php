<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $base_price = floatval($_POST['price']);
    $image_file = $_POST['image_file'];
    $quantity = intval($_POST['quantity']);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Collect variant data
    $order_variants = $_POST['order_variants'];
    $variant_ids = [];
    $variant_content_ids = [];
    $total_variant_price = 0;

    foreach ($order_variants as $variant_id => $variant_value) {
        list($variant_content_id, $variant_price) = explode('-', $variant_value);
        $variant_ids[] = $variant_id;
        $variant_content_ids[] = $variant_content_id;
        $total_variant_price += floatval($variant_price);
    }

    $variant_ids_str = implode(',', $variant_ids);
    $variant_content_ids_str = implode(',', $variant_content_ids);
    $total_price_per_unit = $base_price;

    // Calculate total price for the order
    $total = $quantity * $total_price_per_unit;

    // Check if the product already exists in the cart
    $stmt_check = $conn->prepare("SELECT order_id, quantity FROM order_table WHERE user_id = ? AND product_id = ? AND variant_ids = ? AND variant_content_ids = ?");
    $stmt_check->bind_param("iiss", $user_id, $product_id, $variant_ids_str, $variant_content_ids_str);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row = $result_check->fetch_assoc()) {
        // Product already in cart, update the quantity and total price
        $order_id = $row['order_id'];
        $new_quantity = $row['quantity'] + $quantity;
        $new_total = $new_quantity * $total_price_per_unit;

        $stmt_update = $conn->prepare("UPDATE order_table SET quantity = ?, total = ? WHERE order_id = ?");
        $stmt_update->bind_param("idi", $new_quantity, $new_total, $order_id);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        // Product not in cart, insert a new row
        $order_number = mt_rand(1000000, 9999999);

        $description_with_order_number = $description . " Order Number: " . $order_number;

        // Insert notification with order number
        $stmt1 = $conn->prepare("INSERT INTO notification_table (user_id, title, description, status) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("isss", $user_id, $title, $description_with_order_number, $status);
        $stmt1->execute();
        $stmt1->close();

        $stmt_insert = $conn->prepare("INSERT INTO order_table (user_id, product_id, product_name, image_file, price, quantity, total, variant_ids, variant_content_ids) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("iissiiiss", $user_id, $product_id, $product_name, $image_file, $base_price, $quantity, $total, $variant_ids_str, $variant_content_ids_str);
        $stmt_insert->execute();

        $order_id = $stmt_insert->insert_id; // Get the last inserted order ID

        $shippingCost = 150;
        $totalPayment = $total + $shippingCost;

        // Insert into order_items table with correct total price
        $stmt_insert_item = $conn->prepare("INSERT INTO order_items (order_id, user_id, product_id, product_name, image_file, price, quantity, total_price, total, status, order_number, variant_ids, variant_content_ids) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?, ?)");
        $stmt_insert_item->bind_param("iiissiiiisss", $order_id, $user_id, $product_id, $product_name, $image_file, $base_price, $quantity, $total_price_per_unit, $totalPayment, $order_number, $variant_ids_str, $variant_content_ids_str);
        $stmt_insert_item->execute();
        $stmt_insert_item->close();

        // Delete the temporary entry from order_table
        $stmt_delete = $conn->prepare("DELETE FROM order_table WHERE order_id = ?");
        $stmt_delete->bind_param("i", $order_id);
        $stmt_delete->execute();
        $stmt_delete->close();

        $stmt_insert->close();
    }

    $stmt_check->close();

    echo "<script>
        alert('Item ordered successfully.');
        window.location = 'user_order.php';
    </script>";
    exit();
} else {
    header("Location: user_product_preview.php");
    exit();
}
?>