<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT name, email FROM tbl_users WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
} else {
  header("Location:dashboard.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - Job Portal</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #0d3f86;
      --primary-hover: #155fc0;
      --light-bg: #f8f9fa;
    }

    body {
      background-color: var(--light-bg);
      font-family: 'Segoe UI', sans-serif;
      color: #333;
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
      transition: background 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: var(--primary-hover);
    }

    .profile-card {
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      padding: 30px;
      max-width: 850px;
      margin: 0 auto;
      transition: all 0.3s ease;
    }

    .profile-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .profile-image {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid var(--primary-color);
    }

    .btn-edit {
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      transition: background 0.3s;
    }

    .btn-edit:hover {
      background-color: var(--primary-hover);
    }

    label {
      font-weight: 600;
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
        <a href="postajob.php"><i class="fa-solid fa-plus me-2"></i>Post New Job</a>
        <a href="viewjob.php"><i class="fa-solid fa-list me-2"></i>View Jobs</a>
        <a href="applications.php"><i class="fa-solid fa-envelope-open-text me-2"></i>Applications</a>
        <a href="popular_categories.php"><i class="fa-solid fa-layer-group me-2"></i>Category</a>
        <a href="manage_company_logos.php"><i class="fa-solid fa-building me-2"></i>Company Logos</a>
        <a href="add_blogs.php"><i class="fa-solid fa-folder-open me-2"></i>Blogs</a>
        <a href="profile.php" class="active"><i class="fa-solid fa-user me-2"></i>Profile</a>
        <a href="settings.php"><i class="fa-solid fa-gear me-2"></i>Settings</a>
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
      </nav>

      <main class="col-lg-10 col-md-9 ms-auto p-4">
        <div class="text-center mb-4">
          <img src="https://thumbs.dreamstime.com/b/cute-curly-girl-face-icon-over-chat-bubble-background-woman-profile-avatar-isolated-cute-curly-girl-face-icon-over-chat-bubble-113072419.jpg" alt="Profile" class="profile-image mb-3">
          <h4 class="fw-semibold mb-0"><?php echo htmlspecialchars($user['name']); ?></h4>
          <p class="text-muted">Admin</p>
        </div>

        <form>
          <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
              <label for="fullname" class="form-label">Full Name</label>
              <input type="text" id="fullname" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>">
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="bio" class="form-label">Bio / Description</label>
            <textarea id="bio" class="form-control" rows="3">Passionate recruiter helping companies find the best talent!</textarea>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>