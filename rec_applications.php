<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
  header("Location:index.php");
  exit;
}

$recruiter_id = $_SESSION['user_id'];

$fetch_list = "
  SELECT ja.* 
  FROM job_applications ja
  INNER JOIN job j ON ja.job_position = j.job_title
  WHERE j.recruiter_id = '$recruiter_id'
  ORDER BY ja.created_at DESC
";

$res = mysqli_query($con, $fetch_list);

if (!$res) {
    die("Error in fetching applications: " . mysqli_error($con));
}
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
  overflow-x: hidden !important;
}

/* Sidebar */
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

/* Table */
.table thead {
  background-color: var(--primary-color);
  color: white;
}

.table tbody tr:hover {
  background-color: #f1f1f1;
  transition: background 0.3s;
}

/* Cards */
.card {
  border: none;
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.12);
}

/* Responsive Fixes */
@media (max-width: 991px) {
  .sidebar {
    min-height: auto;
    width: 100% !important;
  }
  main {
    margin-top: 15px;
  }
}

@media (max-width: 768px) {
  h2 {
    font-size: 1.4rem !important;
  }
  #downloadPDF {
    margin-top: 10px !important;
  }
  .table-responsive {
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch;
  }
  .table td, .table th {
    white-space: nowrap !important;
    font-size: 13px;
  }
}

@media (max-width: 480px) {
  .badge {
    font-size: 0.65rem !important;
  }
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
      <a href="rec_dashboard.php"><i class="fa-solid fa-plus me-2"></i>Post New Job</a>
      <a href="rec_applications.php" class="active"><i class="fa-solid fa-envelope-open-text me-2"></i>Applications</a>
      <a href="rec_profile.php"><i class="fa-solid fa-user me-2"></i>Profile</a>
      <a href="rec_settings.php"><i class="fa-solid fa-gear me-2"></i>Settings</a>
      <a href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
    </nav>

    <main class="col-lg-10 col-md-9 ms-auto p-4">
      <div class="container">
       <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
  <h2 class="fw-bold mb-0">📨 Job Applications</h2>

  <p class="text-muted mb-0 mx-md-3" style="flex:1; min-width:100%;">
    Below are the job applications submitted for your posted jobs.
  </p>

  <button id="downloadPDF" class="btn btn-danger ms-md-auto w-100 w-md-auto mt-2 mt-md-0">
    <i class="fas fa-file-pdf"></i> PDF
  </button>
</div>


        <div class="card p-4">
          <div class="table-responsive">
            <table id="applicationsTable" class="table table-bordered align-middle text-center">
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
              <?php if(mysqli_num_rows($res)>0): while($user=mysqli_fetch_assoc($res)): ?>
                <tr>
                  <td><?= $user['id'] ?></td>
                  <td><?= $user['name'] ?></td>
                  <td><?= $user['user_id'] ?></td>
                  <td><?= $user['email'] ?></td>
                  <td><?= $user['phone'] ?></td>
                  <td><?= $user['job_position'] ?></td>
                  <td>
                    <?php if(!empty($user['resume'])): ?>
                      <a href="uploads/resumes/<?= $user['resume'] ?>" target="_blank"><?= $user['resume'] ?></a>
                    <?php else: ?>N/A<?php endif; ?>
                  </td>
                  <td style="max-width:180px; white-space:normal;"><?= $user['message'] ?></td>
                  <td><?= $user['created_at'] ?></td>
                  <td>
                    <span class="badge 
                      <?= $user['status']=='Approved'?'bg-success':($user['status']=='Rejected'?'bg-danger':'bg-warning text-dark') ?>">
                      <?= $user['status'] ?? 'Pending' ?>
                    </span>
                  </td>
                </tr>
              <?php endwhile; else: ?>
                <tr><td colspan="10" class="text-muted">No applications found.</td></tr>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </main>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
const { jsPDF } = window.jspdf;

document.getElementById('downloadPDF').addEventListener('click', () => {
  const table = document.getElementById('applicationsTable');

  html2canvas(table, { scale: 2 }).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const pdf = new jsPDF('l','pt','a4');
    const pw = pdf.internal.pageSize.getWidth();
    const ph = pdf.internal.pageSize.getHeight();
    const ratio = Math.min(pw/canvas.width, ph/canvas.height);

    pdf.addImage(imgData,'PNG', (pw - canvas.width*ratio)/2,20, canvas.width*ratio, canvas.height*ratio);
    pdf.save("job_applications_for_recruiter.pdf");
  });
});
</script>

</body>
</html>
