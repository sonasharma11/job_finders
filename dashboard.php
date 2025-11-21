<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connection.php';

if ($_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

// TOTAL JOBS
$query_jobs = mysqli_query($con, "SELECT COUNT(*) AS total_jobs FROM job");
$result_jobs = mysqli_fetch_assoc($query_jobs);
$total_jobs = $result_jobs['total_jobs'];

// TOTAL APPLICATIONS
$query_app = mysqli_query($con, "SELECT COUNT(*) AS total_app FROM job_applications");
$result_app = mysqli_fetch_assoc($query_app);
$total_app = $result_app['total_app'];

// TEMP Interview count (safe)
$total_interview = 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Job Portal</title>
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

    .card i {
      font-size: 2.2rem;
      margin-bottom: 10px;
    }
  </style>
  
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-lg-none">
    <div class="container-fluid">
      <a class="navbar-brand fw-semibold" href="#">Job Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row flex-nowrap">
      <nav id="sidebarMenu" class="col-lg-2 col-md-3 collapse d-lg-block sidebar">
        <h4 class="text-center mb-4 d-none d-lg-block">Job Portal</h4>
        <a href="dashboard.php" class="active"><i class="fa-solid fa-house me-2"></i>Dashboard</a>
        <a href="postajob.php"><i class="fa-solid fa-plus me-2"></i>Post New Job</a>
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
          <h2 class="mb-4 fw-bold">Welcome to Your Dashboard 👋</h2>
          <p class="text-muted mb-4">Here's an overview of your job postings and applications.</p>

          <hr class="my-5">

          <div class="row g-4">

            <!-- TOTAL JOBS -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card p-4 text-center">
                <i class="fa-solid fa-briefcase text-info"></i>
                <h5 class="fw-bold mt-2">Total Jobs</h5>
                <p class="display-6 fw-bold text-info mb-0">
                  <?php echo $total_jobs; ?>
                </p>
              </div>
            </div>

            <!-- APPLICATIONS -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card p-4 text-center">
                <i class="fa-solid fa-envelope-open-text text-success"></i>
                <h5 class="fw-bold mt-2">Applications</h5>
                <p class="display-6 fw-bold text-success mb-0">
                  <?php echo $total_app; ?>
                </p>
              </div>
            </div>

            <!-- INTERVIEWS -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card p-4 text-center">
                <i class="fa-solid fa-calendar-check text-warning"></i>
                <h5 class="fw-bold mt-2">Interviews Scheduled</h5>
                <p class="display-6 fw-bold text-warning mb-0">
                  <?php echo $total_interview; ?>
                </p>
              </div>
            </div>

          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>