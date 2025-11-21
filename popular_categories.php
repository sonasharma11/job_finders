<?php
include 'connection.php';
session_start();

if ($_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

if (isset($_POST['add_category'])) {
  $icon = $_POST['icon'];
  $category_name = $_POST['category_name'];
  $job_count = $_POST['job_count'];

  mysqli_query($con, "INSERT INTO popular_categories (icon, category_name, job_count) VALUES ('$icon', '$category_name', '$job_count')");
  header("Location: popular_categories.php");
  exit;
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($con, "DELETE FROM popular_categories WHERE id=$id");
  header("Location: popular_categories.php");
  exit;
}

$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $editQuery = mysqli_query($con, "SELECT * FROM popular_categories WHERE id=$id");
  $editData = mysqli_fetch_assoc($editQuery);
}

if (isset($_POST['update_category'])) {
  $id = $_POST['id'];
  $icon = $_POST['icon'];
  $category_name = $_POST['category_name'];
  $job_count = $_POST['job_count'];

  mysqli_query($con, "UPDATE popular_categories SET icon='$icon', category_name='$category_name', job_count='$job_count' WHERE id=$id");
  header("Location: popular_categories.php");
  exit;
}

$result = mysqli_query($con, "SELECT * FROM popular_categories ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Popular Categories - Job Portal</title>
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

    @media (max-width: 991px) {
      .sidebar {
        min-height: auto;
      }
      .sidebar a {
        padding: 8px 16px;
        margin: 3px 6px;
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
        <a href="popular_categories.php" class="active"><i class="fa-solid fa-layer-group me-2"></i>Category</a>
        <a href="manage_company_logos.php"><i class="fa-solid fa-building me-2"></i>Company Logos</a>
        <a href="add_blogs.php"><i class="fa-solid fa-folder-open me-2"></i>Blogs</a>
        <a href="profile.php"><i class="fa-solid fa-user me-2"></i>Profile</a>
        <a href="settings.php"><i class="fa-solid fa-gear me-2"></i>Settings</a>
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
      </nav>

      <main class="col-lg-10 col-md-9 ms-auto p-4">
        <div class="container">
          <h2 class="mb-4 fw-bold">Manage Popular Categories</h2>

          <form method="POST" class="mb-4">
            <div class="row g-2">
              <?php if ($editData) { ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
              <?php } ?>

              <div class="col-md-4 col-12">
                <input type="text" name="icon" class="form-control" placeholder="fa-solid fa-desktop"
                  value="<?= $editData['icon'] ?? '' ?>" required>
              </div>

              <div class="col-md-4 col-12">
                <input type="text" name="category_name" class="form-control" placeholder="Category Name"
                  value="<?= $editData['category_name'] ?? '' ?>" required>
              </div>

              <div class="col-md-3 col-12">
                <input type="text" name="job_count" class="form-control" placeholder="44,000+"
                  value="<?= $editData['job_count'] ?? '' ?>" required>
              </div>

              <div class="col-md-1 col-12">
                <?php if ($editData) { ?>
                  <button type="submit" name="update_category" class="btn btn-primary w-100 mb-2">Save</button>
                  <a href="popular_categories.php" class="btn btn-secondary w-100">Cancel</a>
                <?php } else { ?>
                  <button type="submit" name="add_category" class="btn btn-outline-primary w-100">Add</button>
                <?php } ?>
              </div>
            </div>
          </form>

          <div class="table-responsive">
            <table class="table table-bordered table-striped bg-white text-center align-middle shadow-sm">
              <thead class="table-success">
                <tr>
                  <th>ID</th>
                  <th>Icon</th>
                  <th>Category</th>
                  <th>Job Count</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <td><?= $row['id'] ?></td>
                    <td><i class="<?= $row['icon'] ?> fs-5 text-success"></i></td>
                    <td><?= $row['category_name'] ?></td>
                    <td><?= $row['job_count'] ?></td>
                    <td>
                      <a href="?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this category?')">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
