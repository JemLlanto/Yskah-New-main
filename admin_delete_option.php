<?php
include ("sessionchecker.php");
include ("connection.php");

if (isset($_POST['removeoption'])) {
    $variant_content_id = $_POST['variant_content_id'];

    // Check if the variant_id is not empty
    if (!empty($variant_content_id)) {
        // Prepare the SQL statements
        $stmt1 = $conn->prepare("DELETE FROM variant_content WHERE variant_content_id = ?");

        if ($stmt1) {
            // Bind the parameters
            $stmt1->bind_param("i", $variant_content_id);

            // Execute the statements
            $stmt1_success = $stmt1->execute();

            // Close the statements
            $stmt1->close();


            if ($stmt1_success) {
                echo "<script>
                alert('Option deleted successfully.');
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
        alert('Error: Variant Content ID cannot be empty.');
        window.location = 'admin-products.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Content not removed.');
    window.location = 'admin-products.php';
    </script>";
}

// Close the connection
$conn->close();
?>