<?php
include("connection.php");

$sql = "DELETE FROM user_table WHERE id='" . $_GET['id'] . "'";
if (mysqli_query($conn, $sql)) {
    echo "<script>
    alert('Record Successfully Deleted');
    window.location='user_table.php';
    </script>";
} else {
    echo "<script>
    alert('Error deleting: ' . mysqli_error($conn));
    window.location='user_table.php';
    </script>";
}
$conn->close();
?>