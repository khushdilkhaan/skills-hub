<?php

include "header.php";

$workerDetails = []; // Initialize an empty array

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['worker_id'])) {
    // Display worker details
    $workerId = $_GET['worker_id'];
    $query = "SELECT * FROM skilledworkers WHERE worker_id = $workerId";
    $result = mysqli_query($link, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $workerDetails = $row;
    } else {
        echo "Error fetching worker details.";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['worker_id'])) {
    // Process booking confirmation
    $workerId = mysqli_real_escape_string($link, $_POST['worker_id']);
    $userName = mysqli_real_escape_string($link, $_POST['user_name']);
    $contactNumber = mysqli_real_escape_string($link, $_POST['contact_number']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $needFor = mysqli_real_escape_string($link, $_POST['need_for']);
    $worker_name = mysqli_real_escape_string($link, $_POST['worker_name']);
    $worker_contact = mysqli_real_escape_string($link, $_POST['worker_contact']);
    $worker_address = mysqli_real_escape_string($link, $_POST['worker_address']);
    $skills = mysqli_real_escape_string($link, $_POST['skills']);
    $status = 'pending';

    // Check if user_email_session is set before accessing it
    if (isset($_SESSION["user_email_session"])) {
        $loginUserEmail = $_SESSION["user_email_session"];

        // select user id
        $queryS = "SELECT * FROM users WHERE email = '$loginUserEmail'";
        $runOK = mysqli_query($link, $queryS);

        if ($runOK && $fDaata = mysqli_fetch_array($runOK)) {
            $user_id = $fDaata["user_id"];

            $insertQuery = "INSERT INTO booking_request (worker_id, user_id, username, contact_number, address, need_for, worker_name, worker_contact, worker_address, skills, status) 
                            VALUES ('$workerId', '$user_id', '$userName', '$contactNumber', '$address', '$needFor', '$worker_name', '$worker_contact', '$worker_address', '$skills', '$status')";

            if (mysqli_query($link, $insertQuery)) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>CONGRATS!</strong> Booking Successfully done.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR!</strong> Booking Failed! .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>' . mysqli_error($link);
            }
        } else {
            echo "Error fetching user details.";
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR!</strong> Booking Failed! .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
} else {
    // Redirect to the main page if worker_id is not provided or accessed without a POST request
    header("Location: index.php");
    exit();
}
?>


<div class="container mt-4">
    <h2>Booking Confirmation</h2>
    <div>
       
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><?php echo $workerDetails['worker_id'] ?? ''; ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo $workerDetails['username'] ?? ''; ?></td>
                </tr>
                <tr>
                    <th>Skills</th>
                    <td><?php echo $workerDetails['skills'] ?? ''; ?></td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td><?php echo $workerDetails['contact'] ?? ''; ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $workerDetails['address'] ?? ''; ?></td>
                </tr>
                <tr>
                    <th>Certification</th>
                    <td><?php echo $workerDetails['certification'] ?? ''; ?></td>
                </tr>
                <tr>
                    <th>Work History</th>
                    <td><?php echo $workerDetails['work_history'] ?? ''; ?></td>
                </tr>
            </tbody>
        </table>
        

        <h3>User Information</h3>
        <!-- Add a form for user information -->
        <form action="confirmation.php" method="post">
            <input type="hidden" name="worker_id" value="<?php echo $workerDetails['worker_id'] ?? ''; ?>">

            <div class="mb-3">
                <label for="user_name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>

            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="number" class="form-control" id="contact_number" name="contact_number" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="mb-3">
                <label for="need_for" class="form-label">Need For</label>
                <input type="text" class="form-control" id="need_for" name="need_for" required>
            </div>

            <div class="mb-3">
                <label for="skills" class="form-label">Username</label>
                <input type="text" class="form-control" id="skills" name="worker_name" value="<?php echo $workerDetails['username'] ?? ''; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="skills" class="form-label">Contact</label>
                <input type="text" class="form-control" id="skills" name="worker_contact" value="<?php echo $workerDetails['contact'] ?? ''; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="skills" class="form-label">Address</label>
                <input type="text" class="form-control" id="skills" name="worker_address" value="<?php echo $workerDetails['address'] ?? ''; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="skills" class="form-label">Skills</label>
                <input type="text" class="form-control" id="skills" name="skills" value="<?php echo $workerDetails['skills'] ?? ''; ?>" readonly>
            </div>

            <!-- Add more fields as needed -->

            <button type="submit" class="btn btn-primary">Confirm Booking</button>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
