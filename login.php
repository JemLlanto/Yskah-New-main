<?php
include ('connection.php');
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$chat_name = $_POST['username'];


$sql = "SELECT * FROM user_table WHERE username='$username'";
$sql2 = "SELECT * FROM user WHERE username = '$username'";
$sql3 = "SELECT * FROM chatroom WHERE chat_name = '$chat_name'";
$result_chatroom = $conn->query($sql3);
$result_chat = $conn->query($sql2);
$result = $conn->query($sql);


if ($result->num_rows > 0 && $result_chat->num_rows > 0 && $result_chatroom->num_rows > 0) {
    $row = $result->fetch_assoc();
    $row2 = $result_chat->fetch_assoc();
    $row3 = $result_chatroom->fetch_assoc();
    $hashed_password = $row['password'];

    if (password_verify($password, $hashed_password)) {
        echo "<script>
        alert('Invalid username or password');
        window.location='login_form.php';
        </script>";
    }
    if ($row['is_admin'] == 1 && $row2['access'] == 1) {
        $_SESSION["username"] = $username;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['id'] = $row2['userid'];
        $_SESSION['chat_name'] = $row3['chat_name'];

        echo "<script>
        alert('Welcome Admin');
        window.location='admin.php';
        </script>";
    } else {
        $_SESSION["username"] = $username;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['id'] = $row2['userid'];
        $_SESSION['chat_name'] = $row3['chat_name'];
            
        echo "<script>
        alert('Welcome');
        window.location='user_landing_page.php';
        </script>";
    }
}
else {
    echo "<script>
    alert('Invalid username or password');
    window.location='login_form.php';
    </script>";
}