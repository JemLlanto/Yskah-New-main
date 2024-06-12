<?php
 include ("connection.php");
  if(count($_POST) > 0) {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $sex = $_POST['sex'];
      $phone = $_POST['phone'];
      $username = $_POST['username'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $province = $_POST['province'];
      $zip = $_POST['zip'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      // $result = mysqli_query($conn, "SELECT * FROM user_table WHERE id='" . $_POST['id'] . "'");
      // $row = $result->fetch_assoc();
      // $hashed_password = $row['password'];

      // $password = !empty($_POST['password']) ? $_POST['password'] : $hashed_password;

    mysqli_query($conn, "UPDATE user_table SET
      first_name='$first_name',
      last_name='$last_name',
      sex='$sex',
      phone='$phone',
      address='$address',
      city='$city',
      province='$province',
      zip='$zip',
      username='$username',
      email='$email',
      password='$password' WHERE id='" . $_POST['id'] . "'");
    echo "<script>
    alert('Record Successfully modified');
    window.location='user_table.php';
    </script>";
  }

  $result = mysqli_query($conn, "SELECT * FROM user_table WHERE id='" . $_GET['id'] . "'");
  $row = mysqli_fetch_array($result);
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <script defer src="js\bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <div class="wrapper bg-light">
            <h2 class="mb-4">Update</h2>
            <form method="POST">
                <div class="d-flex gap-1">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-floating mb-3 w-50 ">
                        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="John"
                            value="<?php echo $row['first_name'];?>" />
                        <label for="firstName" class="form-label text-secondary">First name</label>
                    </div>
                    <div class="form-floating mb-3 w-50">
                        <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Doe"
                            value="<?php echo $row['last_name'];?>" />
                        <label for="lastName" class="form-label text-secondary">Last name</label>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <label class="input-group-text" for="sex">Sex</label>
                    <select class="form-select" id="sex" name="sex">
                        <option selected>Choose...</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>

                <div class="form-floating mb-3 w-100">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        value="<?php echo $row['email'];?>" />
                    <label for="email" class="form-label text-secondary">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="63+"
                        value="<?php echo $row['phone'];?>" />
                    <label for="phone" class="form-label text-secondary">Phone</label>
                </div>

                <div class="row pb-2">
                    <div class="col-12 pb-2">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="inputAddress" name="address"
                            placeholder="1234 Main St">
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">City</label>
                        <input type="text" class="form-control" name="city" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputProvince" class="form-label">Province</label>
                        <input type="text" class="form-control" name="province" id="inputProvince">
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label">Zip</label>
                        <input type="text" class="form-control" name="zip" id="inputZip">
                    </div>
                </div>

                <div class="d-flex gap-1">
                    <div class="form-floating mb-3 w-50">
                        <input type="text" class="form-control" id="username" placeholder="username" name="username"
                            value="<?php echo $row['username'];?>" />
                        <label for="username" class="form-label text-secondary">Username</label>
                    </div>
                    <div class="form-floating mb-3 w-50">
                        <input type="password" class="form-control" id="password" placeholder="password" name="password"
                            value="<?php echo $row['password'];?>" />
                        <label for="password" class="form-label text-secondary">Password</label>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <div class="">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>

</html>