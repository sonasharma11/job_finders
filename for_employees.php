<?php
include 'connection.php';

$query = mysqli_query($con, "SELECT * FROM job WHERE status = 'active'");
$job = mysqli_fetch_array($query);

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

    .card {
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card:hover h5 {
        color: #198754;
    }

    .card:hover .btn-outline-success {
        background-color: #198754;
        color: #fff;
        border-color: #198754;
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
    .step-card {
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        cursor: pointer;
    }

    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.10);
    }

    .step-img {
        width: 120px;
        transition: transform 0.4s ease;
    }

    .step-card:hover .step-img {
        transform: scale(1.08);
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
                        <a class="nav-link active text-dark fw-bold text-secondary hover-success" href="for_employees.php">FOR EMPLOYEES</a>
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
                        <a class="nav-link fw-bold text-secondary hover-success" href="register_process.php">SIGN UP</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="text-white text-center" style="background-image: url('images/woman-drawing-new-design.jpg'); 
         background-size: cover; background-position: center; min-height: 28rem; display: flex; align-items: center;">
        <div class="container align-items-center">
            <h1 class="fw-light" style="font-size: 3rem;">Employees</h1>
            <a href="index.php" class="text-decoration-none text-success bg-light fs-5"> Home </a><span
                class="text-dark bg-light fs-5"> > Employees</span>
        </div>
    </section>

    <section style="background-color: #f6fbffff;">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mt-5">
                    <h1 class="mt-5 mb-5 fw-light text-center text-md-start">Recent Jobs</h1>

                    <?php while ($row = mysqli_fetch_array($query)) {
                        $jobId = $row['id'];
                    ?>
                        <div class="card shadow-sm mb-3 p-3">
                            <div class="row g-2 align-items-center">

                                <!-- Icon -->
                                <div class="col-2">
                                    <i class="fa-solid fa-briefcase fs-1 text-success"></i>
                                </div>

                                <!-- Job details -->
                                <div class="col-12 col-sm-8 col-md-8">
                                    <h5 class="fw-light mt-2"><?= htmlspecialchars($row['job_title']); ?></h5>
                                    <div class="d-flex flex-column flex-md-row flex-wrap gap-2 small">
                                        <p class="mb-0"><i class="fa-solid fa-suitcase text-secondary"></i> <?= htmlspecialchars($row['company']); ?></p>
                                        <p class="mb-0"><i class="fa-solid fa-location-dot text-secondary"></i> <?= htmlspecialchars($row['location']); ?></p>
                                        <p class="mb-0"><i class="fa-solid fa-money-check-dollar text-secondary"></i> <?= htmlspecialchars($row['job_description']); ?></p>
                                    </div>
                                </div>

                                <!-- View button -->
                                <div class="col-12 col-sm-2 col-md-2">
                                    <button type="button" class="btn btn-outline-success btn-sm w-100" data-bs-toggle="modal" data-bs-target="#jobModal<?= $jobId; ?>">
                                        <i class="fa-solid fa-eye me-2"></i>View
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Section -->
                        <div class="modal fade" id="jobModal<?= $jobId; ?>" tabindex="-1" aria-labelledby="jobModalLabel<?= $jobId; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
                                <div class="modal-content">

                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title fw-bold"><?= htmlspecialchars($row['job_title']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <p><strong><i class="fa-solid fa-building me-2"></i>Company:</strong> <?= htmlspecialchars($row['company']); ?></p>
                                            <p><strong><i class="fa-solid fa-location-dot me-2"></i>Location:</strong> <?= htmlspecialchars($row['location']); ?></p>
                                            <p><strong><i class="fa-solid fa-briefcase me-2"></i>Job Type:</strong> <?= htmlspecialchars($row['job_type'] ?? 'N/A'); ?></p>
                                            <p><strong><i class="fa-solid fa-money-bill me-2"></i>Salary:</strong> <?= htmlspecialchars($row['salary'] ?? 'N/A'); ?></p>
                                        </div>

                                        <hr>
                                        <h6 class="fw-bold text-success">Job Description:</h6>
                                        <p class="text-secondary"><?= nl2br(htmlspecialchars($row['job_description'])); ?></p>

                                    </div>

                                    <div class="modal-footer flex-wrap gap-2">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="applyforjob.php?job_position=<?= urlencode($row['job_title']); ?>" class="btn btn-success">
                                            <i class="fa-solid fa-paper-plane"></i> Apply Now
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


                <div class="col-md-5 mt-5 mb-5">
                    <h1 class="mt-5 mb-5 fw-light">Featured Jobs</h1>
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="card shadow-sm p-4">
                                <h3 class="fw-light mt-4">Data Scientist</h3>
                                <ul class="list-unstyled text-secondary mb-4">
                                    <li><i class="fa-solid fa-suitcase me-2"></i> Microsoft</li>
                                    <li><i class="fa-solid fa-location-dot me-2"></i> New York</li>
                                    <li><i class="fa-solid fa-money-check-dollar me-2"></i> $95k — 500k</li>
                                </ul>
                                <div>
                                    <img class="mt-4" src="images/image/microsoft.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card shadow-sm p-4">
                                <h3 class="fw-light mt-4">Data Analytics</h3>
                                <ul class="list-unstyled text-secondary mb-4">
                                    <li><i class="fa-solid fa-suitcase me-2"></i> Google</li>
                                    <li><i class="fa-solid fa-location-dot me-2"></i> Bangalore</li>
                                    <li><i class="fa-solid fa-money-check-dollar me-2"></i> $85k — 200k</li>
                                </ul>
                                <div>
                                    <img class="mt-4" src="https://images.unsplash.com/photo-1678483789111-3a04c4628bd6?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fGdvb2dsZSUyMGxvZ298ZW58MHx8MHx8fDA%3D&fm=jpg&q=60&w=3000" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card shadow-sm p-4">
                                <h3 class="fw-light mt-4">Software Developer</h3>
                                <ul class="list-unstyled text-secondary mb-4">
                                    <li><i class="fa-solid fa-suitcase me-2"></i> Apple</li>
                                    <li><i class="fa-solid fa-location-dot me-2"></i> Pune</li>
                                    <li><i class="fa-solid fa-money-check-dollar me-2"></i> $100k — 700k</li>
                                </ul>
                                <div>
                                    <img class="mt-4" src="images/image/appple.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card shadow-sm p-4">
                                <h3 class="fw-light mt-4">FullStack Developer</h3>
                                <ul class="list-unstyled text-secondary mb-4">
                                    <li><i class="fa-solid fa-suitcase me-2"></i> IBM</li>
                                    <li><i class="fa-solid fa-location-dot me-2"></i> Kolkata</li>
                                    <li><i class="fa-solid fa-money-check-dollar me-2"></i> $85k — 200k</li>
                                </ul>
                                <div>
                                    <img class="mt-4" src="images/image/ibm.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card shadow-sm p-4">
                                <h3 class="fw-light mt-4">App Developer</h3>
                                <ul class="list-unstyled text-secondary mb-4">
                                    <li><i class="fa-solid fa-suitcase me-2"></i> Meta</li>
                                    <li><i class="fa-solid fa-location-dot me-2"></i> Delhi</li>
                                    <li><i class="fa-solid fa-money-check-dollar me-2"></i> $85k — 200k</li>
                                </ul>
                                <div>
                                    <img class="mt-4" src="images/image/meta.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card shadow-sm p-4">
                                <h3 class="fw-light mt-4">AI/ML</h3>
                                <ul class="list-unstyled text-secondary mb-4">
                                    <li><i class="fa-solid fa-suitcase me-2"></i> TCS</li>
                                    <li><i class="fa-solid fa-location-dot me-2"></i> Gurgaon</li>
                                    <li><i class="fa-solid fa-money-check-dollar me-2"></i> $85k — 200k</li>
                                </ul>
                                <div>
                                    <img class="mt-4" src="images/image/tcss.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="p-5" style="background: linear-gradient(135deg, #f6fbff 0%, #eef7ff 100%);">
        <div class="container text-center">
            <h1 class="fw-light mb-2" style="font-size: 2.2rem; color:#0a2b4f;">Get started in 3 easy steps</h1>
            <div class="mx-auto bg-success" style="width:250px; height:2px; border-radius:5px;"></div>
            <div class="mx-auto bg-success mt-1" style="width:150px; height:2px; border-radius:5px;"></div>
            <p class="text-muted mt-3 fs-5">
                Discover why thousands of users trust our platform every day.
            </p>
        </div>

        <div class="row justify-content-center g-4 mt-5">

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="step-card card border-0 shadow-sm h-100 bg-white text-dark rounded-4 p-4 text-center">
                    <img src="https://resources.workindia.in/employer/assets/illustrations/landing/post-a-job.svg"
                        alt="Post a Job" class="mx-auto mb-3 img-fluid step-img" />
                    <h4 class="fw-semibold text-dark">Post a Job</h4>
                    <p class="text-muted px-2">Tell us what you need in a candidate in just 5 minutes.</p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="step-card card border-0 shadow-sm h-100 bg-white text-dark rounded-4 p-4 text-center">
                    <img src="https://resources.workindia.in/employer/assets/illustrations/landing/get-verified.svg"
                        alt="Get Verified" class="mx-auto mb-3 img-fluid step-img" />
                    <h4 class="fw-semibold text-dark">Get Verified</h4>
                    <p class="text-muted px-2">Our team will call to verify your employer account.</p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="step-card card border-0 shadow-sm h-100 bg-white text-dark rounded-4 p-4 text-center">
                    <img src="https://resources.workindia.in/employer/assets/illustrations/landing/get-calls-hire.svg"
                        alt="Get Calls. Hire." class="mx-auto mb-3 img-fluid step-img" />
                    <h4 class="fw-semibold text-dark">Get mails. Hire.</h4>
                    <p class="text-muted px-2">You’ll get calls from relevant candidates within one hour.</p>
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

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 1000,
                margin: 15,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    992: {
                        items: 1
                    }
                }
            });
        });
    </script>

</body>

</html>