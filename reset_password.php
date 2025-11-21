<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

if (!isset($_GET['token'])) die("Invalid token!");

$token = $_GET['token'];
$query = mysqli_query($con, "SELECT * FROM password_resets WHERE token='$token'");
$data = mysqli_fetch_assoc($query);

if (!$data || strtotime($data['expires_at']) < time()) die("Token expired or invalid!");

$email = $data['email'];

if (isset($_POST['reset_password'])) {
    $new_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    mysqli_query($con, "UPDATE tbl_users SET password='$new_pass' WHERE email='$email'");
    mysqli_query($con, "DELETE FROM password_resets WHERE email='$email'");
    $success_msg = "<div class='alert alert-success'>Password updated successfully! <a href='login_process.php'>Login</a></div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="col-lg-5 col-md-7">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <h3 class="text-center text-success fw-bold mb-3">Reset Password</h3>
                <p class="text-center text-muted mb-4">Enter a new password</p>
                <?php if(isset($success_msg)) echo $success_msg; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100 fw-semibold" name="reset_password">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
