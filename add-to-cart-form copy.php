<?php
include ("sessionchecker.php");
include ("connection.php");

if (isset($_POST['user_id']) && isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['image_file']) && isset($_POST['quantity'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $image_file = $_POST['image_file'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO order_table (user_id, product_id, product_name, price, image_file, quantity) VALUES ('$user_id', '$product_id', '$product_name', '$price', '$image_file', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Added to Cart Successfully');
            window.location= 'user_cart.php';
            </script>";
    } else {
        echo "Error" . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>