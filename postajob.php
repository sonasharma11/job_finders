<?php
session_start();
include 'connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

if (isset($_POST['save'])) {
  $job_title = mysqli_real_escape_string($con, $_POST['job_title']);
  $company = mysqli_real_escape_string($con, $_POST['company']);
  $location = mysqli_real_escape_string($con, $_POST['location']);
  $job_description = mysqli_real_escape_string($con, $_POST['job_description']);

  $query = "INSERT INTO job (job_title, company, location, job_description, status)
            VALUES ('$job_title', '$company', '$location', '$job_description', 'active')";

  $data = mysqli_query($con, $query);

  if ($data) {
    echo "<script>alert('✅ Job details saved successfully!');</script>";
  } else {
    echo "<script>alert('❌ Error: " . mysqli_error($con) . "');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post New Job - Job Portal</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #0d3f86;
      --bg-light: #f8f9fa;
      --text-dark: #212529;
    }

    body {
      background-color: var(--bg-light);
      color: var(--text-dark);
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
    }

    .sidebar {
      background-color: var(--primary-color);
      color: white;
      min-height: 100vh;
      padding-top: 20px;
      transition: all 0.3s ease;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
      margin: 5px 10px;
      border-radius: 8px;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #155fc0;
    }

    .card {
      border-radius: 15px;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .btn-submit {
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 10px 25px;
      transition: background 0.3s;
    }

    .btn-submit:hover {
      background-color: #155fc0;
    }

    @media (max-width: 991px) {
      .sidebar {
        min-height: auto;
      }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-lg-none">
    <div class="container-fluid">
      <a class="navbar-brand fw-semibold" href="#">Job Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row flex-nowrap">
      <nav id="sidebarMenu" class="col-lg-2 col-md-3 collapse d-lg-block sidebar">
        <h4 class="text-center mb-4 d-none d-lg-block">Job Portal</h4>
        <a href="dashboard.php"><i class="fa-solid fa-house me-2"></i>Dashboard</a>
        <a href="postajob.php" class="active"><i class="fa-solid fa-plus me-2"></i>Post New Job</a>
        <a href="viewjob.php"><i class="fa-solid fa-list me-2"></i>View Jobs</a>
        <a href="applications.php"><i class="fa-solid fa-envelope-open-text me-2"></i>Applications</a>
        <a href="popular_categories.php"><i class="fa-solid fa-layer-group me-2"></i>Category</a>
        <a href="manage_company_logos.php"><i class="fa-solid fa-building me-2"></i>Company Logos</a>
        <a href="add_blogs.php"><i class="fa-solid fa-folder-open me-2"></i>Blogs</a>
        <a href="profile.php"><i class="fa-solid fa-user me-2"></i>Profile</a>
        <a href="settings.php"><i class="fa-solid fa-gear me-2"></i>Settings</a>
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
      </nav>

      <main class="col-lg-10 col-md-9 ms-auto p-4">
        <div class="container">
          <h2 class="fw-bold mb-3">➕ Post a New Job</h2>
          <p class="text-muted mb-4">Please fill out the job details carefully before submitting.</p>

          <div class="card p-4">
            <form method="POST" action="">
              <div class="row g-4">
                <div class="col-12">
                  <label class="form-label fw-semibold"><i class="fa-solid fa-briefcase me-2"></i>Job Title</label>
                  <input type="text" class="form-control form-control-lg rounded-3" name="job_title"
                    placeholder="e.g. Full Stack Developer" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold"><i class="fa-solid fa-building me-2"></i>Company</label>
                  <input type="text" class="form-control form-control-lg rounded-3" name="company"
                    placeholder="e.g. Google LLC" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold"><i class="fa-solid fa-location-dot me-2"></i>Location</label>
                  <input type="text" class="form-control form-control-lg rounded-3" name="location"
                    placeholder="e.g. New York City" required>
                </div>

                <div class="col-12">
                  <label class="form-label fw-semibold"><i class="fa-solid fa-file-lines me-2"></i>Job Description</label>
                  <textarea class="form-control form-control-lg rounded-3" rows="5" name="job_description"
                    placeholder="Enter job details..." required></textarea>
                </div>

                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-submit fw-semibold px-4" name="save">
                    <i class="fa-solid fa-paper-plane me-2"></i>Submit Job
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>