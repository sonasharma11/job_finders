<?php
session_start();
include 'connection.php';

if ($_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

$query = mysqli_query($con, "SELECT * FROM job");
if (!$query) {
  die("Database query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Jobs - Job Portal</title>

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

    /* Card Style */
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .job-title {
      color: var(--primary-color);
      font-weight: 600;
    }

    .btn-custom {
      border-radius: 6px;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-edit {
      color: #155fc0;
      border-color: #155fc0;
    }

    .btn-edit:hover {
      background-color: #155fc0;
      color: white;
    }

    .btn-view {
      color: #198754;
      border-color: #198754;
    }

    .btn-view:hover {
      background-color: #198754;
      color: white;
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
        <a href="viewjob.php" class="active"><i class="fa-solid fa-list me-2"></i>View Jobs</a>
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
          <h2 class="fw-bold mb-4">📋 View All Jobs</h2>

          <div class="row g-4">
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
              <?php $jobId = (int)$row['id']; ?>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card p-4 h-100">
                  <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                      <h5 class="job-title mb-1"><?= htmlspecialchars($row['job_title']); ?></h5>
                      <p class="mb-1"><i class="fa-solid fa-building text-secondary me-1"></i><?= htmlspecialchars($row['company']); ?></p>
                      <p class="mb-1"><i class="fa-solid fa-location-dot text-secondary me-1"></i><?= htmlspecialchars($row['location']); ?></p>
                      <p class="text-secondary text-truncate mb-0"><i class="fa-solid fa-file-lines text-secondary me-1"></i><?= htmlspecialchars($row['job_description']); ?></p>
                    </div>
                  </div>

                  <div class="mt-3">
                    <button class="btn btn-outline-primary btn-sm btn-custom btn-edit me-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $jobId; ?>">
                      <i class="fa-solid fa-pen me-1"></i>Edit
                    </button>
                    <button class="btn btn-outline-success btn-sm btn-custom btn-view" data-bs-toggle="modal" data-bs-target="#viewModal<?= $jobId; ?>">
                      <i class="fa-solid fa-eye me-1"></i>View
                    </button>
                    <?php if ($row['status'] == 'active'): ?>
                      <button class="btn btn-success btn-sm btn-custom toggle-status"
                        data-id="<?= $jobId; ?>"
                        data-status="inactive">
                        <i class="fa-solid fa-toggle-on me-1"></i> Active
                      </button>
                    <?php else: ?>
                      <button class="btn btn-secondary btn-sm btn-custom toggle-status"
                        data-id="<?= $jobId; ?>"
                        data-status="active">
                        <i class="fa-solid fa-toggle-off me-1"></i> Inactive
                      </button>
                    <?php endif; ?>

                  </div>
                </div>
              </div>

              <div class="modal fade" id="editModal<?= $jobId; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="update_job.php" method="POST">
                      <div class="modal-header bg-light">
                        <h5 class="modal-title fw-semibold">Edit Job</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $jobId; ?>">

                        <div class="mb-3">
                          <label class="form-label fw-semibold">Job Title</label>
                          <input type="text" class="form-control" name="job_title" value="<?= htmlspecialchars($row['job_title']); ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-semibold">Company</label>
                          <input type="text" class="form-control" name="company" value="<?= htmlspecialchars($row['company']); ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-semibold">Location</label>
                          <input type="text" class="form-control" name="location" value="<?= htmlspecialchars($row['location']); ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-semibold">Job Description</label>
                          <textarea class="form-control" name="job_description" rows="3"><?= htmlspecialchars($row['job_description']); ?></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check me-1"></i>Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="viewModal<?= $jobId; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-light">
                      <h5 class="modal-title fw-bold"><?= htmlspecialchars($row['job_title']); ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <p><strong><i class="fa-solid fa-building me-2"></i>Company:</strong> <?= htmlspecialchars($row['company']); ?></p>
                      <p><strong><i class="fa-solid fa-location-dot me-2"></i>Location:</strong> <?= htmlspecialchars($row['location']); ?></p>
                      <hr>
                      <h6 class="fw-bold text-success">Job Description:</h6>
                      <p><?= nl2br(htmlspecialchars($row['job_description'])); ?></p>
                    </div>
                    <div class="modal-footer">
                      <a href="apply.php?job_id=<?= $jobId; ?>" class="btn btn-success">
                        <i class="fa-solid fa-paper-plane me-2"></i>Apply Now
                      </a>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

            <?php endwhile; ?>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.querySelectorAll('.toggle-status').forEach(button => {
      button.addEventListener('click', function() {
        const jobId = this.dataset.id;
        const newStatus = this.dataset.status;
        const btn = this;

        fetch('update_status.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `job_id=${jobId}&status=${newStatus}`
          })
          .then(res => res.text())
          .then(response => {
            if (response.trim() === 'success') {
              if (newStatus === 'active') {
                btn.dataset.status = 'inactive';
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-success');
                btn.innerHTML = '<i class="fa-solid fa-toggle-on me-1"></i> Active';
              } else {
                btn.dataset.status = 'active';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-secondary');
                btn.innerHTML = '<i class="fa-solid fa-toggle-off me-1"></i> Inactive';
              }
            } else {
              alert('Failed to update status. Try again.');
            }
          });
      });
    });
  </script>

</body>

</html>