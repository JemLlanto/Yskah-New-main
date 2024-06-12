<?php 
include("connection.php");

if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['sex']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['province']) && isset($_POST['zip']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zip = $_POST['zip'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    



    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_table (first_name, last_name, sex, phone, address, city, province, zip, username, email, password) VALUES ('$first_name', '$last_name', '$sex', '$phone', '$address', '$city', '$province', '$zip', '$username', '$email', '$hashed_password')";

    $email_checker = "SELECT * FROM user_table WHERE email='$email'";
    $email_checker_result = $conn->query($email_checker);
    $username_checker = "SELECT * FROM user_table WHERE username='$username'";
    $username_checker_result = $conn->query($username_checker);

    if($email_checker_result->num_rows > 0){
        echo "<script>
        alert('Email already exist.');
        window.location='registration_form.php';
        </script>";
    } else if($username_checker_result->num_rows > 0){
            echo "<script>
            alert('Username already exist. ');
            window.location='registration_form.php';
            </script>";
    } else {
        if($conn->query($sql) === TRUE) {
            echo "<script>
            alert('Registration success');
            window.location= 'login_form.php';
            </script>";
        } else {
            echo "Error" . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>