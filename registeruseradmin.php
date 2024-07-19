<?php include_once "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Optional: Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4>Sign Up</h4>
            </div>
            <div class="card-body">

                <!-- Signup Form -->
                <form method="post" enctype="multipart/form-data">

                    <?php
                    if (isset($_POST["signup"])) {
                        $name = $_POST["username"];
                        $contact = $_POST["contact"];
                        $address = $_POST["address"];
                        $email = $_POST["email"];
                        $pass = $_POST["password"];
                        $role = $_POST["role"];
                        $image = $_FILES["img"]["name"];
                        $prof_image = "users_profile/";

                        $insertion = "INSERT INTO users (username, email, address, contact, profile_image, role, password) VALUES ('$name', '$email', '$address', '$contact', '$image', '$role', '$pass')";

                        if (mysqli_query($link, $insertion) && move_uploaded_file($_FILES["img"]["tmp_name"], $prof_image . $image)) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>CONGRATULATION!</strong> ACCOUNT REGISTERED SUCCESSFULLY.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>ERROR!</strong> ' . mysqli_error($link) . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                    }
                    ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact">Contact</label>
                            <input type="tel" class="form-control" id="contact" name="contact" placeholder="Enter your contact number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img">Profile Image</label>
                        <input type="file" class="form-control-file" id="img" name="img" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <!-- Role selection -->
                    <div class="form-group">
                        <label for="role">Select Role:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="user">User</option>
                            <option value="admin" disabled>Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="signup">Sign Up</button>
                    </div>

                    <div class="form-group text-center">
                        <p>Already have an account? <a id="login-btn" href="#">Sign In</a></p>
                    </div>
                </form>
                <!-- End Signup Form -->

            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
