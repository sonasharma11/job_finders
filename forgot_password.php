<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if (isset($_POST['send_reset'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check = mysqli_query($con, "SELECT * FROM tbl_users WHERE email='$email'");
    if (mysqli_num_rows($check) == 0) {
        $msg = "<div class='alert alert-danger'>Email not found!</div>";
    } else {
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));
        mysqli_query($con, "INSERT INTO password_resets(email, token, expires_at) VALUES('$email', '$token', '$expires')");
        $reset_link = "http://localhost/job_finder/reset_password.php?token=$token";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "sonasharma42003@gmail.com";
            $mail->Password = "eouj lacb grhd raib";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->setFrom("sonasharma42003@gmail.com", "JobFinder");
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Reset Your Password";
            $mail->Body = "
                <h3>Password Reset Request</h3>
                <p>Click below to reset your password:</p>
                <a href='$reset_link' style='padding:10px 20px;background:#28a745;color:white;text-decoration:none;border-radius:5px;'>Reset Password</a>
                <p>If button doesn't work, copy this link:<br>$reset_link</p>
            ";
            $mail->send();
            $msg = "<div class='alert alert-success'>Reset link sent to your email!</div>";
        } catch (Exception $e) {
            $msg = "<div class='alert alert-danger'>Mail failed: {$mail->ErrorInfo}</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="col-lg-5 col-md-7">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <h3 class="text-center text-success fw-bold mb-3">Forgot Password</h3>
                <p class="text-center text-muted mb-4">Enter your email to receive reset link</p>
                <?php if(isset($msg)) echo $msg; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100 fw-semibold" name="send_reset">Send Reset Link</button>
                </form>
                <div class="text-center mt-4">
                    <a href="login_process.php" class="text-success fw-semibold">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
