<?php
include ('../conn.php');
session_start();

if (isset($_FILES['image']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($imageActualExt, $allowed)) {
        if ($imageError === 0) {
            if ($imageSize < 1000000) {
                $imageNewName = uniqid('', true) . "." . $imageActualExt;
                $imageDestination = '../uploads/' . $imageNewName;
                move_uploaded_file($imageTmpName, $imageDestination);

                mysqli_query($conn, "insert into chat (chatroomid, message, userid, chat_date, image) values ('$id', '', '" . $_SESSION['id'] . "', NOW(), '$imageDestination')") or die(mysqli_error());
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}
?>