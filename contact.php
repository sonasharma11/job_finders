<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
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
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .btn-success {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #28a745cc;
        /* slightly lighter or transparent */
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

    .fa-solid {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .fa-solid:hover {
        transform: scale(1.2);
        color: #28a745;
    }

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

    input.form-control:focus,
    textarea.form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        outline: none;
        transition: all 0.3s ease;
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
<style>
    .info-card {
        background: #ffffff;
        border: 1px solid #e5eaf0;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        transition: all 0.35s ease;
    }

    .info-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 26px rgba(0, 0, 0, 0.12);
    }

    .info-icon {
        font-size: 40px;
        color: #19a463;
        transition: transform 0.35s ease;
    }

    .info-card:hover .info-icon {
        transform: scale(1.12);
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

            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav mb-2 ms-auto mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary hover-success" href="for_candidates.php">FOR CANDIDATES</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary hover-success" href="for_employees.php">FOR EMPLOYEES</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link active text-dark fw-bold text-secondary hover-success" href="contact.php">CONTACT</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="applyforjob.php" class="nav-link fw-bold text-secondary hover-success">APPLY</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary hover-success" href="login_process.php">LOGIN</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary hover-success" href="register_process.php">SIGN UP</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="text-white text-center" style="background-image: url('https://images.unsplash.com/photo-1543269664-56d93c1b41a6?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mjh8fGpvYnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=900'); 
         background-size: cover; background-position: center; min-height: 28rem; display: flex; align-items: center;">
        <div class="container align-items-center">
            <h1 class="fw-light" style="font-size: 3rem;">Contacts</h1>
            <a href="index.php" class="text-decoration-none text-success bg-light fs-5"> Home </a><span
                class="text-dark bg-light fs-5"> > Contact</span>
        </div>
    </section>
    <?php
    include('connection.php');

    if (isset($_POST['submit'])) {
        $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $message = mysqli_real_escape_string($con, $_POST['message']);

        $sql = "INSERT INTO details (fullname, email, phone, address, message)
            VALUES ('$fullname', '$email', '$phone', '$address', '$message')";

        if (mysqli_query($con, $sql)) {
            $success = "Your message has been sent successfully!";
        } else {
            $error = "Error saving details: " . mysqli_error($con);
        }
    }
    ?>

    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                        <div class="card-body">

                            <div class="text-center mb-4">
                                <h2 class="fw-bold text-success">Get in Touch</h2>
                                <p class="text-muted mt-2">We’d love to hear from you. Please fill out the form below.</p>
                            </div>

                            <?php if (isset($success)) { ?>
                                <div class="alert alert-success text-center"><?php echo $success; ?></div>
                            <?php } elseif (isset($error)) { ?>
                                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                            <?php } ?>

                            <?php

                            use PHPMailer\PHPMailer\PHPMailer;
                            use PHPMailer\PHPMailer\Exception;

                            require 'vendor/autoload.php';

                            if (isset($_POST['submit'])) {

                                $name = $_POST['fullname'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $address = $_POST['address'];
                                $message = $_POST['message'];

                                $mail = new PHPMailer(true);

                                try {
                                    // SMTP settings
                                    $mail->isSMTP();
                                    $mail->Host       = 'smtp.gmail.com';
                                    $mail->SMTPAuth   = true;
                                    $mail->Username   = 'sonasharma42003@gmail.com';
                                    $mail->Password   = 'eouj lacb grhd raib'; // App password
                                    $mail->SMTPSecure = 'tls';
                                    $mail->Port       = 587;

                                    // Sender and Receiver
                                    $mail->setFrom($email, $name);
                                    $mail->addAddress('sonasharma42003@gmail.com', 'JobFinder Admin');

                                    // Email content
                                    $mail->isHTML(true);
                                    $mail->Subject = "New Contact Message from $name";

                                    $mail->Body = "
                                      <h2>Contact Form Details</h2>
                                      <p><b>Name:</b> $name</p>
                                      <p><b>Email:</b> $email</p>
                                      <p><b>Phone:</b> $phone</p>
                                      <p><b>Address:</b> $address</p>
                                      <p><b>Message:</b><br>$message</p>
                                       ";

                                    $mail->send();

                                    echo "<script>alert('Your message has been sent successfully!');</script>";
                                } catch (Exception $e) {
                                    echo "<script>alert('Message failed to send. Error: {$mail->ErrorInfo}');</script>";
                                }
                            }

                            ?>

                            <form method="POST" action="">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Full Name</label>
                                        <input type="text" class="form-control form-control-lg rounded-3" name="fullname" placeholder="Enter your name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email Address</label>
                                        <input type="email" class="form-control form-control-lg rounded-3" name="email" placeholder="Enter your email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Phone</label>
                                        <input type="text" class="form-control form-control-lg rounded-3" name="phone" placeholder="Enter your phone" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Address</label>
                                        <input type="text" class="form-control form-control-lg rounded-3" name="address" placeholder="Enter your address" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Message</label>
                                        <textarea class="form-control form-control-lg rounded-3" rows="4" name="message" placeholder="Say hello to us..." required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg px-5 py-2 fw-semibold rounded-3">
                                        Send Message
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 col-md-12">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="card-body">
                            <h3 class="fw-bold text-success mb-4">Contact Info</h3>

                            <div class="mb-3">
                                <h6 class="text-muted">Address</h6>
                                <p class="text-muted mb-0">203 Fake St. Agrico, <br> Jamshedpur, Jharkhand, INDIA</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted">Phone</h6>
                                <a href="tel:+1233417211" class="text-success text-decoration-none">+1 233 417 211</a>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-muted">Email</h6>
                                <a href="mailto:jobfinder@email.com" class="text-success text-decoration-none">jobfinder@email.com</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h3 class="fw-bold text-success mb-4">More Info</h3>
                            <p class="text-muted">
                                This is why having a great “Contact Us”.<br>
                                The majority of customers today say that quick issue resolution is the most important factor in a positive customer experience. That makes a Contact Us page one of the most valuable pages on a website. <br>
                                Despite this, I was surprised to learn that many companies don’t take the time to build a cohesive and easy-to-navigate Contact Us page. So, I’m going to review the elements and features of an effective Contact Us page so you have best practices at your fingertips as you build your web form. <br>
                            </p>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-outline-success fw-semibold" data-bs-toggle="modal" data-bs-target="#jobModal">
                                Learn More
                            </button>
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
        </div>
    </section>

    <section class="container my-5">
        <div class="row text-center g-4">

            <div class="col-md-4">
                <div class="info-card p-4 rounded-4 h-100">
                    <i class="fa-solid fa-location-dot info-icon"></i>
                    <h4 class="fw-semibold mt-2">Location</h4>
                    <p class="text-muted mt-3 mb-1">New York - 2398</p>
                    <p class="text-muted">10 Hadson Carl Street</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card p-4 rounded-4 h-100">
                    <i class="fa-solid fa-clock info-icon"></i>
                    <h4 class="fw-semibold mt-2">Service Times</h4>
                    <p class="text-muted mt-3 mb-1">Wednesdays — 6:30PM to 7:30PM</p>
                    <p class="text-muted mb-1">Fridays — Sunset to 7:30PM</p>
                    <p class="text-muted">Saturdays — 8:00AM to Sunset</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card p-4 rounded-4 h-100">
                    <i class="fa-solid fa-message info-icon"></i>
                    <h4 class="fw-semibold mt-2">Get in Touch</h4>
                    <p class="text-muted mt-3 mb-1">info@yoursite.com</p>
                    <p class="text-muted">Phone: (123) 3240-345-9348</p>
                    <button class="btn btn-outline-success btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#aboutModal">
                        About Us
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header bg-success text-white rounded-top-4">
                        <h5 class="modal-title" id="aboutModalLabel">About Our Company</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Our company is dedicated to connecting talented individuals with meaningful career opportunities.
                            Guided by innovation, integrity, and inclusivity, we aim to deliver exceptional hiring experiences
                            for both employers and job seekers.
                        </p>
                        <p>
                            With years of industry expertise, we continue to evolve and adapt to the fast-changing job market,
                            ensuring sustainable growth and success for all.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
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