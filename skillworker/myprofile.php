<?php
include "header.php";

// Check if the skilled worker is logged in
if (!isset($_SESSION["worker_email_session"]) || !isset($_SESSION["worker_password_session"])) {
    // Redirect to the login page if the skilled worker is not logged in
    header("location: login.php");
    exit();
}

// Fetch skilled worker data from the database based on the logged-in skilled worker's email
$skilledWorkerEmail = $_SESSION["worker_email_session"];
$query = "SELECT * FROM skilledworkers WHERE email = '$skilledWorkerEmail'";
$result = mysqli_query($link, $query);

// Check if the query was successful
if ($result) {
    // Fetch the skilled worker data as an associative array
    $skilledWorkerData = mysqli_fetch_assoc($result);
} else {
    // Handle the error if the query fails
    echo "Error: " . mysqli_error($link);
    exit();
}

// Handle form submission for updating profile
if (isset($_POST["updateProfile"])) {
    // Extract data from the form
    $workerName = mysqli_real_escape_string($link, $_POST["workerName"]);
    $address = mysqli_real_escape_string($link, $_POST["address"]);
    $contact = mysqli_real_escape_string($link, $_POST["contact"]);
    $certification = mysqli_real_escape_string($link, $_POST["certification"]);
    $skills = mysqli_real_escape_string($link, $_POST["skills"]);
    $workHistory = mysqli_real_escape_string($link, $_POST["work_history"]);

    // Handle profile image upload
    if ($_FILES["profileImage"]["name"]) {
        $targetDir = "../workers_profile/";
        $profileImage = basename($_FILES["profileImage"]["name"]);
        $targetPath = $targetDir . $profileImage;

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetPath)) {
            // Update the skilled worker data including the profile image
            $updateQuery = "UPDATE skilledworkers SET username = '$workerName', address = '$address', contact = '$contact', certification = '$certification', skills = '$skills', work_history = '$workHistory', pro_image = '$profileImage' WHERE email = '$skilledWorkerEmail'";
            $updateResult = mysqli_query($link, $updateQuery);

            if ($updateResult) {
                // Redirect to the profile page after successful update
                header("location: myprofile.php");
                exit();
            } else {
                // Handle the error if the update query fails
                echo "Error updating profile: " . mysqli_error($link);
                exit();
            }
        } else {
            // Handle the error if the file move operation fails
            echo "Error uploading profile image.";
            exit();
        }
    } else {
        // Update the skilled worker data excluding the profile image
        $updateQuery = "UPDATE skilledworkers SET username = '$workerName', address = '$address', contact = '$contact', certification = '$certification', skills = '$skills', work_history = '$workHistory' WHERE email = '$skilledWorkerEmail'";
        $updateResult = mysqli_query($link, $updateQuery);

        if ($updateResult) {
            // Redirect to the profile page after successful update
            header("location: myprofile.php");
            exit();
        } else {
            // Handle the error if the update query fails
            echo "Error updating profile: " . mysqli_error($link);
            exit();
        }
    }
}

// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content remains unchanged -->
</head>

<body>

    <div class="container">
        <div class="profile-form">
            <h2 class="text-center mb-4">Edit Profile</h2>

            <form method="post" action="myprofile.php" enctype="multipart/form-data">

                <!-- Profile Image -->
                <div class="form-group">
                    <label for="profileImage">Profile Image</label><br>
                    <img src="../workers_profile/<?php echo $skilledWorkerData['pro_image']; ?>" alt="Profile Image" class="profile-image img-fluid rounded-circle" width="150">
                    <input type="file" id="profileImage" class="form-control-file" name="profileImage" accept="image/*">
                </div>

                <!-- Worker Name -->
                <div class="form-group">
                    <label for="workerName">Worker Name</label>
                    <input type="text" class="form-control" id="workerName" name="workerName" value="<?php echo $skilledWorkerData['username']; ?>" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $skilledWorkerData['email']; ?>" required readonly>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $skilledWorkerData['address']; ?>" required>
                </div>

                <!-- Contact -->
                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="tel" class="form-control" id="contact" name="contact" value="<?php echo $skilledWorkerData['contact']; ?>" required>
                </div>

                <!-- Certification -->
                <div class="form-group">
                    <label for="certification">Certification</label>
                    <input type="text" class="form-control" id="certification" name="certification" value="<?php echo $skilledWorkerData['certification']; ?>" required>
                </div>

                <!-- Skills -->
                <div class="form-group">
                    <label for="skills">Skills</label>
                    <input type="text" class="form-control" id="skills" name="skills" value="<?php echo $skilledWorkerData['skills']; ?>" required>
                </div>

                <!-- Work History -->
                <div class="form-group">
                    <label for="work_history">Work History</label>
                    <textarea class="form-control" id="work_history" name="work_history" rows="4" required><?php echo $skilledWorkerData['work_history']; ?></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block" name="updateProfile">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<?php include "footer.php"; ?>
