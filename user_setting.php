<?php
    include("sessionchecker.php");
    include("connection.php");
    include("head.php");

    $sql = "SELECT * FROM user_table WHERE username='" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);


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
      
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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
            password='$hashed_password' WHERE id='" . $_POST['id'] . "'");
          echo "<script>
          alert('Record Successfully modified');
          window.location='user_setting.php';
          </script>";
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <link rel="stylesheet" href="css/user_settings.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div
            class="container-fluid ms-0 ms-md-3 d-flex align-items-center justify-content-center justify-content-md-between">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="width:15px"></span>
            </button>

            <a id="img" class="navbar-brand" href="#">
                <img src="img\LOGOO.png" alt="YsakaLogo" class="d-inline-block float-start" style="width: 110px">
            </a>

            <div class="d-flex align-items-center justify-content-center justify-content-md-end d-lg-none">
                <div class="d-none d-md-block">
                    <a href="login_form.php" class="">

                    </a>
                </div>
                <div class="d-none d-md-block">
                    <img src="img\default-profile.jpg" alt="profile" class="" style="width: 50px">
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav nav-fill gap-2 p-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark " href="user_landing_page.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark active" aria-current="page" href="user_products.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">About Us</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container-fluid mt-3 d-flex flex-column align-items-center justify-content-center">
        <div class="card m-3">
            <div class="card-header d-flex justify-content-between align-items-center p-3">
                <p class="card-text m-0">Profile</p>
                <p class="card-text">ID: <?php echo $row['user_id']; ?></p>
            </div>

            <div class="row g-0">
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center pt-3 pb-3">
                    <img class="w-100" src="img/default-profile.jpg" alt="">
                </div>
                <div class="col-md-8  d-flex justify-content-around align-items-center">
                    <div class="card-body d-flex justify-content-around ">
                        <div class="text">
                            <p class="card-text">First Name: </p>
                            <p class="card-text">Last Name:</p>
                            <p class="card-text">Username:</p>
                            <p class="card-text">Sex: </p>
                        </div>
                        <div class="info">
                            <p><?php echo $row["first_name"]; ?></p>
                            <p> <?php echo $row["last_name"]; ?></p>
                            <p> <?php echo $row["username"]; ?></p>
                            <p><?php echo $row["sex"]; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion  mb-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Update
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body p-3 bg-light">
                        <div class="wrapper">
                            <h2 class="mb-4">Update</h2>
                            <form method="POST">
                                <div class="row pb-3 g-2">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="firstName" name="first_name"
                                            placeholder="John" value="<?php echo $row['first_name'];?>" />
                                        <label for="firstName" class="form-label text-secondary ps-3">First name</label>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <input type="text" class="form-control" id="lastname" name="last_name"
                                            placeholder="Doe" value="<?php echo $row['last_name'];?>" />
                                        <label for="lastName" class="form-label text-secondary ps-3">Last name</label>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="sex">Sex</label>
                                    <select class="form-select" id="sex" name="sex">
                                        <option selected>Choose...</option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>
                                </div>

                                <div class="form-floating mb-3 w-100">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="name@example.com" value="<?php echo $row['email'];?>" />
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
                                        <input type="text" class="form-control" id="username" placeholder="username"
                                            name="username" value="<?php echo $row['username'];?>" />
                                        <label for="username" class="form-label text-secondary">Username</label>
                                    </div>
                                    <div class="form-floating mb-3 w-50">
                                        <input type="password" class="form-control" id="password" placeholder="password"
                                            name="password" value="<?php echo $row['password'];?>" />
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
                </div>
            </div>
        </div>
    </div>

    <?php
    } else {
        echo "User not found.";
    }
    ?>

</body>

</html>