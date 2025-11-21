<?php
session_start();

session_unset();
session_destroy();

unset($_SESSION['user_id']);
unset($_SESSION['user_name']);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout - Job Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      font-family: 'Segoe UI', sans-serif;
    }

    .logout-box {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      padding: 40px 60px;
      text-align: center;
      max-width: 400px;
    }

    .logout-box h3 {
      color: #0d3f86ff;
      font-weight: 600;
    }

    .spinner-border {
      color: #0d3f86ff;
    }

    .btn-login {
      background-color: #0d3f86ff;
      color: white;
      border-radius: 8px;
      padding: 8px 20px;
      text-decoration: none;
      display: inline-block;
      transition: 0.3s;
    }

    .btn-login:hover {
      background-color: #155fc0;
    }
  </style>
</head>

<body>

  <div class="logout-box">
    <div class="mb-4">
      <div class="spinner-border" role="status"></div>
    </div>
    <h3>Logging you out...</h3>
    <p class="text-muted mt-3">Please wait, redirecting to home page.</p>
  </div>

  <script>
    setTimeout(() => {
      window.location.href = "index.php";
    }, 1000);

    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function() {
      window.history.pushState(null, "", window.location.href);
    };
  </script>

</body>

</html>