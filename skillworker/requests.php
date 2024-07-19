<?php
include "header.php";

// Check if the skilled worker is logged in
if (isset($_SESSION["worker_email_session"])) {
    // Fetch booking requests for the specific skilled worker from the database
    $workerEmail = $_SESSION["worker_email_session"];
    
    // Assuming the column in skilledworkers table that contains email is 'email'
    $query = "SELECT booking_request.* 
              FROM booking_request 
              JOIN skilledworkers ON booking_request.worker_id = skilledworkers.worker_id 
              WHERE skilledworkers.email = '$workerEmail'";
    
    $result = mysqli_query($link, $query);

    if ($result) {
?>
        <div class="container mt-4">
            <h2>Your Booking Requests</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Need For</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['request_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['contact_number']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['need_for']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <!-- Approve and Reject buttons with form submission -->
                               <!-- ... Your existing code ... -->


                               <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted
    $requestId = mysqli_real_escape_string($link, $_POST['request_id']);
    $action = mysqli_real_escape_string($link, $_POST['action']);

    // Update the status based on the action (approve or reject)
    $newStatus = ($action === 'approved') ? 'approved' : 'rejected';

    // Update the status in the database
    $updateQuery = "UPDATE booking_request SET status = '$newStatus' WHERE request_id = '$requestId'";
    $updateResult = mysqli_query($link, $updateQuery);

    if ($updateResult) {
        Header ("Location: requests.php");
    } else {
        echo "Error updating status: " . mysqli_error($link);
    }
}
?>


                            <form action="requests.php" method="post">
                                <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                <button type="submit" name="action" value="approved" class="btn btn-success">Approve</button>
                                <button type="submit" name="action" value="rejected" class="btn btn-danger">Reject</button>
                            </form>

<!-- ... Your existing code ... -->

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    } else {
        echo "Error fetching your booking requests.";
    }
} else {
    // Redirect to login page if the skilled worker is not logged in
    header("Location: login.php");
    exit();
}

include "footer.php";
?>
