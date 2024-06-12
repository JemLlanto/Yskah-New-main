<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"], $_POST["password"], $_POST["confirm_password"], $_POST["user_id"])) {
        // Sanitize and validate input data
        $username = htmlspecialchars(trim($_POST['username']));
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $user_id = intval($_POST['user_id']);

        // Check if the passwords match
        if ($password === $confirm_password) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare an SQL statement to prevent SQL injection
            $stmt = $conn->prepare("UPDATE user_table SET username=?, password=? WHERE user_id=?");
            $stmt->bind_param("ssi", $username, $hashed_password, $user_id);

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
                alert('Passwords do not match.');
                window.location='admin_setting.php';
                </script>";
        }
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