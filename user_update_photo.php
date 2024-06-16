<?php
include ("connection.php");
include ("sessionchecker.php");

if (isset($_POST['submit'])) {
	if (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] !== UPLOAD_ERR_OK) {
		echo "<script>alert('Image does not exist.');
        window.location='user_setting.php';
        </script>";
	} else {
		$file_name = $_FILES['image_file']['name'];
		$file_size = $_FILES['image_file']['size'];
		$tmpname = $_FILES["image_file"]["tmp_name"];

		$validImageExtension = ['jpg', 'jpeg', 'png'];
		$imageExtension = explode('.', $file_name);
		$imageExtension = strtolower(end($imageExtension));

		if (!in_array($imageExtension, $validImageExtension)) {
			echo "<script>alert('Invalid image extension.');
            window.location='user_setting.php';
            </script>";
		} else if ($file_size > 2000000) {
			echo "<script>alert('Image size is too large.');
            window.location='user_setting.php';
            </script>";
		} else {
			$newImageName = uniqid() . '.' . $imageExtension;
			$uploadPath = 'profile_picture/' . $newImageName;

			if (!file_exists('profile_picture')) {
				mkdir('profile_picture', 0777, true);
			}

			move_uploaded_file($tmpname, $uploadPath);

			$stmt = $conn->prepare("UPDATE user_table SET image_file = ? WHERE user_id = ?");
			$user_id = $_SESSION['user_id'];
			$stmt->bind_param("si", $newImageName, $user_id);
			$stmt->execute();
			$stmt->close();

			echo "<script>
            alert('Profile picture updated successfully.');
            window.location='user_setting.php';
            </script>";
		}
	}
}

$conn->close();
?>