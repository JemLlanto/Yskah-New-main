<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["blockLot"], $_POST["subdivision"], $_POST["barangay"], $_POST["city"], $_POST["province"], $_POST["zip"], $_POST["user_id"])) {
        // Sanitize and validate input data
        $blockLot = htmlspecialchars(trim($_POST['blockLot']));
        $subdivision = htmlspecialchars(trim($_POST['subdivision']));
        $barangay = htmlspecialchars(trim($_POST['barangay']));
        $city = htmlspecialchars(trim($_POST['city']));
        $province = htmlspecialchars(trim($_POST['province']));
        $zip = htmlspecialchars(trim($_POST['zip']));
        $user_id = intval($_POST['user_id']);

        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("UPDATE user_table SET blockLot=?, subdivision=?, barangay=?, city=?, province=?, zip=? WHERE user_id=?");
        $stmt->bind_param("ssssssi", $blockLot, $subdivision, $barangay, $city, $province, $zip, $user_id);

        if ($stmt->execute()) {
            echo "<script>
                alert('Record Successfully modified');
                window.location='admin_setting.php';
                </script>";
        } else {
            echo "<script>
                alert('Error updating record: " . $stmt->error . "');
                window.location='admin_setting.php';
                </script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>
            alert('All fields are required.');
            window.location='admin_setting.php';
            </script>";
    }
}

// Close the database connection
$conn->close();
?>