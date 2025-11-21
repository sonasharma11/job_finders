<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<style>
    .navbar .nav-link {
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .navbar .nav-link:hover {
        color: #198754 !important;
        transform: translateY(-2px);
    }

    .navbar .nav-link::after {
        content: "";
        display: block;
        width: 0;
        height: 2px;
        background-color: #198754;
        transition: width 0.3s;
        margin-top: 2px;
    }

    .navbar .nav-link:hover::after {
        width: 100%;
    }

    .navbar-brand:hover {
        color: #198754 !important;
        transition: color 0.3s ease;
    }
</style>
<style>
    /* Card hover effect */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Button hover effect */
    .btn-success {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #28a745cc;
        /* slightly lighter/transparent */
        color: #fff;
    }

    .btn-outline-success {
        transition: all 0.3s ease;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: #fff;
        border-color: #28a745;
    }

    /* Input/textarea focus effect */
    input.form-control:focus,
    textarea.form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        outline: none;
        transition: all 0.3s ease;
    }

    /* Links hover effect */
    a.text-success {
        position: relative;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    a.text-success::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #28a745;
        transition: width 0.3s;
    }

    a.text-success:hover::after {
        width: 100%;
    }

    a.text-success:hover {
        color: #19692c;
        /* darker green */
    }

    /* Optional: modal content hover lift */
    .modal-content {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .modal-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }
</style>
<style>
    /* Footer */
    footer {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: #cbd5e1;
        position: relative;
        overflow: hidden;
    }

    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.5), transparent);
    }

    footer h4 {
        color: #ffffff;
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-size: 1.2rem;
    }

    footer a {
        color: #cbd5e1;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    footer a:hover {
        color: #667eea;
        transform: translateX(5px);
    }

    .social-icon {
        width: 45px;
        height: 45px;
        background: rgba(102, 126, 234, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        color: #cbd5e1;
    }

    .social-icon:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        transform: translateY(-5px);
    }

    .btn-read-more {
        background: rgba(102, 126, 234, 0.1);
        border: 2px solid rgba(102, 126, 234, 0.3);
        color: #ffffff;
        padding: 0.7rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-read-more:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    /* Animations */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 3rem;
        }

        .signup-card {
            margin: 1rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }
    }

    /* Loading Animation */
    .btn-signup.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Success Message */
    .success-message {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 1rem;
        border-radius: 14px;
        margin-bottom: 1.5rem;
        display: none;
        animation: slideDown 0.5s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .success-message.show {
        display: block;
    }
</style>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-2">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand fs-1 fw-light" href="index.php">
                Job<span class="fw-bold">Finder</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mb-2 ms-auto mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary" href="for_candidates.php">FOR CANDIDATES</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary" href="for_employees.php">FOR EMPLOYEES</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary" href="contact.php">CONTACT</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="applyforjob.php" class="nav-link active text-dark fw-bold text-secondary">APPLY</a>
                    </li>

                    <li class="nav-item dropdown mx-2">
                        <div class="d-flex align-items-center">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <div class="d-flex align-items-center bg-light rounded-pill px-3 py-1 shadow-sm">
                                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="User"
                                        width="36" height="36" class="rounded-circle border border-success me-2">
                                    <span class="fw-semibold text-dark me-3"><?php echo $_SESSION['user_name']; ?></span>
                                    <a href="logout.php" class="btn btn-outline-danger btn-sm px-3 py-1 rounded-pill">Logout</a>
                                </div>
                            <?php else: ?>
                                <div class="d-flex flex-column flex-lg-row align-items-center">
                                    <a href="login_process.php" class="nav-link fw-bold text-secondary">LOGIN</a>
                                    <a href="register_process.php" class="nav-link fw-bold text-secondary">SIGN UP</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="text-white text-center"
        style="background-image: url('https://images.unsplash.com/photo-1543269664-56d93c1b41a6?auto=format&fit=crop&q=60&w=900');
         background-size: cover; background-position: center; min-height: 28rem; display: flex; align-items: center;">
        <div class="container align-items-center">
            <h1 class="fw-light" style="font-size: 3rem;">Apply for a Job</h1>
            <a href="index.php" class="text-decoration-none text-success bg-light fs-5"> Home </a>
            <span class="text-dark bg-light fs-5"> > Apply Job</span>
        </div>
    </section>

    <?php
    if (isset($_POST['apply'])) {
        include('connection.php');

        if (!isset($_SESSION['user_id'])) {
            echo "<script>
                alert('Please login first to apply for a job.');
                window.location.href = 'login_process.php';
            </script>";
            exit();
        }

        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $job_position = mysqli_real_escape_string($con, $_POST['job_position']);
        $message = mysqli_real_escape_string($con, $_POST['message']);
        $user_id = $_SESSION['user_id'];

        $resume = $_FILES['resume']['name'];
        $tmp_name = $_FILES['resume']['tmp_name'];
        $folder = "uploads/resumes/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $resume_name = time() . "_" . basename($resume);
        $target_path = $folder . $resume_name;

        if (move_uploaded_file($tmp_name, $target_path)) {
            $query = "INSERT INTO job_applications (user_id, name, email, phone, job_position, message, resume)
                      VALUES ('$user_id', '$name', '$email', '$phone', '$job_position', '$message', '$resume_name')";

            $data = mysqli_query($con, $query);

            if ($data) {
                echo "<script>alert('Application submitted successfully!');</script>";
            } else {
                echo "<script>alert('Database error. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Resume upload failed. Please try again.');</script>";
        }
    }
    ?>

    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7 col-md-12">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 h-100">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h2 class="fw-bold text-success">Apply for a Job</h2>
                                <p class="text-muted mt-2">Fill out the details carefully to apply for your dream job.</p>
                            </div>

                            <?php

                            use PHPMailer\PHPMailer\PHPMailer;
                            use PHPMailer\PHPMailer\Exception;

                            require 'vendor/autoload.php';

                            if (isset($_POST['apply'])) {
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $job_position = $_POST['job_position'];
                                $message = $_POST['message'];

                                // Optional: handle resume upload
                                if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
                                    $resume_name = $_FILES['resume']['name'];
                                    $resume_tmp = $_FILES['resume']['tmp_name'];
                                    $upload_dir = 'uploads/';
                                    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
                                    move_uploaded_file($resume_tmp, $upload_dir . $resume_name);
                                }

                                // Send confirmation email
                                $mail = new PHPMailer(true);
                                try {
                                    // Server settings
                                    $mail->isSMTP();
                                    $mail->Host       = 'smtp.gmail.com';  // For Gmail
                                    $mail->SMTPAuth   = true;
                                    $mail->Username   = 'sonasharma42003@gmail.com'; // Your Gmail address
                                    $mail->Password   = 'eouj lacb grhd raib';   // Use App Password, not normal Gmail password
                                    $mail->SMTPSecure = 'tls';
                                    $mail->Port       = 587;

                                    // Recipients
                                    $mail->setFrom('sonasharma42003@gmail.com', 'JobFinder');
                                    $mail->addAddress($email, $name);

                                    // Content
                                    $mail->isHTML(true);
                                    $mail->Subject = 'Thank You for Applying';
                                    $mail->Body    = "
                                                     <h3>Thank you, $name!</h3>
                                                     <p>You have successfully applied for the position of <b>$job_position</b>.</p>
                                                     <p>We will review your application and get back to you soon.</p>
                                                     <p>Regards,<br>HR Team</p>
                                                      ";

                                    $mail->send();
                                    echo "<script>alert('Application submitted successfully! A confirmation email has been sent.');</script>";
                                } catch (Exception $e) {
                                    echo "<script>alert('Application submitted but email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
                                }

                                // Optional: Save application data to database here
                            }
                            ?>

                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control form-control-lg rounded-3" name="name" placeholder="Enter your full name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control form-control-lg rounded-3" name="email" placeholder="Enter your email" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Phone Number</label>
                                    <input type="text" class="form-control form-control-lg rounded-3" name="phone" placeholder="Enter your phone number" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Job Position</label>
                                    <input type="text" class="form-control form-control-lg rounded-3"
                                        name="job_position"
                                        placeholder="e.g. Web Developer, UI Designer"
                                        value="<?php echo isset($_GET['job_position']) ? htmlspecialchars($_GET['job_position']) : ''; ?>"
                                        required>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload Resume</label>
                                    <input type="file" class="form-control form-control-lg rounded-3" name="resume" accept=".pdf,.doc,.docx,.jpg" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Message / Cover Letter</label>
                                    <textarea class="form-control form-control-lg rounded-3" rows="5" name="message" placeholder="Write a short message..." required></textarea>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success btn-lg fw-semibold px-5 rounded-3" name="apply">
                                        Submit Application
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 d-flex flex-column gap-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="card-body">
                            <h3 class="fw-bold text-success mb-4">Contact Info</h3>

                            <div class="mb-3">
                                <h6 class="text-muted">Address</h6>
                                <p class="text-muted mb-0">203 Fake St. Agrico,<br> Jamshedpur, Jharkhand, INDIA</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted">Phone</h6>
                                <a href="tel:+1233417211" class="text-success text-decoration-none">+1 233 417 211</a>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted">Email</h6>
                                <a href="mailto:jobfinder@email.com" class="text-success text-decoration-none">jobfinder@gmail.com</a>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">Details</h6>
                                <p class="text-muted mb-0">Provide links to helpful content and resources for visitors, like an FAQ document or a link to a help center.?</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">About</h6>
                                <p class="text-muted mb-0">I’ve seen this happen to companies that hide their contact information and force customers to jump through too many hoops within a chatbot experience before talking to a support rep.</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">More Jobs</h6>
                                <p class="text-muted mb-0">Now that we've gone over a few components that make a great contact page, let’s review examples of some of the most effective Contact Us pages on the internet.,</p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 flex-grow-1 d-flex flex-column justify-content-between">
                        <div>
                            <h3 class="fw-bold text-success mb-3">More Info</h3>
                            <p class="text-muted small">
                                 A notable feature is how the Contact Us page is embedded into the HubSpot portal. I like how this complements the user experience by not only enhancing accessibility for existing customers but also eliminating the need for customers to exit their workflow to find contact information..
                            </p>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-outline-success fw-semibold w-30" data-bs-toggle="modal" data-bs-target="#jobModal">
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-4 shadow-lg">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold text-success" id="jobModalLabel">Job Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-muted">
                            <p>
                                Here you can display detailed information about the job, such as responsibilities,
                                qualifications, location, and salary.
                            </p>
                            <hr>
                            <strong>Example:</strong><br>
                            <b>Position:</b> Web Developer<br>
                            <b>Company:</b> Tech Solutions Pvt. Ltd.<br>
                            <b>Location:</b> Mumbai, India<br>
                            <b>Salary:</b> ₹5,00,000 per annum<br><br>
                            <b>Job Description:</b>
                            We are looking for a skilled web developer proficient in HTML, CSS, JavaScript, and PHP.
                            The candidate should have hands-on experience in Bootstrap and MySQL.
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5 mb-5">
        <div class="accordion accordion-flush" id="accordionFlushExample">

            <h2 class="fw-light text-center mt-5 mb-5">Frequently Ask Questions</h2>

            <!-- Job Details -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Job Description & Responsibilities
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p><strong>Position:</strong> [Job Title]</p>
                        <p><strong>Job Type:</strong> Full-Time / Part-Time / Internship</p>
                        <p><strong>Responsibilities include:</strong></p>
                        <ul>
                            <li>Managing daily tasks and coordinating with the team.</li>
                            <li>Developing and implementing project requirements.</li>
                            <li>Preparing reports and maintaining documentation.</li>
                            <li>Ensuring timely execution of assigned tasks.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Eligibility -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Eligibility & Qualification
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <ul>
                            <li>Minimum qualification: Graduate / Post Graduate in relevant field.</li>
                            <li>Freshers and experienced candidates both can apply.</li>
                            <li>Good communication and problem-solving skills.</li>
                            <li>Knowledge of industry-related tools/software is a plus.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Company Info -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                        aria-controls="flush-collapseThree">
                        Company Details & Benefits
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p><strong>Company Name:</strong> [Company Name]</p>
                        <p><strong>Location:</strong> [City, State]</p>
                        <p><strong>About the Company:</strong></p>
                        <p>
                            A reputed organization offering excellent growth opportunities and a
                            friendly working environment. The company focuses on innovation,
                            employee development, and customer satisfaction.
                        </p>

                        <p><strong>Benefits:</strong></p>
                        <ul>
                            <li>Competitive salary package</li>
                            <li>Health insurance & bonuses</li>
                            <li>Work-life balance</li>
                            <li>Career growth opportunities</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <h4>About JobFinder</h4>
                    <p class="mb-4">
                        Connecting talented individuals with great career opportunities.
                        We believe in innovation, integrity, and inclusivity.
                    </p>
                    <button class="btn btn-read-more" data-bs-toggle="modal" data-bs-target="#aboutModal">
                        Read More
                    </button>
                </div>

                 <div class="col-lg-2 col-md-6">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="applyforjob.php">About</a></li>
                            <li class="mb-2"><a href="for_candidates.php">Services</a></li>
                            <li class="mb-2"><a href="for_employees.php">Careers</a></li>
                            <li class="mb-2"><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h4>Categories</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="for_employees.php">Full Time</a></li>
                            <li class="mb-2"><a href="for_employees.php">Freelance</a></li>
                            <li class="mb-2"><a href="for_employees.php">Temporary</a></li>
                            <li class="mb-2"><a href="for_employees.php">Internship</a></li>
                        </ul>
                    </div>

                <div class="col-lg-3 col-md-6">
                    <h4>Follow Us</h4>
                    <div class="d-flex gap-3">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 pt-4" style="border-top: 1px solid rgba(203, 213, 225, 0.1);">
                <p class="mb-0">© 2025 JobFinder. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- About Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #e2e8f0;">
                    <h5 class="modal-title fw-bold">About Our Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Our company is dedicated to connecting talented individuals with great career opportunities.
                        We believe in innovation, integrity, and inclusivity. Our team works tirelessly to ensure
                        both employers and job seekers have the best experience possible.
                    </p>
                    <p class="mb-0">
                        With years of experience in the industry, we continue to evolve and adapt to the changing
                        demands of the global job market, ensuring sustainable growth and success for everyone involved.
                    </p>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="border-radius: 10px;">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>