<?php
include ("sessionchecker.php");
include ("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["sex"]) && isset($_POST["phone"])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $sex = $_POST['sex'];
        $phone = $_POST['phone'];
        $user_id = ($_POST['user_id']);

        mysqli_query($conn, "UPDATE user_table SET
            first_name='$first_name',
            last_name='$last_name',
            sex='$sex',
            phone='$phone' WHERE user_id='" . $_POST['user_id'] . "'");
        echo "<script>
          alert('Record Successfully modified');
          window.location='admin_setting.php';
          </script>";
    }
}

?>