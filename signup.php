<?php include_once "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
    $prof_image = "workers_profile/";
    $skills = $_POST["skills"];
    $certification = $_POST["certification"];
    $workHistory = $_POST["workHistory"];

    $insertion = "INSERT INTO skilledworkers (username, email, address, contact, pro_image, skills, certification, work_history, role, password) VALUES ('$name', '$email', '$address', '$contact', '$image', '$skills', '$certification', '$workHistory', '$role', '$pass')";

    if (mysqli_query($link, $insertion) && move_uploaded_file($_FILES["img"]["tmp_name"], $prof_image . $image)) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>CONGRATULATION!</strong> ACCOUNT REGISTERED SUCCESSFULLY.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR!</strong> ' . mysqli_error($link) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                </div>';
    }
}
?>


                            <div class="form-group">
                                <label for="userName">User Name</label>
                                <input type="text" class="form-control" name="username" id="userName" placeholder="User Name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="contact">Contact</label>
                                    <input type="tel" class="form-control" name="contact" id="contact" placeholder="Contact" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="skills">Skills</label>
                                <input type="text" class="form-control" name="skills" id="skills" placeholder="Skills" required>
                            </div>

                            <div class="form-group">
                                <label for="certification">Certification</label>
                                <input type="text" class="form-control" name="certification" id="certification" placeholder="Certification" required>
                            </div>

                            <div class="form-group">
                                <label for="workHistory">Work History</label>
                                <textarea class="form-control" name="workHistory" id="workHistory" rows="3" placeholder="Work History" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="role">Select Role:</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="worker">Skill Worker</option>
                                    
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <label for="img">Profile Image</label>
                                <input type="file" class="form-control-file" name="img" id="img" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block" name="signup">Sign Up</button>
                        </form>
                        <!-- End Signup Form -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
