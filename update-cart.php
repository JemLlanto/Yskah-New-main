<?php
include ('connection.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = intval($_POST['order_id']);
    $quantity = intval($_POST['quantity']);
    $variant_content_ids = [];
    $total_price = 0;

    if (isset($_POST['variants']) && is_array($_POST['variants'])) {
        foreach ($_POST['variants'] as $variant_id => $value) {
            list($variant_content_id, $price) = explode('-', $value);
            $variant_content_ids[] = intval($variant_content_id);
            $total_price += floatval($price);
        }
    }

    $variant_content_ids_str = implode(',', $variant_content_ids);
    $total_price *= $quantity;

    // Update the order in the database
    $update_query = "UPDATE order_table SET variant_content_ids = '$variant_content_ids_str', quantity = $quantity, price = $total_price WHERE order_id = $order_id";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        echo "Order updated successfully.";
        header("location: user_cart.php");
    } else {
        echo "Failed to update order: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>