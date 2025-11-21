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
    background-color: #28a745cc; /* slightly lighter/transparent */
    color: #fff;
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
    color: #19692c; /* darker green */
}

/* Checkbox hover effect */
.form-check-input:hover {
    cursor: pointer;
}

/* Optional: modal content hover lift if you add modals here */
.modal-content {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.modal-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
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

            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav mb-2 ms-auto mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary hover-success" href="for_candidates.php">FOR CANDIDATES</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary hover-success" href="for_employees.php">FOR EMPLOYEES</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary hover-success" href="contact.php">CONTACT</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="applyforjob.php" class="nav-link fw-bold text-secondary hover-success">APPLY</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-bold text-secondary hover-success" href="login_process.php">LOGIN</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link active text-dark fw-bold text-secondary hover-success" href="register_process.php">SIGN UP</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="text-white text-center" style="background-image: url('images/sona.png'); 
         background-size: cover; background-position: center; min-height: 28rem; display: flex; align-items: center;">
        <div class="container align-items-center">
            <h1 class="fw-light" style="font-size: 3rem;">Sign Up</h1>
            <a href="index.php" class="text-decoration-none text-success bg-light fs-5"> Home </a><span
                class="text-dark bg-light fs-5"> > Sign Up</span>
        </div>
    </section>

    <?php
    include 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $con->prepare("INSERT INTO tbl_users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Account created successfully! Please login now.'); window.location='login_process.php';</script>";
        } else {
            echo "<script>alert('Error saving details!');</script>";
        }

        $stmt->close();
    }
    ?>

    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold text-success">Create an Account</h2>
                                <p class="text-muted mt-2">Join us and start your journey today!</p>
                            </div>

                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control form-control-lg rounded-3"
                                        name="name" placeholder="Enter your full name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control form-control-lg rounded-3"
                                        name="email" placeholder="Enter your email" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-3"
                                        name="password" placeholder="Create a password" required>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label text-muted" for="terms">
                                        I agree to the <a href="#" class="text-success text-decoration-none fw-semibold">Terms & Conditions</a>
                                    </label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg rounded-3 fw-semibold">
                                        Register
                                    </button>
                                </div>
                            </form>

                            <div class="text-center mt-4">
                                <p class="text-muted mb-0">
                                    Already have an account?
                                    <a href="login_process.php" class="text-success fw-semibold text-decoration-none">Login here</a>
                                </p>
                            </div>
                        </div>
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