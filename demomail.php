<?php
session_start();
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header("Location: applications.php");
    exit;
}

$id = intval($_GET['id']);
$status = $_GET['status'];

// Fetch user info
$query = "SELECT * FROM job_applications WHERE id = $id";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: applications.php?mail=failed&error=User not found");
    exit;
}

// Update status
$update = "UPDATE job_applications SET status='$status' WHERE id=$id";
if (!mysqli_query($con, $update)) {
    header("Location: applications.php?mail=failed&error=Database update failed");
    exit;
}

// Send email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Gmail SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sonasharma42003@gmail.com'; // Replace with your email
    $mail->Password   = 'eouj lacb grhd raib';     // Use App Password, not normal Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('sonasharma42003@gmail.com', 'JobFinder');
    $mail->addAddress($user['email'], $user['name']);

    $mail->isHTML(true);
    $mail->Subject = "Job Application Status Update";

   if ($status == 'Approved') {
    $mail->Body = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .email-container {
                max-width: 600px;
                margin: 40px auto;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                padding: 20px;
            }
            .header {
                background-color: #4CAF50;
                color: white;
                padding: 20px;
                text-align: center;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }
            .content {
                padding: 20px;
                font-size: 16px;
                color: #333333;
                line-height: 1.5;
            }
            .footer {
                text-align: center;
                font-size: 12px;
                color: #777777;
                margin-top: 20px;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                margin-top: 20px;
                font-size: 16px;
                color: white;
                background-color: #4CAF50;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <div class='header'>
                JobFinder
            </div>
            <div class='content'>
                <p>Dear {$user['name']},</p>
                <p>Congratulations! Your application for the position of <strong>{$user['job_position']}</strong> has been <strong style='color:green;'>approved</strong>.</p>
                <p>We are excited to move forward with you. Please check your account for further details and next steps.</p>
                <a href='https://yourjobportal.com/login'></a>
                <p>Best regards,<br>JobFinder Team</p>
            </div>
            <div class='footer'>
                &copy; ".date('Y')." JobFinder. All rights reserved.
            </div>
        </div>
    </body>
    </html>
    ";
} else {
    $mail->Body = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .email-container {
                max-width: 600px;
                margin: 40px auto;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                padding: 20px;
            }
            .header {
                background-color: #f44336;
                color: white;
                padding: 20px;
                text-align: center;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }
            .content {
                padding: 20px;
                font-size: 16px;
                color: #333333;
                line-height: 1.5;
            }
            .footer {
                text-align: center;
                font-size: 12px;
                color: #777777;
                margin-top: 20px;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                margin-top: 20px;
                font-size: 16px;
                color: white;
                background-color: #f44336;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <div class='header'>
                JobFinder
            </div>
            <div class='content'>
                <p>Dear {$user['name']},</p>
                <p>We regret to inform you that your application for the position of <strong>{$user['job_position']}</strong> has been <strong style='color:red;'>rejected</strong>.</p>
                <p>We encourage you to apply for other opportunities in the future that match your skills and experience.</p>
                <a href='https://yourjobportal.com/jobs'></a>
                <p>Best regards,<br>JobFinder Team</p>
            </div>
            <div class='footer'>
                &copy; ".date('Y')." JobFinder. All rights reserved.
            </div>
        </div>
    </body>
    </html>
    ";
}


    $mail->send();
    header("Location: applications.php?mail=success");
} catch (Exception $e) {
    header("Location: applications.php?mail=failed&error=" . urlencode($mail->ErrorInfo));
}
