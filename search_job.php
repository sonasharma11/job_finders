<?php
$connection = mysqli_connect("localhost", "root", "", "job_portal");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$job_title = mysqli_real_escape_string($connection, $_POST['job_title']);
$location = mysqli_real_escape_string($connection, $_POST['location']);

$query = "SELECT * FROM job 
          WHERE job_title LIKE '%$job_title%' 
          AND location LIKE '%$location%'";

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-success">' . htmlspecialchars($row['job_title']) . '</h5>
                    <p class="card-text mb-1"><strong>Company:</strong> ' . htmlspecialchars($row['company']) . '</p>
                    <p class="card-text mb-1"><strong>Location:</strong> ' . htmlspecialchars($row['location']) . '</p>
                    <p class="card-text"><strong>Description:</strong> ' . htmlspecialchars($row['job_description']) . '</p>
                </div>
            </div>
        </div>';
    }
    echo '</div>';
} else {
    echo '<p class="text-center text-danger">No jobs found for your search.</p>';
}

mysqli_close($connection);
