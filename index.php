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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

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

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 128, 0, 0.15);
        border-color: #ffffffff !important;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);
        transition: all 0.3s ease;
    }

    .company-logo {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        border-radius: 10px;
    }

    .company-logo:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
    .feature-card {
        background: linear-gradient(145deg, #ffffff, #f6fbff);
        border-radius: 18px;
        border: 1px solid #e6eef3;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.35s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
    }

    .feature-icon {
        font-size: 72px;
        color: #19a463;
        margin-bottom: 20px;
        transition: transform 0.4s ease, text-shadow 0.4s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1);
        text-shadow: 0px 0px 12px rgba(25, 164, 99, 0.4);
    }

    .feature-link {
        text-decoration: none;
        color: #19a463;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .feature-link:hover {
        color: #0f7446;
    }
</style>
<style>
    .company-box {
        padding: 18px;
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e7edf1;
        transition: all 0.35s ease;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeUp 0.6s forwards;
    }

    .company-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        border-color: #19a463;
    }

    .company-logo {
        transition: transform 0.35s ease;
        border-radius: 10px;
        max-height: 80px;
        object-fit: contain;
    }

    .company-box:hover .company-logo {
        transform: scale(1.12);
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<style>
    .image-wrapper {
        max-width: 900px;
        overflow: hidden;
        border-radius: 18px;
        box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.12);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        cursor: pointer;
    }

    .custom-img {
        width: 100%;
        height: auto;
        border-radius: 18px;
        transition: transform 0.55s ease, filter 0.4s ease;
    }

    .image-wrapper:hover {
        transform: translateY(-8px);
        box-shadow: 0px 12px 28px rgba(0, 0, 0, 0.18);
    }

    .image-wrapper:hover .custom-img {
        transform: scale(1.1);
        filter: brightness(1.1) saturate(1.1);
    }
</style>


<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
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
                        <a class="nav-link fw-bold text-secondary hover-success" href="register_process.php">SIGN UP</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <body>

        <section class="text-white text-center"
            style="background-image: url('https://img.freepik.com/free-photo/flat-lay-work-desktop-with-notebook-keyboard_23-2148397831.jpg?semt=ais_hybrid&w=740&q=80'); 
            background-size: cover; background-position: center; min-height: 46rem; display: flex; align-items: center;">

            <div class="container">
                <h1 class="mb-4 text-start">Find Job</h1>
                <form id="jobSearchForm">
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-4">
                            <input type="text" class="form-control p-3" id="job_title" name="job_title"
                                placeholder="job title, keywords or company name" required autocomplete="off">
                            <div id="suggestions"
                                class="list-group position-absolute w-100"
                                style="z-index:1000;">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control p-3" id="location" name="location"
                                placeholder="city, province or region">
                        </div>

                        <div class="col-md-4">
                            <input type="submit" class="btn btn-success p-3 w-100" value="Search">
                        </div>
                    </div>
                </form>
                <div class="mt-4 text-start">
                    <p class="small">or browse by category:
                        <a href="for_candidates.php" class="fw-bold text-white text-decoration-none ms-2">Category #1</a>
                        <a href="for_employees.php" class="fw-bold text-white text-decoration-none ms-2">Category #2</a>
                    </p>
                </div>
            </div>
        </section>

        <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="jobModalLabel">Job Search Results</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="jobResults">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            $(document).ready(function() {

                $('#job_title').keyup(function() {
                    var job_title = $(this).val();
                    if (job_title.length > 1) {
                        $.ajax({
                            url: 'fetch_location.php',
                            type: 'POST',
                            data: {
                                job_title: job_title
                            },
                            success: function(data) {
                                $('#suggestions').html(data);
                            }
                        });
                    } else {
                        $('#suggestions').html('');
                    }
                });

                $(document).on('click', '.suggest-item', function() {
                    var jobTitle = $(this).data('title');
                    var jobLocation = $(this).data('location');
                    $('#job_title').val(jobTitle);
                    $('#location').val(jobLocation);
                    $('#suggestions').html('');
                });

                $('#jobSearchForm').on('submit', function(e) {
                    e.preventDefault();
                    var job_title = $('#job_title').val();
                    var location = $('#location').val();

                    $.ajax({
                        url: 'search_job.php',
                        type: 'POST',
                        data: {
                            job_title: job_title,
                            location: location
                        },
                        success: function(response) {
                            $('#jobResults').html(response);
                            var modal = new bootstrap.Modal(document.getElementById('jobModal'));
                            modal.show();
                        }
                    });
                });

            });
        </script>

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
                    <div class="col-md-3 col-sm-6 mt-5">
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
                                    <div class="col-2 text-center">
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

        <section class="container mt-5 mb-3">
            <div class="row">
                <div class="col-md-7 col-sm-12 mb-4 mb-md-0">
                    <div class="ratio ratio-16x9">
                        <video
                            src="https://www.pexels.com/download/video/4065924/"
                            autoplay
                            controls
                            loop
                            muted
                            poster="download.jpg"
                            style="border-radius: 10px; overflow: hidden; display: block; width: 100%; height: auto;">
                        </video>

                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <h1 class="fw-light mt-4">Testimonies</h1>
                    <div class="bg-success" style="width:150px; height:2px;"></div>
                    <div class="bg-success mt-1" style="width:100px; height:2px;"></div>
                    <p class="mt-4 fs-4" style="font-style: italic;">“Customer endorsements of a product or service, used to build trust and social proof for potential customers. They can be presented as quotes, videos, case studies, or aggregated reviews..”</p>
                    <p><span class="fw-bold fs-5">— John Holmes</span><span class="text-muted fs-5">, Marketing
                     Strategist</span></p>
                </div>
            </div>
        </section>

        <section class="text-white text-center" style="background-image: url('https://plus.unsplash.com/premium_photo-1665203621843-4edd0f5bf080?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OTd8fGpvYnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=900'); 
        background-size: cover; background-position: center; height: 40rem; display: flex; align-items: center;">
            <div class="container align-items-center">
                <h1 class="fw-light" style="font-size: 5rem;">Your Dream Job</h1>
                <h1 class="fw-light mt-3">Is Waiting For You</h1>
                <div class="mt-5">
                    <a href="index.php" class="btn btn-warning px-3">Find Jobs</a>
                </div>
            </div>
        </section>

        <section class="mt-5 mb-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h1 class="fw-light">Why Choose Us</h1>
                    <div class="mx-auto bg-success" style="width:200px; height:2px;"></div>
                    <div class="mx-auto bg-success mt-1" style="width:140px; height:2px;"></div>
                    <p class="text-muted mt-3 fs-5">
                        Discover why thousands of users trust our platform every day.
                    </p>
                </div>

                <div class="row g-4 mt-5 mb-5">
                    <div class="col-md-6">
                        <div class="feature-card p-4 text-center h-100">
                            <i class="fa-solid fa-briefcase feature-icon"></i>
                            <h3 class="fw-semibold mb-3">More Jobs Every Day</h3>
                            <p class="text-muted fs-6 mb-4">
                                Access hundreds of new job postings daily across multiple industries.
                                Find your perfect fit faster than ever before.
                            </p>
                            <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#modalJobs">
                                Read More →
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="feature-card p-4 text-center h-100">
                            <i class="fa-solid fa-stethoscope feature-icon"></i>
                            <h3 class="fw-semibold mb-3">Healthcare</h3>
                            <p class="text-muted fs-6 mb-4">
                                Connect with top hospitals, clinics, and health professionals offering exciting opportunities.
                            </p>
                            <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#modalHealthcare">
                                Read More →
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="feature-card p-4 text-center h-100">
                            <i class="fa-solid fa-laptop-code feature-icon"></i>
                            <h3 class="fw-semibold mb-3">Information Technology</h3>
                            <p class="text-muted fs-6 mb-4">
                                Stay ahead with IT jobs from startups to global tech leaders. Explore roles in development, AI, and more.
                            </p>
                            <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#modalIT">
                                Read More →
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="feature-card p-4 text-center h-100">
                            <i class="fa-solid fa-lightbulb feature-icon"></i>
                            <h3 class="fw-semibold mb-3">Creative Jobs</h3>
                            <p class="text-muted fs-6 mb-4">
                                Find design, content, and media opportunities that bring your creativity to life.
                            </p>
                            <a href="#" class="feature-link" data-bs-toggle="modal" data-bs-target="#modalCreative">
                                Read More →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="modalJobs" tabindex="-1" aria-labelledby="modalJobsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalJobsLabel">More Jobs Every Day</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        We post new job opportunities daily across multiple industries. Stay updated with the latest openings and grow your career with us.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalHealthcare" tabindex="-1" aria-labelledby="modalHealthcareLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalHealthcareLabel">Healthcare</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Find top healthcare jobs including nursing, medical assistants, and hospital administration positions from trusted employers.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalIT" tabindex="-1" aria-labelledby="modalITLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalITLabel">Information Technology</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Explore IT career options including software development, web design, networking, and data analysis jobs with leading companies.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCreative" tabindex="-1" aria-labelledby="modalCreativeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalCreativeLabel">Creative Jobs</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Discover jobs in design, marketing, writing, and multimedia — perfect for those who love innovation and creativity.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <?php
        include 'connection.php';
        $result = mysqli_query($con, "SELECT * FROM blogs ORDER BY id DESC LIMIT 3");
        ?>

        <section class="container mt-5 mb-5">
            <div class="text-center">
                <h1 class="fw-light">Recent Blog</h1>
                <div class="mx-auto bg-success" style="width:150px; height:2px;"></div>
                <div class="mx-auto bg-success mt-1" style="width:100px; height:2px;"></div>
                <p class="text-muted mt-3 fs-5">
                    Discover why thousands of users trust our platform every day.
                </p>
            </div>

            <div class="row mt-5">
                <?php while ($b = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0">
                            <img src="<?php echo $b['image']; ?>" class="img-fluid" alt="">
                            <div class="card-body">
                                <h4 class="mt-3"><?php echo $b['title']; ?></h4>
                                <p class="text-muted mb-2">
                                    <?php echo date('F d, Y', strtotime($b['date'])); ?> • By <span class="text-success"><?php echo $b['author']; ?></span>
                                </p>
                                <p class="fs-5">
                                    <?php echo substr($b['description'], 0, 100) . '...'; ?>
                                    <a href="blog_details.php?id=<?php echo $b['id']; ?>">Read more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section class="container py-5 text-center">
            <h1 class="fw-light">Innovative Solutions</h1>
            <div class="mx-auto bg-success" style="width:240px; height:2px; border-radius:50px;"></div>
            <div class="mx-auto bg-success mt-1" style="width:160px; height:2px; border-radius:50px;"></div>
            <p class="text-muted fs-5 mt-3">
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac <br> turpis egestas.
                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.
            </p>

            <h3 class="text-success fw-semibold mt-3">Start Your Journey</h3>

            <div class="image-wrapper mt-5 mx-auto">
                <img class="img-fluid rounded custom-img"
                    src="https://bootstrapmade.com/content/demo/Nexa/assets/img/about/about-15.webp"
                    alt="Business Image">
            </div>
        </section>

        <?php
        include 'connection.php';
        $query = mysqli_query($con, "SELECT * FROM company_logos ORDER BY id DESC");
        ?>

        <section class="container my-5">
            <div class="text-center mb-5">
                <h1 class="fw-light text-dark">Top Companies</h1>
                <div class="mx-auto bg-success" style="width:180px; height:2px; border-radius:50px;"></div>
                <div class="mx-auto bg-success mt-1" style="width:100px; height:2px; border-radius:50px;"></div>
                <p class="text-muted mt-3 fs-5">Partnered with leading career-driven enterprises worldwide</p>
            </div>

            <div class="row g-4 justify-content-center text-center mt-5">
                <?php
                $delay = 0;
                while ($row = mysqli_fetch_assoc($query)) {
                    $delay += 0.10; // small stagger animation
                ?>
                    <div class="col-6 col-md-4 col-lg-2" style="animation-delay: <?= $delay ?>s;">
                        <a href="<?php echo $row['company_link']; ?>" target="_blank" class="text-decoration-none text-dark">
                            <div class="company-box">
                                <img src="<?php echo $row['logo_path']; ?>"
                                    alt="<?php echo $row['company_name']; ?>"
                                    class="img-fluid company-logo mb-2">
                                <p class="text-muted fw-medium small mb-0"><?php echo $row['company_name']; ?></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
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