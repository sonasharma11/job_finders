<?php
include 'connection.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid blog ID!'); window.location='index.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($con, "SELECT * FROM blogs WHERE id = $id");

if (mysqli_num_rows($query) == 0) {
    echo "<script>alert('Blog not found!'); window.location='index.php';</script>";
    exit;
}

$blog = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $blog['title']; ?> - Blog Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .blog-image {
      width: 100%;
      max-height: 600px;
      object-fit: cover;
      border-radius: 10px;
    }
    .blog-content {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      margin-top: 30px;
    }
  </style>
  
</head>

<body>

  <div class="container mt-5 mb-5">
    <div class="text-center mb-4">
      <h1 class="text-success fw-bold"><?php echo $blog['title']; ?></h1>
      <p class="text-muted">
        <?php echo date('F d, Y', strtotime($blog['date'])); ?> • 
        By <span class="text-success"><?php echo $blog['author']; ?></span>
      </p>
    </div>

    <img src="<?php echo $blog['image']; ?>" alt="Blog Image" class="blog-image mb-4">

    <div class="blog-content">
      <p class="fs-5 text-secondary" style="white-space: pre-line;">
        <?php echo nl2br($blog['description']); ?>
      </p>
    </div>

    <div class="text-center mt-4">
      <a href="index.php" class="btn btn-outline-success">← Back to Home</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
