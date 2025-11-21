<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include 'connection.php';

if ($_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

if (isset($_POST['save'])) {
  $title = $_POST['title'];
  $author = $_POST['author'];
  $date = $_POST['date'];
  $description = $_POST['description'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];

  $uploadDir = "uploads/blogs/";
  if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

  $path = $uploadDir . $image;
  move_uploaded_file($tmp, $path);

  mysqli_query($con, "INSERT INTO blogs (title, author, date, image, description)
                      VALUES ('$title', '$author', '$date', '$path', '$description')");
  echo "<script>alert('Blog added successfully!'); window.location='add_blogs.php';</script>";
  exit;
}

if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  mysqli_query($con, "DELETE FROM blogs WHERE id = $id");
  echo "<script>alert('Blog deleted successfully!'); window.location='add_blogs.php';</script>";
  exit;
}

if (isset($_POST['update'])) {
  $id = intval($_POST['id']);
  $title = $_POST['title'];
  $author = $_POST['author'];
  $date = $_POST['date'];
  $description = $_POST['description'];

  if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $path = "uploads/blogs/" . $image;
    move_uploaded_file($tmp, $path);
    $query = "UPDATE blogs SET title='$title', author='$author', date='$date', image='$path', description='$description' WHERE id=$id";
  } else {
    $query = "UPDATE blogs SET title='$title', author='$author', date='$date', description='$description' WHERE id=$id";
  }

  mysqli_query($con, $query);
  echo "<script>alert('Blog updated successfully!'); window.location='add_blogs.php';</script>";
  exit;
}

$blogs = mysqli_query($con, "SELECT * FROM blogs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Blogs - Job Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

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
    }

    .sidebar a {
      color: white;
      display: block;
      padding: 10px 20px;
      margin: 5px 10px;
      border-radius: 8px;
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
    .sidebar a {
    color: white;
    text-decoration: none !important;
    display: block;
    padding: 10px 20px;
    margin: 5px 10px;
    border-radius: 8px;
    transition: 0.3s;
}

  </style>
</head>

<body>

  <!-- MOBILE NAV -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-lg-none">
    <div class="container-fluid">
      <a class="navbar-brand fw-semibold">Job Portal</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row flex-nowrap">

      <!-- SIDEBAR -->
      <nav id="sidebarMenu" class="col-lg-2 col-md-3 collapse d-lg-block sidebar">
        <h4 class="text-center mb-4 d-none d-lg-block">Job Portal</h4>

        <a href="dashboard.php"><i class="fas fa-house me-2"></i>Dashboard</a>
        <a href="postajob.php"><i class="fas fa-circle-plus me-2"></i>Post New Job</a>
        <a href="viewjob.php"><i class="fas fa-list me-2"></i>View Jobs</a>
        <a href="applications.php"><i class="fas fa-envelope-open-text me-2"></i>Applications</a>
        <a href="popular_categories.php"><i class="fas fa-layer-group me-2"></i>Category</a>
        <a href="manage_company_logos.php"><i class="fas fa-building me-2"></i>Company Logos</a>
        <a href="add_blogs.php" class="active"><i class="fas fa-folder-open me-2"></i>Blogs</a>
        <a href="profile.php"><i class="fas fa-user me-2"></i>Profile</a>
        <a href="settings.php"><i class="fas fa-gear me-2"></i>Settings</a>
        <a href="logout.php"><i class="fas fa-right-from-bracket me-2"></i>Logout</a>
      </nav>

      <!-- MAIN CONTENT -->
      <main class="col-lg-10 col-md-9 ms-auto p-4">

        <h2 class="fw-bold mb-4">Manage Blogs</h2>

        <!-- BLOG FORM -->
        <div class="card p-4 shadow-sm rounded mb-4">
          <?php if (isset($_GET['edit'])) {
            $id = intval($_GET['edit']);
            $editData = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM blogs WHERE id='$id'"));
          ?>

          <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $editData['id']; ?>">

            <div class="row g-2">
              <div class="col-md-6">
                <input type="text" name="title" value="<?= $editData['title']; ?>" class="form-control" required placeholder="Title">
              </div>

              <div class="col-md-6">
                <input type="text" name="author" value="<?= $editData['author']; ?>" class="form-control" required placeholder="Author">
              </div>

              <div class="col-md-6">
                <input type="date" name="date" value="<?= $editData['date']; ?>" class="form-control" required>
              </div>

              <div class="col-md-6">
                <input type="file" name="image" class="form-control">
              </div>

              <div class="col-12">
                <textarea name="description" class="form-control" rows="3" required><?= $editData['description']; ?></textarea>
              </div>

              <div class="col-12">
                <button type="submit" name="update" class="btn btn-primary w-100 mt-2">Update Blog</button>
              </div>
            </div>
          </form>

          <?php } else { ?>

          <form method="POST" enctype="multipart/form-data">

            <div class="row g-2">
              <div class="col-md-6">
                <input type="text" name="title" class="form-control" required placeholder="Title">
              </div>

              <div class="col-md-6">
                <input type="text" name="author" class="form-control" required placeholder="Author">
              </div>

              <div class="col-md-6">
                <input type="date" name="date" class="form-control" required>
              </div>

              <div class="col-md-6">
                <input type="file" name="image" class="form-control" required>
              </div>

              <div class="col-12">
                <textarea name="description" class="form-control" rows="3" required></textarea>
              </div>

              <div class="col-12">
                <button type="submit" name="save" class="btn btn-outline-primary w-100 mt-2">Save Blog</button>
              </div>
            </div>

          </form>
          <?php } ?>
        </div>

        <!-- BLOG TABLE -->
        <div class="card shadow-sm rounded">
          <div class="card-body">
            <h5 class="fw-bold mb-3">All Blogs</h5>

            <div class="table-responsive">
              <table class="table table-bordered text-center align-middle">
                <thead class="table-success">
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th style="width: 200px;">Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($blogs)) { ?>
                  <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['title']; ?></td>
                    <td><?= $row['author']; ?></td>
                    <td><?= $row['date']; ?></td>
                    <td><img src="<?= $row['image']; ?>" width="80" height="60" class="rounded"></td>
                    <td><?= substr(strip_tags($row['description']), 0, 60); ?>...</td>
                    <td>
                      <a href="?edit=<?= $row['id']; ?>" class="btn btn-warning btn-sm mb-1">Edit</a>
                      <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Delete this blog?');" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    ClassicEditor.create(document.querySelector('textarea[name="description"]')).catch(console.error);
  </script>

</body>
</html>
