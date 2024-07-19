<?php
include "header.php";

// Assuming you have a connection to the database named $link

// Process search query
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['s'])) {
    $search = mysqli_real_escape_string($link, $_GET['s']);
    $query = "SELECT skilledworkers.*, AVG(review.rating) AS avg_rating FROM skilledworkers LEFT JOIN review ON skilledworkers.worker_id = review.worker_id WHERE skilledworkers.skills LIKE '%$search%' GROUP BY skilledworkers.worker_id";
    $result = mysqli_query($link, $query);
} else {
    // Fetch all data if no search query
    $query = "SELECT skilledworkers.*, AVG(review.rating) AS avg_rating FROM skilledworkers LEFT JOIN review ON skilledworkers.worker_id = review.worker_id GROUP BY skilledworkers.worker_id";
    $result = mysqli_query($link, $query);
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <!-- Search Area -->
            <form action="workers.php" method="get"  >
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by skills..." name="s">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Skills</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['worker_id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['skills']; ?></td>
                                <td><?php echo round($row['avg_rating'], 1); ?></td>
                                <td>
                                    <a href="confirmation.php?worker_id=<?php echo $row['worker_id']; ?>" class="btn btn-primary">Book</a>
                                    <!-- Add a link/button to rate the worker -->
                                    <a href="rate_worker.php?worker_id=<?php echo $row['worker_id']; ?>" class="btn btn-info">Rate</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
