<?php
include ("connection.php");

if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    if ($_FILES['image_file']['error'] === 4) {
        echo "<script>alert('Image does not exist.');
        window.location='admin-adding-products-form.php';
        </script>";
    } else {
        $file_name = $_FILES['image_file']['name'];
        $file_size = $_FILES['image_file']['size'];
        $tmpname = $_FILES["image_file"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $file_name);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid image extension.');
            window.location='admin-adding-products-form.php';
            </script>";
        } else if ($file_size > 2000000) {
            echo "<script>alert('Image size is too large.');
            window.location='admin-adding-products-form.php';
            </script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;

            if (!file_exists('product-images')) {
                mkdir('product-images', 0777, true);
            }

            if (move_uploaded_file($tmpname, 'product-images/' . $newImageName)) {
                // Start transaction
                $conn->begin_transaction();

                try {
                    // Insert into products table
                    $stmt = $conn->prepare("INSERT INTO products (product_name, image_file, price) VALUES (?, ?, ?)");
                    $stmt->bind_param("ssd", $product_name, $newImageName, $price);
                    $stmt->execute();

                    // Get the last inserted product_id
                    $product_id = $stmt->insert_id;

                    // Insert into sales table
                    $stmt1 = $conn->prepare("INSERT INTO sales (product_id, product_name, price) VALUES (?, ?, ?)");
                    $stmt1->bind_param("isd", $product_id, $product_name, $price);
                    $stmt1->execute();

                    // Commit transaction
                    $conn->commit();

                    echo "<script>
                        alert('Product uploaded successfully.');
                        window.location='admin-products.php';
                        </script>";
                } catch (Exception $e) {
                    // Rollback transaction
                    $conn->rollback();

                    echo "<script>
                        alert('Failed to upload product.');
                        window.location='admin-products.php';
                        </script>";
                }

                // Close the statements
                $stmt->close();
                $stmt1->close();
            } else {
                echo "<script>
                    alert('Failed to upload image.');
                    window.location='admin-products.php';
                    </script>";
            }
        }
    }
}

// Close the connection
$conn->close();
?>