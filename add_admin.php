<?php
include ("connection.php");

if (isset($_POST['is_admin']) && ($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password'])) {
    $is_admin = $_POST['is_admin'];
    $access = $_POST['is_admin'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];



    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $usersql = "INSERT INTO user (access, username, uname, password) VALUES ('$access', '$username', '$username', '$hashed_password')";
    $sql = "INSERT INTO user_table (is_admin,first_name, last_name, username, email,phone, password) VALUES ('$is_admin','$first_name', '$last_name', '$phone', '$username', '$email', '$hashed_password')";

    $email_checker = "SELECT * FROM user_table WHERE email='$email'";
    $email_checker_result = $conn->query($email_checker);
    $username_checker = "SELECT * FROM user_table WHERE username='$username'";
    $username_checker_result = $conn->query($username_checker);

    if ($email_checker_result->num_rows > 0) {
        echo "<script>
        alert('Email already exist.');
        window.location='add_admin_form.php';
        </script>";
    } else if ($username_checker_result->num_rows > 0) {
        echo "<script>
            alert('Username already exist. ');
            window.location='add_admin_form.php';
            </script>";
    } else {
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            alert('Registration success');
            window.location= 'admin.php';
            </script>";
        } else {
            echo "Error" . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>