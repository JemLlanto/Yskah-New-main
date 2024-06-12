<?php
    include("connection.php");
    include("head.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Yskah Creation - Home</title>
    <link rel="stylesheet" href="css\loginform.css" />
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center flex-column flex-lg-row">
        <div id="logo" class="mb-3">
            <img class="img-fluid" src="img\LOGOO.png" alt="">
        </div>
        <div class=" m-0 d-flex align-items-center justify-content-center">
            <div class="wrapper bg-white p-3 pt-4 pb-4 p-lg-5 ">
                <h2 class="mb-4">Log in</h2>
                <form action="login.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="password"
                            required />
                        <label for="username" class="form-label text-secondary">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password"
                            required />
                        <label for="password" class="form-label text-secondary">Password</label>
                    </div>

                    <div class="d-flex flex-column flex-lg-column justify-content-between align-items-center">
                        <div class="mb-3">
                            <button id="login-submit" type="submit" class="btn">Sign in</button>
                        </div>
                        <div class="">
                            <h6 class="text-secondary">
                                Don't have an account?
                                <a class="text-decoration-none" href="registration_form.php">Sign up</a>
                            </h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>