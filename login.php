<?php
include ('connection.php');
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$chat_name = $_POST['username'];


// Prepare and execute the first query
$stmt = $conn->prepare("SELECT * FROM user_table WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Prepare and execute the second query
$stmt2 = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt2->bind_param("s", $username);
$stmt2->execute();
$result_chat = $stmt2->get_result();

// Prepare and execute the third query
$stmt3 = $conn->prepare("SELECT * FROM chatroom WHERE chat_name = ?");
$stmt3->bind_param("s", $chat_name);
$stmt3->execute();
$result_chatroom = $stmt3->get_result();

if ($result->num_rows > 0 && $result_chat->num_rows > 0 && $result_chatroom->num_rows > 0) {
    $row = $result->fetch_assoc();
    $row2 = $result_chat->fetch_assoc();
    $row3 = $result_chatroom->fetch_assoc();
    $hashed_password = $row['password'];

    if (password_verify($password, $hashed_password)) {
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
    } else {
        echo "<script>
        alert('Invalid password');
        window.location='login_form.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Invalid username');
    window.location='login_form.php';
    </script>";
}

$stmt->close();
$stmt2->close();
$stmt3->close();
$conn->close();
?>