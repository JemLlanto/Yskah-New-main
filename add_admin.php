<?php
include ("connection.php");

if (isset($_POST['is_admin']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password'])) {
    $is_admin = $_POST['is_admin'];
    $access = $_POST['is_admin'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user_table (is_admin, first_name, last_name, username, email, phone, password) VALUES ('$is_admin', '$first_name', '$last_name', '$username', '$email', '$phone', '$hashed_password')";

    $email_checker = "SELECT * FROM user_table WHERE email='$email'";
    $email_checker_result = $conn->query($email_checker);
    $username_checker = "SELECT * FROM user_table WHERE username='$username'";
    $username_checker_result = $conn->query($username_checker);

    if ($email_checker_result->num_rows > 0) {
        echo "<script>
        alert('Email already exists.');
        window.location='add_admin_form.php';
        </script>";
    } else if ($username_checker_result->num_rows > 0) {
        echo "<script>
            alert('Username already exists.');
            window.location='add_admin_form.php';
            </script>";
    } else {
        if ($conn->query($sql) === TRUE) {
            mysqli_query($conn, "INSERT INTO `user` (uname, username, password, access) VALUES ('$first_name', '$username', '$hashed_password', '1')");

            if (isset($_POST['chat_name'])) {
                $cid = "";
                $chat_name = $_POST['username'];

                mysqli_query($conn, "INSERT INTO chatroom (chat_name, date_created, userid) VALUES ('$chat_name', NOW(), '1')");
                $cid = mysqli_insert_id($conn);

                mysqli_query($conn, "INSERT INTO chat_member (chatroomid, userid) VALUES ('$cid', '1')");
            }

            echo "<script>
            alert('Registration successful');
            window.location='admin.php';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>