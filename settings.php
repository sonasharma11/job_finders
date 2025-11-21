<?php
session_start();
include 'connection.php';

if ($_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - Job Portal</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #0d3f86;
      --primary-hover: #155fc0;
      --light-bg: #f8f9fa;
      --dark-bg: #1e1e1e;
      --text-light: #f8f9fa;
      --text-dark: #212529;
    }

    body {
      background-color: var(--light-bg);
      color: var(--text-dark);
      font-family: 'Segoe UI', sans-serif;
      transition: all 0.3s ease;
      overflow-x: hidden;
    }

    body.dark-mode {
      background-color: var(--dark-bg);
      color: var(--text-light);
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
      background-color: var(--primary-hover);
    }

    .card {
      border-radius: 15px;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      background-color: white;
      transition: all 0.3s ease;
    }

    body.dark-mode .card {
      background-color: #2c2c2c;
      color: white;
      box-shadow: 0 4px 15px rgba(255, 255, 255, 0.05);
    }

    .card:hover {
      transform: translateY(-3px);
    }

    .toggle-switch {
      position: relative;
      display: inline-block;
      width: 55px;
      height: 30px;
    }

    .toggle-switch input {
      display: none;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: 0.4s;
      border-radius: 30px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 22px;
      width: 22px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: 0.4s;
      border-radius: 50%;
    }

    input:checked+.slider {
      background-color: var(--primary-color);
    }

    input:checked+.slider:before {
      transform: translateX(25px);
    }

    @media (max-width: 991px) {
      .sidebar {
        min-height: auto;
      }
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
        <a href="profile.php"><i class="fa-solid fa-user me-2"></i>Profile</a>
        <a href="settings.php" class="active"><i class="fa-solid fa-gear me-2"></i>Settings</a>
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
      </nav>

      <main class="col-lg-10 col-md-9 ms-auto p-4">
        <div class="container">
          <h2 class="mb-4 fw-bold">⚙️ Settings</h2>
          <p class="text-secondary mb-4">Customize your preferences and account settings.</p>

          <div class="card p-4 mb-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-moon me-2"></i>Theme Preferences</h5>
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
              <span>Light Mode / Dark Mode</span>
              <label class="toggle-switch">
                <input type="checkbox" id="themeToggle">
                <span class="slider"></span>
              </label>
            </div>
            <p class="text-secondary mt-3 small mb-0">Switch between Light and Dark mode to match your preference.</p>
          </div>
          <?php

          if (isset($_POST['update_password'])) {
            $user_id = $_SESSION['user_id'];
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];

            $query = "SELECT password FROM tbl_users WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $hashed_password = $row['password'];

              if (password_verify($current_password, $hashed_password)) {
                $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);

                $update = "UPDATE tbl_users SET password = ? WHERE id = ?";
                $stmt = $con->prepare($update);
                $stmt->bind_param("si", $new_hashed, $user_id);

                if ($stmt->execute()) {
                  $success = "Password updated successfully!";
                } else {
                  $error = "Something went wrong. Please try again.";
                }
              } else {
                $error = "Current password is incorrect!";
              }
            } else {
              $error = "User not found.";
            }
          }
          ?>
          <?php if (isset($success)) { ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
          <?php } ?>
          <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php } ?>


          <form action="settings.php" method="POST" class="mt-4">
            <div class="card p-4 border-0 shadow-sm">
              <h5 class="fw-bold mb-3"><i class="fa-solid fa-lock me-2"></i>Change Password</h5>
              <p class="text-secondary small mb-4">Ensure your new password is strong and unique to keep your account secure.</p>

              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Current Password</label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fa-solid fa-key"></i></span>
                    <input type="password" class="form-control border-0 shadow-sm" name="current_password"
                      placeholder="Enter current password" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">New Password</label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control border-0 shadow-sm" name="new_password"
                      placeholder="Enter new password" required>
                  </div>
                </div>
              </div>

              <div class="text-center mt-4">
                <button type="submit" name="update_password" class="btn-edit fw-semibold px-4 py-2">
                  <i class="fa-solid fa-floppy-disk me-2"></i>Save Changes
                </button>
              </div>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const toggleSwitch = document.getElementById('themeToggle');
    const body = document.body;

    if (localStorage.getItem('theme') === 'dark') {
      body.classList.add('dark-mode');
      toggleSwitch.checked = true;
    }

    toggleSwitch.addEventListener('change', () => {
      if (toggleSwitch.checked) {
        body.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark');
      } else {
        body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
      }
    });
  </script>
</body>

</html>