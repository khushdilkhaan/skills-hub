<?php
include "header.php";

// Check if the user is logged in
if (!isset($_SESSION["user_email_session"]) || !isset($_SESSION["user_password_session"])) {
    // Redirect to the login page if the user is not logged in
    header("location: login.php");
    exit();
}


// Fetch user data from the database based on the logged-in user's email
$userEmail = $_SESSION["user_email_session"];
$query = "SELECT * FROM users WHERE email = '$userEmail'";
$result = mysqli_query($link, $query);

// Check if the query was successful
if ($result) {
    // Fetch the user data as an associative array
    $userData = mysqli_fetch_assoc($result);
} else {
    // Handle the error if the query fails
    echo "Error: " . mysqli_error($link);
    exit();
}

// Handle form submission for updating profile
if (isset($_POST["updateProfile"])) {
    // Extract data from the form
    $userName = mysqli_real_escape_string($link, $_POST["userName"]);
    $address = mysqli_real_escape_string($link, $_POST["address"]);
    $contact = mysqli_real_escape_string($link, $_POST["contact"]);

    // Handle profile image upload
    if ($_FILES["profileImage"]["name"]) {
        $targetDir = "../users_profile/";
        $profileImage = basename($_FILES["profileImage"]["name"]);
        $targetPath = $targetDir . $profileImage;

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetPath)) {
            // Update the user data including the profile image
            $updateQuery = "UPDATE users SET username = '$userName', address = '$address', contact = '$contact', profile_image = '$profileImage' WHERE email = '$userEmail'";
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
        // Update the user data excluding the profile image
        $updateQuery = "UPDATE users SET username = '$userName', address = '$address', contact = '$contact' WHERE email = '$userEmail'";
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

<!-- The rest of your HTML remains unchanged -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content remains unchanged -->
</head>

<body>

    <div class="container">
        <div class="profile-form">
            <h2 class="text-center mb-4">Edit Profile</h2>

            <form method="post" enctype="multipart/form-data" action="myprofile.php">

                <!-- Profile Image -->
                <div class="text-center">
                    <img src="../users_profile/<?php echo $userData['profile_image']; ?>" alt="Profile Image" width="25%" height="25%" class="profile-image img-fluid rounded-circle">
                </div>

                <!-- File input for updating profile image -->
                <div class="form-group mt-3">
                    <label for="profileImage">Update Profile Image</label>
                    <input type="file" id="profileImage" class="form-control-file" name="profileImage" accept="image/*">
                </div>

                <!-- User Name -->
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $userData['username']; ?>" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $userData['email']; ?>" required readonly>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $userData['address']; ?>" required>
                </div>

                <!-- Contact -->
                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="tel" class="form-control" id="contact" name="contact" value="<?php echo $userData['contact']; ?>" required>
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
