<?php
include ("connection.php");

if (
    isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['sex']) && isset($_POST['phone']) &&
    isset($_POST['blockLot']) && isset($_POST['subdivision']) && isset($_POST['barangay']) &&
    isset($_POST['city']) && isset($_POST['province']) && isset($_POST['zip']) && 
    isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])
) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $blockLot = $_POST['blockLot'];
    $subdivision = $_POST['subdivision'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zip = $_POST['zip'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $image_file = 'default-profile.jpg';
    
    $email_checker = "SELECT * FROM user_table WHERE email=?";
    $username_checker = "SELECT * FROM user_table WHERE username=?";
    
    $stmt_email = $conn->prepare($email_checker);
    $stmt_email->bind_param("s", $email);
    $stmt_email->execute();
    $email_checker_result = $stmt_email->get_result();

    $stmt_username = $conn->prepare($username_checker);
    $stmt_username->bind_param("s", $username);
    $stmt_username->execute();
    $username_checker_result = $stmt_username->get_result();

    if ($email_checker_result->num_rows > 0) {
        echo "<script>
        alert('Email already exists.');
        window.location='registration_form.php';
        </script>";
    } else if ($username_checker_result->num_rows > 0) {
        echo "<script>
        alert('Username already exists.');
        window.location='registration_form.php';
        </script>";
    } else {

        $sql = "INSERT INTO user_table (first_name, last_name, sex, phone, blockLot, subdivision, barangay, city, province, zip, username, email, password, image_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssss", $first_name, $last_name, $sex, $phone, $blockLot, $subdivision, $barangay, $city, $province, $zip, $username, $email, $hashed_password, $image_file);

        $uname = $username;
        $access = 2; 
        $sql_2 = "INSERT INTO user (username, password, uname, access) VALUES (?, ?, ? ,?)";
        $stmt_2 = $conn->prepare($sql_2);
        $stmt_2->bind_param("sssi", $username, $password, $uname, $access);

        if ($stmt->execute() && $stmt_2->execute()) {
            echo "<script>
            alert('Registration successful');
            window.location='login_form.php';
            </script>";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $stmt_2->close();
    }

    $stmt_email->close();
    $stmt_username->close();
}
$conn->close();
?>