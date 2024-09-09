<?php
include ("head.php");
include ("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css\registration1.css" />
</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center p-3 p-md-5">
        <div class="wrapper bg-light">
            <h2 class="mb-4 mt-2 ms-1">Add admin account</h2>
            <form action="add_admin.php" method="POST">
                <input type="number" value="1" id="is_admin" name="is_admin" hidden>
                <div class="d-flex gap-1">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-floating mb-3 w-50 ">
                        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="John"
                            required />
                        <label for="firstName" class="form-label text-secondary">First name</label>
                    </div>
                    <div class="form-floating mb-3 w-50">
                        <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Doe"
                            required />
                        <label for="lastname" class="form-label text-secondary">Last name</label>
                    </div>
                </div>
                <div class="form-floating mb-3 w-100">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        required />
                    <label for="email" class="form-label text-secondary">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="63+" required />
                    <label for="phone" class="form-label text-secondary">Phone</label>
                </div>
                <div class="d-flex flex-wrap flex-md-nowrap gap-1">
                    <div class="form-floating mb-md-3 mb-1 w-50">
                        <input type="text" class="form-control" id="username" placeholder="password" name="username"
                            required />
                        <label for="username" class="form-label text-secondary">Username</label>
                    </div>

                    <div class="form-floating mb-md-3 mb-2 w-50">
                        <input type="password" class="form-control" id="password" placeholder="password" name="password"
                            required />
                        <label for="password" class="form-label text-secondary">Password</label>
                    </div>
                </div>

                <div
                    class="d-flex flex-row flex-wrap justify-content-center justify-content-md-between align-items-center">
                    <div class="w-100">
                        <input type="hidden" name="chat_name" id="chat_name">
                        <button type="submit" class="w-100 btn btn-primary px-3 py-2">Sign up</button>
                    </div>

                </div>
        </div>
        </form>
    </div>
    </div>
</body>

</html>