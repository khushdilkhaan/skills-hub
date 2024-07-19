<?php include "header.php"; ?>

<div class="container mt-4 col-lg-7">
    <h2>Manage Service Requests</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Worker ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Need For</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch requests from the database
                $query = "SELECT * FROM booking_request";
                $result = mysqli_query($link, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['request_id']; ?></td>
                            <td><?php echo $row['worker_id']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['contact_number']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['need_for']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <!-- <td> -->
                                <!-- Add buttons or links for admin actions (e.g., approve, reject) -->
                                <!-- <button type="button" class="btn btn-primary">Approve</button>
                                <button type="button" class="btn btn-danger">Reject</button> -->
                            <!-- </td> -->
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='9'>No requests found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "footer.php"; ?>
