<?php
/**
 * The front page template file
 * 
 * This template displays the homepage with all the content sections
 * that can be easily managed by non-technical users through the WordPress admin.
 * 
 * @package IEEE_Career_Fair
 * @version 1.0
 */

get_header(); ?>

<?php
// Get customizer settings with defaults
$hero_title = get_theme_mod('ieee_hero_title', __('IEEE Career Fair: Your Gateway to Opportunity', 'ieee-career-fair'));
$hero_subtitle = get_theme_mod('ieee_hero_subtitle', __('Connect with top employers, explore exciting career opportunities, and take the next step in your professional journey with IEEE Career Fairs.', 'ieee-career-fair'));
$hero_bg = get_theme_mod('ieee_hero_bg', get_template_directory_uri() . '/assets/images/category-bg.jpg');

$primary_cta_text = get_theme_mod('ieee_primary_cta_text', __('Explore Career Fairs', 'ieee-career-fair'));
$primary_cta_url = get_theme_mod('ieee_primary_cta_url', '#');
$secondary_cta_text = get_theme_mod('ieee_secondary_cta_text', __('Register for Events', 'ieee-career-fair'));
$secondary_cta_url = get_theme_mod('ieee_secondary_cta_url', '#');

$partners_title = get_theme_mod('ieee_partners_title', __('Our Partners', 'ieee-career-fair'));
$partners_description = get_theme_mod('ieee_partners_description', __('We collaborate with leading organizations to bring you the best career opportunities.', 'ieee-career-fair'));

$events_title = get_theme_mod('ieee_events_title', __('Explore Upcoming Career Fairs', 'ieee-career-fair'));
$events_description = get_theme_mod('ieee_events_description', __('Find an IEEE career fair near you and connect with potential employers.', 'ieee-career-fair'));
$events_count = get_theme_mod('ieee_events_count', 6);

$faq_title = get_theme_mod('ieee_faq_title', __('What Are IEEE Virtual Career Fairs?', 'ieee-career-fair'));
$faq_content = get_theme_mod('ieee_faq_content', __('IEEE Career Fairs are globally recognized events connecting top employers with talented professionals across engineering, computing, and technology fields...', 'ieee-career-fair'));

$why_title = get_theme_mod('ieee_why_title', __('Why Should Companies Join IEEE Career Fairs?', 'ieee-career-fair'));
$why_content = get_theme_mod('ieee_why_content', __('Partnering with IEEE provides unparalleled access to skilled talent across engineering, computing, and technical fields...', 'ieee-career-fair'));

$primary_color = get_theme_mod('ieee_primary_color', '#00629b');
$secondary_color = get_theme_mod('ieee_secondary_color', '#ffb81c');
?>

<main id="main" class="site-main" role="main">
    
    <!-- Hero Section -->
    <section id="hero" class="hero-section text-light py-5" style="background-image: url('<?php echo esc_url($hero_bg); ?>'); background-size: cover; background-position: center center;">
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-8 py-5">
                    <h1 class="display-4 fw-bold mb-4"><?php echo esc_html($hero_title); ?></h1>
                    <p class="lead mb-4"><?php echo esc_html($hero_subtitle); ?></p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?php echo esc_url($primary_cta_url); ?>" class="btn btn-primary btn-lg"><?php echo esc_html($primary_cta_text); ?></a>
                        <a href="<?php echo esc_url($secondary_cta_url); ?>" class="btn btn-outline-light btn-lg"><?php echo esc_html($secondary_cta_text); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="partners" class="partners-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title"><?php echo esc_html($partners_title); ?></h2>
                <p class="section-description"><?php echo esc_html($partners_description); ?></p>
            </div>
            <div class="row justify-content-center align-items-center">
                <?php
                $partners_args = array(
                    'post_type'      => 'partner',
                    'posts_per_page' => 8,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                );
                
                $partners_query = new WP_Query($partners_args);
                
                if ($partners_query->have_posts()) :
                    while ($partners_query->have_posts()) : $partners_query->the_post();
                        $partner_url = get_post_meta(get_the_ID(), '_ieee_partner_url', true);
                ?>
                    <div class="col-6 col-md-3 col-lg-2 mb-4">
                        <div class="partner-logo text-center">
                            <?php if ($partner_url) : ?>
                                <a href="<?php echo esc_url($partner_url); ?>" target="_blank" rel="noopener">
                            <?php endif; ?>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('partner-logo', array('class' => 'img-fluid', 'alt' => get_the_title())); ?>
                            <?php else : ?>
                                <div class="placeholder-logo p-4 bg-white rounded shadow-sm">
                                    <?php echo esc_html(get_the_title()); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($partner_url) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Display IEEE logos as defaults
                    $default_logos = array(
                        'ieee.png' => 'IEEE',
                        'ieee-ta.png' => 'IEEE Technical Activities',
                        'ieee-students.png' => 'IEEE Students',
                        'ieee-yp.png' => 'IEEE Young Professionals'
                    );
                    
                    foreach ($default_logos as $logo => $name) :
                ?>
                    <div class="col-6 col-md-3 col-lg-2 mb-4">
                        <div class="partner-logo text-center">
                            <a href="https://www.ieee.org" target="_blank" rel="noopener">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/partners/<?php echo esc_attr($logo); ?>" 
                                     alt="<?php echo esc_attr($name); ?>" 
                                     class="img-fluid">
                            </a>
                        </div>
                    </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="about" class="faq-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/career-fair.jpg" 
                         alt="<?php esc_attr_e('IEEE Career Fair Event', 'ieee-career-fair'); ?>" 
                         class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-7">
                    <div class="section-tag"><?php esc_html_e('ABOUT US', 'ieee-career-fair'); ?></div>
                    <h2 class="section-title"><?php echo esc_html($faq_title); ?></h2>
                    <div class="section-content">
                        <?php echo wpautop($faq_content); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Join Section -->
    <section id="why-join" class="why-join-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 order-lg-1 order-2">
                    <div class="section-tag"><?php esc_html_e('FOR EMPLOYERS', 'ieee-career-fair'); ?></div>
                    <h2 class="section-title"><?php echo esc_html($why_title); ?></h2>
                    <div class="section-content">
                        <?php echo wpautop($why_content); ?>
                    </div>
                    
                    <!-- Accordion -->
                    <div class="accordion mt-4" id="benefitsAccordion">
                        <!-- Quality Hiring -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <?php esc_html_e('Quality Hiring', 'ieee-career-fair'); ?>
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#benefitsAccordion">
                                <div class="accordion-body">
                                    <?php esc_html_e('Access to highly qualified IEEE members with specialized skills in engineering, computing, and technical fields, ensuring a better candidate fit for your open positions.', 'ieee-career-fair'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Access to Talent -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <?php esc_html_e('Access to Talent', 'ieee-career-fair'); ?>
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#benefitsAccordion">
                                <div class="accordion-body">
                                    <?php esc_html_e('Direct connection with IEEE\'s global network of over 400,000 technical professionals across 160 countries, giving you unparalleled reach to specialized talent.', 'ieee-career-fair'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Brand Exposure -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <?php esc_html_e('Global Brand Exposure', 'ieee-career-fair'); ?>
                                </button>
                            </h3>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#benefitsAccordion">
                                <div class="accordion-body">
                                    <?php esc_html_e('Enhance your employer brand among the technical community through IEEE\'s prestigious platform, showcasing your company as a leader in innovation and technical excellence.', 'ieee-career-fair'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mb-4 mb-lg-0 order-lg-2 order-1">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/employers.jpg" 
                         alt="<?php esc_attr_e('IEEE Career Fair for Employers', 'ieee-career-fair'); ?>" 
                         class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Next Generation Section -->
    <section id="next-gen" class="next-gen-section py-5 text-white" style="background-color: <?php echo esc_attr($primary_color); ?>;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-tag text-uppercase"><?php esc_html_e('TALENT DEVELOPMENT', 'ieee-career-fair'); ?></div>
                    <h2 class="section-title"><?php esc_html_e('Empowering the Next Generation of Innovators', 'ieee-career-fair'); ?></h2>
                    <p class="lead">
                        <?php esc_html_e('IEEE Career Fairs provide unique opportunities for students and early career professionals to network with industry leaders, discover internships, and find full-time positions that kickstart their careers while giving employers direct access to fresh talent and innovative minds.', 'ieee-career-fair'); ?>
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="#upcoming-events" class="btn btn-light btn-lg px-4"><?php esc_html_e('View Events', 'ieee-career-fair'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Opportunity Section -->
    <section id="opportunity" class="opportunity-section py-5 bg-white">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title"><?php esc_html_e('Don\'t Miss the Next Career Opportunity', 'ieee-career-fair'); ?></h2>
                    <p class="lead">
                        <?php esc_html_e('Be sure to mark your calendar and prepare your resume for these upcoming career fairs. These events are a rare opportunity to connect with IEEE employers and top hiring companies.', 'ieee-career-fair'); ?>
                    </p>
                </div>
            </div>
            <div class="text-center">
                <a href="#upcoming-events" class="btn btn-primary btn-lg"><?php esc_html_e('View Upcoming Career Fairs', 'ieee-career-fair'); ?></a>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="upcoming-events" class="events-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title"><?php echo esc_html($events_title); ?></h2>
                <p class="section-description"><?php echo esc_html($events_description); ?></p>
            </div>
            
            <div class="row">
                <?php
                $today = date('Y-m-d');
                $events_args = array(
                    'post_type'      => 'career_event',
                    'posts_per_page' => $events_count,
                    'meta_key'       => '_ieee_event_date',
                    'orderby'        => 'meta_value',
                    'order'          => 'ASC',
                    'meta_query'     => array(
                        array(
                            'key'     => '_ieee_event_date',
                            'value'   => $today,
                            'compare' => '>=',
                            'type'    => 'DATE'
                        )
                    )
                );
                
                $events_query = new WP_Query($events_args);
                
                if ($events_query->have_posts()) :
                    while ($events_query->have_posts()) : $events_query->the_post();
                        $event_date = get_post_meta(get_the_ID(), '_ieee_event_date', true);
                        $event_location = get_post_meta(get_the_ID(), '_ieee_event_location', true);
                        $event_status = get_post_meta(get_the_ID(), '_ieee_event_status', true);
                        $registration_url = get_post_meta(get_the_ID(), '_ieee_event_registration_url', true);
                        
                        $date_obj = new DateTime($event_date);
                        $formatted_date = $date_obj->format('F j, Y');
                        $month = $date_obj->format('M');
                        $day = $date_obj->format('d');
                        $year = $date_obj->format('Y');
                ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card event-card h-100">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="event-image">
                                    <?php the_post_thumbnail('event-thumbnail', array('class' => 'card-img-top')); ?>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="event-date-badge">
                                    <span class="event-month"><?php echo esc_html($month); ?></span>
                                    <span class="event-day"><?php echo esc_html($day); ?></span>
                                    <span class="event-year"><?php echo esc_html($year); ?></span>
                                </div>
                                <h3 class="card-title h5 mt-3">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <?php if ($event_location) : ?>
                                    <div class="event-location mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i><?php echo esc_html($event_location); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="event-excerpt mb-3">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <?php if ($registration_url) : ?>
                                    <a href="<?php echo esc_url($registration_url); ?>" class="btn btn-primary btn-sm" target="_blank">
                                        <?php esc_html_e('Register Now', 'ieee-career-fair'); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                        <?php esc_html_e('Event Details', 'ieee-career-fair'); ?>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($event_status) : ?>
                                    <span class="badge bg-<?php echo esc_attr(ieee_get_status_class($event_status)); ?> float-end">
                                        <?php echo esc_html(ieee_get_status_text($event_status)); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Display placeholder events
                ?>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <?php esc_html_e('No upcoming events are currently scheduled. Please check back later or contact us for more information about future career fairs.', 'ieee-career-fair'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main><!-- #main -->

<!-- Add AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    offset: 100
});

// Counter animation
function animateCounters() {
    const counters = document.querySelectorAll('.stat-number');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 100;
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
            }
        }, 20);
    });
}

// Trigger counter animation when stats section is visible
const statsSection = document.getElementById('stats');
if (statsSection) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    });
    
    observer.observe(statsSection);
}

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offset = 80; // Account for fixed header
            const targetPosition = target.offsetTop - offset;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    });
});

// Add bounce animation class
const style = document.createElement('style');
style.textContent = `
    @keyframes bounce {
        0%, 20%, 60%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        80% {
            transform: translateY(-5px);
        }
    }
    
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    .social-link {
        color: #ffc107;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }
    
    .social-link:hover {
        color: #fff;
        transform: translateY(-2px);
    }
`;
document.head.appendChild(style);
</script>

<?php get_footer(); ?>

<?php
/**
 * Helper function to get appropriate status class for event badge
 */
function ieee_get_status_class($status) {
    $classes = array(
        'upcoming' => 'secondary',
        'registration_open' => 'success',
        'sold_out' => 'danger',
        'completed' => 'dark',
        'cancelled' => 'danger'
    );
    
    return isset($classes[$status]) ? $classes[$status] : 'secondary';
}

/**
 * Helper function to get human-readable status text
 */
function ieee_get_status_text($status) {
    $text = array(
        'upcoming' => __('Upcoming', 'ieee-career-fair'),
        'registration_open' => __('Registration Open', 'ieee-career-fair'),
        'sold_out' => __('Sold Out', 'ieee-career-fair'),
        'completed' => __('Completed', 'ieee-career-fair'),
        'cancelled' => __('Cancelled', 'ieee-career-fair')
    );
    
    return isset($text[$status]) ? $text[$status] : __('Upcoming', 'ieee-career-fair');
} 