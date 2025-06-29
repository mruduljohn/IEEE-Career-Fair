<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IEEE Career Fair - Demo</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        /* Import theme styles */
        <?php 
        if (file_exists('style.css')) {
            echo file_get_contents('style.css');
        } else {
            // Fallback basic styles
            echo "
            body { 
                font-family: 'Open Sans', sans-serif; 
                margin: 0; 
                padding: 0; 
            }
            .hero-section { 
                background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('./assets/images/background/category-bg.jpg');
                background-size: cover;
                background-position: center;
                min-height: 100vh;
                display: flex;
                align-items: center;
                color: white;
                text-align: center;
                padding-top: 80px;
            }
            .cta-button {
                background: #ffb700;
                border: none;
                border-radius: 50px;
                color: #000;
                font-weight: 600;
                padding: 15px 30px;
                text-decoration: none;
                transition: all 0.3s ease;
                margin: 0 10px;
                display: inline-block;
            }
            .cta-button:hover {
                background: #e6a300;
                transform: translateY(-2px);
            }
            ";
        }
        ?>
    </style>
</head>
<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./assets/images/ieee-logo.png" alt="IEEE" class="ieee-logo me-2" style="max-height: 50px;">
                <span class="fw-bold text-primary d-none d-md-inline">IEEE Career Fair</span>
            </a>
            
            <div class="ms-auto">
                <a href="#register" class="btn btn-warning btn-sm fw-bold">
                    <i class="fas fa-user-plus me-1"></i>
                    Register Now
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="hero">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                        IEEE Career Fair: Your Gateway to Opportunity
                    </h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
                        Connect with top employers, explore exciting career opportunities, and take your professional journey to the next level at IEEE Career Fair - the premier destination for technology and engineering professionals.
                    </p>
                    <div class="hero-buttons mt-4" data-aos="fade-up" data-aos-delay="300">
                        <a href="#events" class="cta-button me-3">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Explore Career Fair
                        </a>
                        <a href="#register" class="cta-button" style="background: transparent; border: 2px solid #fff; color: #fff;">
                            <i class="fas fa-user-graduate me-2"></i>
                            Register as Student
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section bg-light py-5" id="partners">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title mb-3" data-aos="fade-up">Our Partners</h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-delay="100">
                        Collaborating with leading organizations worldwide
                    </p>
                </div>
            </div>
            
            <div class="row align-items-center justify-content-center g-4">
                <?php
                $partners = [
                    ['name' => 'IEEE', 'logo' => 'ieee-logo.png'],
                    ['name' => 'IEEE Technical Activities', 'logo' => 'ieee-ta.png'],
                    ['name' => 'IEEE Industry Engagement Committee', 'logo' => 'iec.png'],
                    ['name' => 'IEEE Students', 'logo' => 'students.png'],
                    ['name' => 'IEEE Young Professionals', 'logo' => 'yp.png'],
                    ['name' => 'IEEE Region 10', 'logo' => 'r10.png'],
                    ['name' => 'IEEE Region 8', 'logo' => 'r8.png'],
                    ['name' => 'IEEE YP Region 10', 'logo' => 'yp-r10.png']
                ];
                
                foreach ($partners as $index => $partner) {
                    $delay = 100 + ($index * 50);
                    echo "<div class='col-6 col-md-4 col-lg-3 text-center' data-aos='fade-up' data-aos-delay='{$delay}'>
                            <div class='partner-logo-container'>
                                <img src='./assets/images/logo/{$partner['logo']}' 
                                     alt='{$partner['name']}' 
                                     class='img-fluid'
                                     style='max-height: 80px; filter: grayscale(100%); transition: filter 0.3s ease;'
                                     onmouseover=\"this.style.filter='grayscale(0%)'\"
                                     onmouseout=\"this.style.filter='grayscale(100%)'\">
                            </div>
                          </div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section bg-primary text-white py-5" id="stats">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 mb-5">
                    <h2 class="text-white mb-4" data-aos="fade-up">
                        Empowering the Next Generation of Innovators
                    </h2>
                    <p class="text-light lead" data-aos="fade-up" data-aos-delay="100">
                        IEEE Career Fair connects global talent with industry leaders, fostering innovation and career growth.
                    </p>
                </div>
            </div>
            
            <div class="row g-4 text-center">
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-number h1 fw-bold text-warning" data-target="50000">50,000+</div>
                        <div class="stat-label">IEEE Members Worldwide</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-number h1 fw-bold text-warning" data-target="160">160+</div>
                        <div class="stat-label">Countries Represented</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-number h1 fw-bold text-warning" data-target="100">100+</div>
                        <div class="stat-label">Partner Companies</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-number h1 fw-bold text-warning" data-target="95">95%</div>
                        <div class="stat-label">Success Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Notice -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading"><i class="fas fa-info-circle"></i> Demo Version</h4>
                <p>This is a demonstration of the IEEE Career Fair WordPress theme. This theme includes:</p>
                <ul class="list-unstyled">
                    <li>✅ Full WordPress theme with admin interface</li>
                    <li>✅ Custom post types for events and partners</li>
                    <li>✅ Responsive design for all devices</li>
                    <li>✅ Easy content management for non-technical users</li>
                    <li>✅ SEO optimized and performance focused</li>
                </ul>
                <hr>
                <p class="mb-0">
                    <strong>For WordPress Installation:</strong> 
                    <a href="./README.md" class="btn btn-outline-primary btn-sm ms-2">View Installation Guide</a>
                    <a href="https://github.com/your-username/ieee-career-fair-theme" class="btn btn-primary btn-sm ms-2">Download Theme</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 IEEE Career Fair. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Powered by <strong>WordPress</strong></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offset = 80;
                    const targetPosition = target.offsetTop - offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

</body>
</html> 