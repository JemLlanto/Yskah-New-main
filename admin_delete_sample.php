<?php
include ("sessionchecker.php");
include ("connection.php");

if (isset($_POST['removesample'])) {
    $sample_id = $_POST['sample_id'];

    // Check if the sample_id is not empty
    if (!empty($sample_id)) {
        // Prepare the SQL statement to get the image filename
        $stmt0 = $conn->prepare("SELECT image_file FROM product_samples WHERE sample_id = ?");

        if ($stmt0) {
            // Bind the parameters
            $stmt0->bind_param("i", $sample_id);

            // Execute the statement
            $stmt0->execute();

            // Bind the result variable
            $stmt0->bind_result($image_filename);

            // Fetch the result
            $stmt0->fetch();

            // Close the statement
            $stmt0->close();

            // If the image file exists, delete it
            if ($image_filename) {
                $image_path = "product-images/product_samples/" . $image_filename;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            // Prepare the SQL statement to delete the record
            $stmt1 = $conn->prepare("DELETE FROM product_samples WHERE sample_id = ?");

            if ($stmt1) {
                // Bind the parameters
                $stmt1->bind_param("i", $sample_id);

                // Execute the statement
                $stmt1_success = $stmt1->execute();

                // Close the statement
                $stmt1->close();

                if ($stmt1_success) {
                    echo "<script>
                    alert('Sample deleted successfully.');
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
                alert('Error: Could not prepare the delete query.');
                window.location = 'admin-products.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Error: Could not prepare the select query.');
            window.location = 'admin-products.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Error: Sample ID cannot be empty.');
        window.location = 'admin-products.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Sample not removed.');
    window.location = 'admin-products.php';
    </script>";
}

// Close the connection
$conn->close();
?>