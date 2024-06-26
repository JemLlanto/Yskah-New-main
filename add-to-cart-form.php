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

    // Collect variant data
    $variants = $_POST['variants'];
    $variant_ids = [];
    $variant_content_ids = [];
    $total_variant_price = 0;

    foreach ($variants as $variant_id => $variant_value) {
        list($variant_content_id, $variant_price) = explode('-', $variant_value);
        $variant_ids[] = $variant_id;
        $variant_content_ids[] = $variant_content_id;
        $total_variant_price += floatval($variant_price);
    }

    $variant_ids_str = implode(',', $variant_ids);
    $variant_content_ids_str = implode(',', $variant_content_ids);
    $total_price_per_unit = $total_variant_price; // Corrected: only sum variant prices

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
        $stmt_update->bind_param("iii", $new_quantity, $new_total, $order_id);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        // Product not in cart, insert a new row
        $total = $quantity * $total_price_per_unit;

        $stmt_insert = $conn->prepare("INSERT INTO order_table (user_id, product_id, product_name, image_file, price, quantity, total, variant_ids, variant_content_ids) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("iissiiiss", $user_id, $product_id, $product_name, $image_file, $total_price_per_unit, $quantity, $total, $variant_ids_str, $variant_content_ids_str);
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
