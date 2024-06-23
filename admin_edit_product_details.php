<?php
include ("connection.php");

if (isset($_POST['editproduct'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Retrieve the current image file name
    $stmt = $conn->prepare("SELECT image_file FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($currentImage);
    $stmt->fetch();
    $stmt->close();

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['image_file']['name'];
        $file_size = $_FILES['image_file']['size'];
        $tmpname = $_FILES["image_file"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $file_name);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid image extension.');
            window.location='admin-products.php';
            </script>";
            exit();
        } else if ($file_size > 2000000) {
            echo "<script>alert('Image size is too large.');
            window.location='admin-products.php';
            </script>";
            exit();
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            $uploadPath = 'product-images/' . $newImageName;

            if (!file_exists('product-images')) {
                mkdir('product-images', 0777, true);
            }

            if (move_uploaded_file($tmpname, $uploadPath)) {
                // Delete the old image file
                if (!empty($currentImage) && file_exists('product-images/' . $currentImage)) {
                    unlink('product-images/' . $currentImage);
                }

                $stmt = $conn->prepare("UPDATE products SET image_file = ?, product_name = ?, price = ?, description = ? WHERE product_id = ?");
                $stmt->bind_param("ssdsi", $newImageName, $product_name, $price, $description, $product_id);
            } else {
                echo "<script>alert('Failed to upload new image.');
                window.location='admin-products.php';
                </script>";
                exit();
            }
        }
    } else {
        $stmt = $conn->prepare("UPDATE products SET product_name = ?, price = ?, description = ? WHERE product_id = ?");
        $stmt->bind_param("sdsi", $product_name, $price, $description, $product_id);
    }

    $stmt->execute();
    $stmt->close();

    // Update the sales table
    $stmt1 = $conn->prepare("UPDATE sales SET product_name = ?, price = ? WHERE product_id = ?");
    $stmt1->bind_param("sdi", $product_name, $price, $product_id);
    $stmt1->execute();
    $stmt1->close();

    echo "<script>
    alert('Product updated successfully.');
    window.location='admin-products.php';
    </script>";
}

$conn->close();
?>