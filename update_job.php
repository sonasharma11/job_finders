<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $job_title = $_POST['job_title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $job_description = $_POST['job_description'];

    $query = "UPDATE job SET job_title='$job_title', company='$company', location='$location', job_description='$job_description' WHERE id='$id'";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Job updated successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error updating job!'); window.location.href='index.php';</script>";
    }
}
