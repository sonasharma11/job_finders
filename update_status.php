<?php
include 'connection.php';

if (isset($_POST['job_id']) && isset($_POST['status'])) {
    $job_id = (int)$_POST['job_id'];
    $status = $_POST['status'] === 'active' ? 'active' : 'inactive';

    $query = "UPDATE job SET status = '$status' WHERE id = $job_id";
    if (mysqli_query($con, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
