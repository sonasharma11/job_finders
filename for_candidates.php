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

    .category-card {
        background-color: #f8f9fa;
        border-radius: 1rem;
        transition: all 0.3s ease-in-out;
    }

    .category-card:hover {
        background-color: #ffffff;
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 117, 45, 0.15);
    }

    .category-card i {
        transition: transform 0.3s ease-in-out;
    }

    .category-card:hover i {
        transform: scale(1.1);
    }

    .category-card h6 {
        color: #333;
    }
</style>
<style>
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

    /* Modal Styles */
    .modal-content {
        border-radius: 24px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        border-bottom: 1px solid #e2e8f0;
        padding: 1.5rem 2rem;
    }

    .modal-title {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border-top: 1px solid #e2e8f0;
        padding: 1.5rem 2rem;
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

        .contact-card {
            margin: 1rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .btn-send {
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        .feature-card {
            margin-bottom: 1.5rem;
        }
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
                        <a class="nav-link active text-dark fw-bold text-secondary hover-success" href="for_candidates.php">FOR CANDIDATES</a>
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
                        <a class="nav-link fw-bold text-secondary hover-success" href="register_process.php">SIGN UP</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="text-white text-center" style="background-image: url('images/woman-drawing-new-design.jpg'); 
         background-size: cover; background-position: center; min-height: 28rem; display: flex; align-items: center;">
        <div class="container align-items-center">
            <h1 class="fw-light" style="font-size: rem;">Categories / Candidates</h1>
            <a href="index.php" class="text-decoration-none text-success bg-light fs-5"> Home </a><span
                class="text-dark bg-light fs-5"> > Categories</span>
        </div>
    </section>

    <section class="container my-5">
        <div class="text-center my-4 mt-5">
            <h1 class="fw-light">Popular Categories</h1>
            <div class="mx-auto bg-success" style="width:200px; height:2px;"></div>
            <div class="mx-auto bg-success mt-1" style="width:150px; height:2px;"></div>
        </div>

        <div class="row mt-5 g-4">
            <?php
            include 'connection.php';
            $result = mysqli_query($con, "SELECT * FROM popular_categories");
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card category-card h-100 text-center border- shadow-sm" style="background-color: #f6fbffff;">
                        <div class="card-body">
                            <i class="<?= $row['icon'] ?> fs-1 mb-4 mt-2 text-success"></i>
                            <h6 class="fw-semibold mb-3 mt-2"><?= $row['category_name'] ?></h6>
                            <button class="btn btn-outline-success btn-sm px-4 mb-2"><?= $row['job_count'] ?></button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h1 class="fw-light mt-4">Creative People</h1>
                <div class="bg-success" style="width:200px; height:2px;"></div>
                <div class="bg-success mt-1" style="width:130px; height:2px;"></div>
                <p class="mt-4 fs-4" style="font-style: italic;">“Creating a "creative" website involves a balance of unique visual flair and excellent user experience (UX). Key strategies involve leveraging unconventional layouts, captivating visuals, and interactive elements while ensuring intuitive navigation..”</p>
                <p><span class="fw-bold fs-5">— John Holmes</span><span class="text-muted fs-5">, Marketing
                        Strategist</span></p>
            </div>
            <div class="col-md-6 col-sm-12 mb-4 mb-md-0">
                <div class="ratio ratio-16x9">
                    <video src="https://www.pexels.com/download/video/3129424/" autoplay controls loop muted
                        poster="download.jpg" style="border-radius: 10px;">
                    </video>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>