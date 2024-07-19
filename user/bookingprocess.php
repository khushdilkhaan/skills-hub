<?php
include "header.php";

// Check if the user is logged in
if (isset($_SESSION["user_email_session"])) {
    // Fetch user ID based on email from the users table
    $userEmail = $_SESSION["user_email_session"];
    $getUserIDQuery = "SELECT user_id FROM users WHERE email = '$userEmail'";
    $userIDResult = mysqli_query($link, $getUserIDQuery);

    if ($userIDResult && $userIDRow = mysqli_fetch_assoc($userIDResult)) {
        $userID = $userIDRow['user_id'];

        // Fetch booking requests for the specific user from the booking_request table
        $getRequestQuery = "SELECT * FROM booking_request WHERE user_id = '$userID'";
        $result = mysqli_query($link, $getRequestQuery);

        if ($result) {
?>
            <div class="container mt-4">
                <h2>Your Booking Requests</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Worker ID</th>
                            <th>Worker Name</th>
                            <th>Worker Number</th>
                            <th>Worker Address</th>
                            <th>Skills</th>
                            <th>Need For</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['request_id']; ?></td>
                                <td><?php echo $row['worker_id']; ?></td>
                                <td><?php echo $row['worker_name']; ?></td>
                                <td><?php echo $row['worker_contact']; ?></td>
                                <td><?php echo $row['worker_address']; ?></td>
                                <td><?php echo $row['skills']; ?></td>
                                <td><?php echo $row['need_for']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<?php
        } else {
            echo "Error fetching your booking requests: " . mysqli_error($link);
        }
    } else {
        echo "Error fetching user ID.";
    }
} else {
    // Redirect to login page if the user is not logged in
    
    echo "User Not Logged In";
    exit();
}

include "footer.php";
?>
