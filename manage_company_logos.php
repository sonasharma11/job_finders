<?php
include 'connection.php';
session_start();

if ($_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

if (isset($_POST['add_logo'])) {
    $logo = $_FILES['logo']['name'];
    $tmp = $_FILES['logo']['tmp_name'];

    $uploadDir = 'uploads/company_logos/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $path = $uploadDir . $logo;
    move_uploaded_file($tmp, $path);

    mysqli_query($con, "INSERT INTO company_logos (logo_path) VALUES ('$path')");
    header("Location: manage_company_logos.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM company_logos WHERE id='$id'");
    header("Location: manage_company_logos.php");
    exit;
}

$logos = mysqli_query($con, "SELECT * FROM company_logos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Company Logos - Job Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="popular_categories.php"><i class="fa-solid fa-layer-group me-2"></i>Category</a>
                <a href="manage_company_logos.php" class="active"><i class="fa-solid fa-building me-2"></i>Company Logos</a>
                <a href="add_blogs.php"><i class="fa-solid fa-folder-open me-2"></i>Blogs</a>
                <a href="profile.php"><i class="fa-solid fa-user me-2"></i>Profile</a>
                <a href="settings.php"><i class="fa-solid fa-gear me-2"></i>Settings</a>
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
            </nav>

            <main class="col-lg-10 col-md-9 ms-auto p-4">
                <div class="container">
                    <h2 class="mb-4 fw-bold">Manage Company Logos</h2>

                    <form method="POST" enctype="multipart/form-data" class="mb-4">
                        <div class="row">
                            <div class="col-md-10">
                                <input type="file" name="logo" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" name="add_logo" class="btn btn-outline-primary w-100">Add +</button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered text-center align-middle bg-white shadow-sm">
                        <thead class="table-success">
                            <tr>
                                <th>ID</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($logos)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><img src="<?php echo $row['logo_path']; ?>" alt="Logo" height="50"></td>
                                    <td><a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
