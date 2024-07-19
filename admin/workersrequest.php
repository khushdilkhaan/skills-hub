<?php
include "header.php";

// Fetch data from the "skilledworkers" table
$query = "SELECT * FROM skilledworkers";
$result = mysqli_query($link, $query);
?>

<div class="container-fluid" style="width: 60%;" >
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Skills</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['worker_id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['skills']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <form method='post' action=''>
                                        <input type='hidden' name='worker_id' value='<?php echo $row['worker_id']; ?>'>
                                        <button type='submit' name='approve' class='btn btn-success'>Approve</button>
                                        <button type='submit' name='reject' class='btn btn-danger'>Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript function to display Bootstrap alert and refresh the page
function showAlert(message, alertType) {
    // Create a new alert element
    var alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-' + alertType + ' alert-dismissible fade show d-flex justify-content-center align-items-center'; // Added classes for centering
    alertDiv.innerHTML = '<strong>' + message + '</strong>' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

    // Append the alert to the body
    document.body.appendChild(alertDiv);

    // Refresh the page after 2 seconds
    setTimeout(function() {
        location.reload();
    }, 2000);
}
</script>


<?php
// Process Approval/Rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workerId = $_POST['worker_id'];

    if (isset($_POST['approve'])) {
        // Handle approval logic (update status)
        $updateQuery = "UPDATE skilledworkers SET status = 'approved' WHERE worker_id = $workerId";
        if (mysqli_query($link, $updateQuery)) {
            echo '<script>showAlert("Worker with ID ' . $workerId . ' is approved!", "success");</script>';
        } else {
            echo '<script>showAlert("Error approving worker: ' . mysqli_error($link) . '", "warning");</script>';
        }
    } elseif (isset($_POST['reject'])) {
        // Handle rejection logic (update status and delete from table)
        $updateQuery = "UPDATE skilledworkers SET status = 'rejected' WHERE worker_id = $workerId";
        if (mysqli_query($link, $updateQuery)) {
            echo '<script>showAlert("Worker with ID ' . $workerId . ' is rejected!", "success");</script>';
        } else {
            echo '<script>showAlert("Error rejecting worker: ' . mysqli_error($link) . '", "warning");</script>';
        }

        // Delete from table
        $deleteQuery = "DELETE FROM skilledworkers WHERE worker_id = $workerId";
        if (!mysqli_query($link, $deleteQuery)) {
            echo '<script>showAlert("Error deleting worker: ' . mysqli_error($link) . '", "warning");</script>';
        }
    }
}
?>

<?php include "footer.php"; ?>
