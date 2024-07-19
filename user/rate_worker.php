<?php
include "header.php";

// Assuming you have a connection to the database named $link

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['worker_id']) && isset($_POST['rating'])) {
    $worker_id = mysqli_real_escape_string($link, $_POST['worker_id']);
    $rating = mysqli_real_escape_string($link, $_POST['rating']);
    
    // Insert the rating into the review table
    $query = "INSERT INTO review (worker_id, rating) VALUES ('$worker_id', '$rating')";
    mysqli_query($link, $query);

    // Redirect back to the page where user rated the worker
    header("Location: workers.php");
    exit();
}

// If worker_id is not provided, redirect back
if (!isset($_GET['worker_id'])) {
    header("Location: workers.php");
    exit();
}

$worker_id = mysqli_real_escape_string($link, $_GET['worker_id']);
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h2>Rate Skilled Worker</h2>
            <form action="rate_worker.php" method="post">
                <input type="hidden" name="worker_id" value="<?php echo $worker_id; ?>">
                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <select class="form-control" id="rating" name="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit Rating</button>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
