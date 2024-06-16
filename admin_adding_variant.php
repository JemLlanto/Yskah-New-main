<?php
include ("connection.php");

if (isset($_POST['addvariant'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];

    // Check if product_id and name are not empty
    if (!empty($product_id) && !empty($name)) {
        // Prepare the SQL statement
        $stmt1 = $conn->prepare("INSERT INTO variant_table (product_id, name) VALUES (?, ?)");
        if ($stmt1) {
            $stmt1->bind_param("is", $product_id, $name);
            if ($stmt1->execute()) {
                // Close the statement
                $stmt1->close();

                // Success message
                echo "<script>
                alert('Variant added successfully.');
                window.location = 'admin-products.php';
                </script>";
                exit();
            } else {
                // Handle execution error
                echo "<script>
                alert('Error: Could not execute the query.');
                window.location = 'admin-products.php';
                </script>";
                exit();
            }
        } else {
            // Handle preparation error
            echo "<script>
            alert('Error: Could not prepare the query.');
            window.location = 'admin-products.php';
            </script>";
            exit();
        }
    } else {
        // Handle empty input fields
        echo "<script>
        alert('Error: Product ID and Name cannot be empty.');
        window.location = 'admin-products.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
    alert('Variant not added.');
    window.location = 'admin-products.php';
    </script>";
    exit();
}

// Close the connection
$conn->close();
?>