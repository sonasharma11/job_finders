<?php if (isset($_GET['mail'])): ?>
  <script>
    <?php if ($_GET['mail'] == 'success'): ?>
      alert("Mail sent successfully!");
    <?php else: ?>
      alert("Mail failed: <?= $_GET['error'] ?? '' ?>");
    <?php endif; ?>
  </script>
<?php endif; ?>


<?php
session_start();
include 'connection.php';

if ($_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

$fetch_list = "SELECT * FROM job_applications";
$res = mysqli_query($con, $fetch_list);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applications - Job Portal</title>

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

    /* Sidebar */
    .sidebar {
      background-color: var(--primary-color);
      color: white;
      min-height: 100vh;
      padding-top: 20px;
      transition: 0.3s;
    }

    .sidebar a {
      color: white;
      text-decoration: none !important;
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

    /* Table */
    .table thead {
      background-color: var(--primary-color);
      color: white;
    }

    .table tbody tr:hover {
      background-color: #f1f1f1;
      transition: background 0.3s;
    }

    .table-responsive {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .table td,
    .table th {
      white-space: nowrap;
    }

    /* Card */
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      transition: 0.3s ease;
    }

    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    /* Responsive Changes */
    @media (max-width: 991px) {
      .sidebar {
        min-height: auto;
      }
    }

    @media (max-width: 768px) {
      .page-header-box {
        flex-direction: column;
        align-items: stretch !important;
        gap: 10px;
      }

      #downloadPDF {
        width: 100%;
      }
    }

    @media (max-width: 576px) {

      table td,
      table th {
        font-size: 13px;
      }

      td div {
        max-width: 120px !important;
      }
    }
  </style>
</head>

<body>

  <!-- Mobile Navbar -->
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

      <!-- Sidebar -->
      <nav id="sidebarMenu" class="col-lg-2 col-md-3 collapse d-lg-block sidebar">
        <h4 class="text-center mb-4 d-none d-lg-block">Job Portal</h4>
        <a href="dashboard.php"><i class="fa-solid fa-house me-2"></i>Dashboard</a>
        <a href="postajob.php"><i class="fa-solid fa-plus me-2"></i>Post New Job</a>
        <a href="viewjob.php"><i class="fa-solid fa-list me-2"></i>View Jobs</a>
        <a href="applications.php" class="active"><i class="fa-solid fa-envelope-open-text me-2"></i>Applications</a>
        <a href="popular_categories.php"><i class="fa-solid fa-layer-group me-2"></i>Category</a>
        <a href="manage_company_logos.php"><i class="fa-solid fa-building me-2"></i>Company Logos</a>
        <a href="add_blogs.php"><i class="fa-solid fa-folder-open me-2"></i>Blogs</a>
        <a href="profile.php"><i class="fa-solid fa-user me-2"></i>Profile</a>
        <a href="settings.php"><i class="fa-solid fa-gear me-2"></i>Settings</a>
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
      </nav>

      <!-- Main Content -->
      <main class="col-lg-10 col-md-9 ms-auto p-4">
        <div class="container">

          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center mb-4 page-header-box">
            <div>
              <h2 class="fw-bold">📨 Job Applications</h2>
              <p class="text-muted">Below are all the job applications submitted by users.</p>
            </div>
            <button id="downloadPDF" class="btn btn-danger">
              <i class="fas fa-file-pdf"></i> PDF
            </button>
          </div>

          <!-- Table -->
          <div class="card p-4">
            <div class="table-responsive">
              <table id="applicationsTable" class="table table-bordered text-center align-middle">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Job</th>
                    <th>Resume</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (mysqli_num_rows($res) > 0): ?>
                    <?php while ($user = mysqli_fetch_assoc($res)): ?>
                      <tr>
                        <td><?= htmlspecialchars($user['id']); ?></td>
                        <td><?= htmlspecialchars($user['name']); ?></td>
                        <td><?= htmlspecialchars($user['user_id']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td><?= htmlspecialchars($user['phone']); ?></td>
                        <td><?= htmlspecialchars($user['job_position']); ?></td>
                        <td>
                          <?php if (!empty($user['resume'])): ?>
                            <a href="uploads/resumes/<?= htmlspecialchars($user['resume']); ?>" target="_blank">
                              <?= htmlspecialchars($user['resume']); ?>
                            </a>
                          <?php else: ?> N/A <?php endif; ?>
                        </td>
                        <td>
                          <div style="max-width:180px; overflow-x:auto; white-space:nowrap;">
                            <?= htmlspecialchars($user['message']); ?>
                          </div>
                        </td>
                        <td><?= htmlspecialchars($user['created_at']); ?></td>

                        <td>
                          <?php if ($user['status'] == 'Pending' || $user['status'] == ''): ?>
                            <a href="demomail.php?id=<?= $user['id']; ?>&status=Approved"
                              class="btn btn-success btn-sm">Approve</a>

                            <a href="demomail.php?id=<?= $user['id']; ?>&status=Rejected"
                              class="btn btn-danger btn-sm">Reject</a>
                          <?php elseif ($user['status'] == 'Approved'): ?>
                            <span class="badge bg-success">Approved</span>
                          <?php elseif ($user['status'] == 'Rejected'): ?>
                            <span class="badge bg-danger">Rejected</span>
                          <?php endif; ?>
                        </td>


                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="10" class="text-muted">No applications found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <script>
    const {
      jsPDF
    } = window.jspdf;
    document.getElementById('downloadPDF').addEventListener('click', () => {
      const table = document.getElementById('applicationsTable');
      html2canvas(table, {
        scale: 2
      }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('l', 'pt', 'a4');
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();
        const imgWidth = canvas.width;
        const imgHeight = canvas.height;
        const ratio = Math.min(pageWidth / imgWidth, pageHeight / imgHeight);
        const imgX = (pageWidth - imgWidth * ratio) / 2;
        pdf.addImage(imgData, 'PNG', imgX, 20, imgWidth * ratio, imgHeight * ratio);
        pdf.save('job_applications.pdf');
      });
    });
  </script>

</body>

</html>