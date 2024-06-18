<?php
include ("connection.php");

if (isset($_POST['addoption'])) {
    $variant_id = $_POST['variant_id'];
    $option_name1 = $_POST['option_name1'];
    $option_price1 = $_POST['option_price1'];
    $option_name2 = $_POST['option_name2'];
    $option_price2 = $_POST['option_price2'];
    $option_name3 = $_POST['option_name3'];
    $option_price3 = $_POST['option_price3']; // Assuming you meant option_price3

    // Array to store all option names and prices
    $options = [
        ['option' => $option_name1, 'price' => $option_price1],
        ['option' => $option_name2, 'price' => $option_price2],
        ['option' => $option_name3, 'price' => $option_price3]
    ];

    $success = true;

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO variant_content (variant_id, option, price) VALUES (?, ?, ?)");
    if ($stmt) {
        foreach ($options as $option) {
            // Skip empty options
            if (empty($option['option']) || empty($option['price'])) {
                continue;
            }

            // Bind the parameters
            $stmt->bind_param("isd", $variant_id, $option['option'], $option['price']);

            // Execute the statement
            if (!$stmt->execute()) {
                $success = false;
                break;
            }
        }

        // Close the statement
        $stmt->close();
    } else {
        $success = false;
    }

    if ($success) {
        // Success message
        echo "<script>
        alert('Variant added successfully.');
        window.location = 'admin-products.php';
        </script>";
    } else {
        // Handle errors
        echo "<script>
        alert('Error: Could not execute the query.');
        window.location = 'admin-products.php';
        </script>";
    }

    // Close the connection
    $conn->close();
    exit();
} else {
    echo "<script>
    alert('Variant not added.');
    window.location = 'admin-products.php';
    </script>";
    exit();
}
?>