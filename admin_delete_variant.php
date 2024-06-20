<?php
include ("sessionchecker.php");
include ("connection.php");

if (isset($_POST['removevariant'])) {
    $variant_id = $_POST['variant_id'];

    // Check if the variant_id is not empty
    if (!empty($variant_id)) {
        // Prepare the SQL statements
        $stmt1 = $conn->prepare("DELETE FROM variant_content WHERE variant_id = ?");
        $stmt2 = $conn->prepare("DELETE FROM variant_table WHERE variant_id = ?");

        if ($stmt1 && $stmt2) {
            // Bind the parameters
            $stmt1->bind_param("i", $variant_id);
            $stmt2->bind_param("i", $variant_id);

            // Execute the statements
            $stmt1_success = $stmt1->execute();
            $stmt2_success = $stmt2->execute();

            // Close the statements
            $stmt1->close();
            $stmt2->close();

            if ($stmt1_success && $stmt2_success) {
                echo "<script>
                alert('Variant deleted successfully.');
                window.location = 'admin-products.php';
                </script>";
            } else {
                echo "<script>
                alert('Error: Could not execute the queries.');
                window.location = 'admin-products.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Error: Could not prepare the queries.');
            window.location = 'admin-products.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Error: Variant ID cannot be empty.');
        window.location = 'admin-products.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Variant not removed.');
    window.location = 'admin-products.php';
    </script>";
}

// Close the connection
$conn->close();
?>