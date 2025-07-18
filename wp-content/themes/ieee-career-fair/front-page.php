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
// Get custom fields for this page
$hero_title = get_post_meta(get_the_ID(), '_ieee_hero_title', true);
$hero_subtitle = get_post_meta(get_the_ID(), '_ieee_hero_subtitle', true);
$cta_primary_text = get_post_meta(get_the_ID(), '_ieee_cta_primary_text', true);
$cta_primary_url = get_post_meta(get_the_ID(), '_ieee_cta_primary_url', true);
$cta_secondary_text = get_post_meta(get_the_ID(), '_ieee_cta_secondary_text', true);
$cta_secondary_url = get_post_meta(get_the_ID(), '_ieee_cta_secondary_url', true);

// Set defaults if custom fields are empty
$hero_title = $hero_title ?: 'IEEE Career Fair: Your Gateway to Opportunity';
$hero_subtitle = $hero_subtitle ?: 'Connect with top employers, explore exciting career opportunities, and take your professional journey to the next level at IEEE Career Fair - the premier destination for technology and engineering professionals.';
$cta_primary_text = $cta_primary_text ?: 'Explore Career Fair';
$cta_primary_url = $cta_primary_url ?: '#events';
$cta_secondary_text = $cta_secondary_text ?: 'Register as Student';
$cta_secondary_url = $cta_secondary_url ?: '#register';
?>

<main id="main" class="site-main" role="main">
    
    <!-- Hero Section -->
    <section class="hero-section" id="hero">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                        <?php echo esc_html($hero_title); ?>
                    </h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
                        <?php echo esc_html($hero_subtitle); ?>
                    </p>
                    <div class="hero-buttons mt-4" data-aos="fade-up" data-aos-delay="300">
                        <a href="<?php echo esc_url($cta_primary_url); ?>" class="cta-button me-3">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <?php echo esc_html($cta_primary_text); ?>
                        </a>
                        <a href="<?php echo esc_url($cta_secondary_url); ?>" class="cta-button secondary">
                            <i class="fas fa-user-graduate me-2"></i>
                            <?php echo esc_html($cta_secondary_text); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll down indicator -->
        <div class="scroll-indicator text-center mt-5">
            <a href="#partners" class="text-white text-decoration-none">
                <i class="fas fa-chevron-down fa-2x animate-bounce"></i>
                <div class="small mt-2"><?php _e('Scroll to explore', 'ieee-career-fair'); ?></div>
            </a>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section" id="partners">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title mb-3" data-aos="fade-up">
                        <?php _e('Our Partners', 'ieee-career-fair'); ?>
                    </h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-delay="100">
                        <?php _e('Collaborating with leading organizations worldwide', 'ieee-career-fair'); ?>
                    </p>
                </div>
            </div>
            
            <div class="row align-items-center justify-content-center g-4">
                <?php
                // Get partners
                $partners = new WP_Query(array(
                    'post_type' => 'partner',
                    'posts_per_page' => 8,
                    'post_status' => 'publish',
                    'meta_query' => array(
                        array(
                            'key' => '_thumbnail_id',
                            'compare' => 'EXISTS'
                        )
                    )
                ));

                if ($partners->have_posts()) :
                    $delay = 100;
                    while ($partners->have_posts()) :
                        $partners->the_post();
                        $partner_url = get_post_meta(get_the_ID(), '_ieee_partner_url', true);
                        ?>
                        <div class="col-6 col-md-4 col-lg-3 text-center" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                            <?php if ($partner_url) : ?>
                                <a href="<?php echo esc_url($partner_url); ?>" target="_blank" rel="noopener" class="partner-link">
                            <?php endif; ?>
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('partner-logo', array('class' => 'partner-logo img-fluid')); ?>
                                <?php else : ?>
                                    <div class="partner-placeholder bg-light d-flex align-items-center justify-content-center" style="height: 80px;">
                                        <span class="text-muted"><?php the_title(); ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php if ($partner_url) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php
                        $delay += 50;
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Default partner logos if none are set up yet
                    $default_partners = array(
                        array('name' => 'IEEE', 'logo' => 'ieee-logo.png'),
                        array('name' => 'IEEE Technical Activities', 'logo' => 'ieee-ta.png'),
                        array('name' => 'IEEE Industry Engagement Committee', 'logo' => 'iec.png'),
                        array('name' => 'IEEE Students', 'logo' => 'students.png'),
                        array('name' => 'IEEE Young Professionals', 'logo' => 'yp.png'),
                        array('name' => 'IEEE Region 10', 'logo' => 'r10.png'),
                        array('name' => 'IEEE Region 8', 'logo' => 'r8.png'),
                        array('name' => 'IEEE YP Region 10', 'logo' => 'yp-r10.png')
                    );
                    
                    foreach ($default_partners as $index => $partner) :
                        $delay = 100 + ($index * 50);
                        ?>
                        <div class="col-6 col-md-4 col-lg-3 text-center" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                            <div class="partner-logo-container">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo/<?php echo esc_attr($partner['logo']); ?>" 
                                     alt="<?php echo esc_attr($partner['name']); ?>" 
                                     class="partner-logo img-fluid"
                                     style="max-height: 80px; filter: grayscale(100%); transition: filter 0.3s ease;"
                                     onmouseover="this.style.filter='grayscale(0%)'"
                                     onmouseout="this.style.filter='grayscale(100%)'">
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- About IEEE Virtual Career Fairs Section -->
    <section class="content-section bg-white" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/background/category-bg.jpg" 
                         alt="<?php _e('IEEE Career Fair Event', 'ieee-career-fair'); ?>" 
                         class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="ps-lg-4">
                        <span class="badge bg-primary mb-3"><?php _e('ABOUT US', 'ieee-career-fair'); ?></span>
                        <h2 class="display-5 fw-bold mb-4">
                            <?php _e('What Are', 'ieee-career-fair'); ?> 
                            <span class="text-primary"><?php _e('IEEE Virtual Career Fairs?', 'ieee-career-fair'); ?></span>
                        </h2>
                        <p class="lead mb-4">
                            <?php _e('IEEE Career Fair is powered by the IEEE Young Professionals Committee in collaboration with the IEEE Industry Engagement Committee and IEEE Student Activities Committee.', 'ieee-career-fair'); ?>
                        </p>
                        <p class="mb-4">
                            <?php _e('The pilot edition will be a virtual career fair in partnership with IEEE Region 10, focusing on the Asia Pacific region. This innovative platform connects talented professionals with leading employers in technology and engineering fields.', 'ieee-career-fair'); ?>
                        </p>
                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span><?php _e('Global Networking', 'ieee-career-fair'); ?></span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span><?php _e('Virtual Interviews', 'ieee-career-fair'); ?></span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span><?php _e('Professional Development', 'ieee-career-fair'); ?></span>
                            </div>
                        </div>
                        <a href="#events" class="btn btn-primary btn-lg">
                            <?php _e('Learn More', 'ieee-career-fair'); ?> <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Companies Should Join Section -->
    <section class="content-section bg-light" id="companies">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2 class="section-title mb-4" data-aos="fade-up">
                        <?php _e('Why Should Companies Join IEEE Career Fairs?', 'ieee-career-fair'); ?>
                    </h2>
                    <p class="lead" data-aos="fade-up" data-aos-delay="100">
                        <?php _e('Connecting with top IEEE talent opens doors to exceptional opportunities and lasting partnerships.', 'ieee-career-fair'); ?>
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- Collapsible sections for company benefits -->
                <div class="col-12">
                    <div class="accordion" id="companyBenefitsAccordion" data-aos="fade-up" data-aos-delay="200">
                        
                        <!-- Quality Hiring -->
                        <div class="collapsible-section accordion-item">
                            <div class="collapsible-header accordion-header" id="qualityHiringHeading">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#qualityHiring" aria-expanded="true" aria-controls="qualityHiring">
                                    <i class="fas fa-users text-primary me-3"></i>
                                    <span class="fw-bold"><?php _e('Quality Hiring', 'ieee-career-fair'); ?></span>
                                </button>
                            </div>
                            <div id="qualityHiring" class="accordion-collapse collapse show" aria-labelledby="qualityHiringHeading" data-bs-parent="#companyBenefitsAccordion">
                                <div class="accordion-body">
                                    <p><?php _e('Access to a global pool of highly qualified IEEE professionals and students with proven technical expertise and commitment to excellence in engineering and technology fields.', 'ieee-career-fair'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Access to Talent -->
                        <div class="collapsible-section accordion-item">
                            <div class="collapsible-header accordion-header" id="accessTalentHeading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accessTalent" aria-expanded="false" aria-controls="accessTalent">
                                    <i class="fas fa-search text-primary me-3"></i>
                                    <span class="fw-bold"><?php _e('Access to Talent', 'ieee-career-fair'); ?></span>
                                </button>
                            </div>
                            <div id="accessTalent" class="accordion-collapse collapse" aria-labelledby="accessTalentHeading" data-bs-parent="#companyBenefitsAccordion">
                                <div class="accordion-body">
                                    <p><?php _e('Connect with diverse talent from multiple IEEE regions, accessing professionals with cutting-edge skills in emerging technologies and established engineering disciplines.', 'ieee-career-fair'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Global Brand Exposure -->
                        <div class="collapsible-section accordion-item">
                            <div class="collapsible-header accordion-header" id="brandExposureHeading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#brandExposure" aria-expanded="false" aria-controls="brandExposure">
                                    <i class="fas fa-globe text-primary me-3"></i>
                                    <span class="fw-bold"><?php _e('Global Brand Exposure', 'ieee-career-fair'); ?></span>
                                </button>
                            </div>
                            <div id="brandExposure" class="accordion-collapse collapse" aria-labelledby="brandExposureHeading" data-bs-parent="#companyBenefitsAccordion">
                                <div class="accordion-body">
                                    <p><?php _e('Enhance your company\'s visibility within the global IEEE community, reaching top-tier engineering talent and establishing your brand as a preferred employer in technology sectors.', 'ieee-career-fair'); ?></p>
                                </div>
                            </div>
                        </div>

                    </div><!-- .accordion -->
                </div><!-- .col-12 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section>

    <!-- Stats Section -->
    <section class="stats-section" id="stats">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 mb-5">
                    <h2 class="text-white mb-4" data-aos="fade-up">
                        <?php _e('Empowering the Next Generation of Innovators', 'ieee-career-fair'); ?>
                    </h2>
                    <p class="text-light lead" data-aos="fade-up" data-aos-delay="100">
                        <?php _e('IEEE Career Fair connects global talent with industry leaders, fostering innovation and career growth across technology and engineering sectors.', 'ieee-career-fair'); ?>
                    </p>
                </div>
            </div>
            
            <div class="row g-4 text-center">
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-number" data-target="50000">0</div>
                        <div class="stat-label"><?php _e('IEEE Members Worldwide', 'ieee-career-fair'); ?></div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-number" data-target="160">0</div>
                        <div class="stat-label"><?php _e('Countries Represented', 'ieee-career-fair'); ?></div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-number" data-target="100">0</div>
                        <div class="stat-label"><?php _e('Partner Companies', 'ieee-career-fair'); ?></div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-number" data-target="95">0</div>
                        <div class="stat-label"><?php _e('Success Rate', 'ieee-career-fair'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="content-section bg-white" id="cta">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="cta-content bg-primary rounded-4 p-5 text-white" data-aos="zoom-in">
                        <h2 class="display-6 fw-bold mb-4">
                            <?php _e('Don\'t Miss the', 'ieee-career-fair'); ?> 
                            <span class="text-warning"><?php _e('Next Career Opportunity', 'ieee-career-fair'); ?></span>
                        </h2>
                        <p class="lead mb-4">
                            <?php _e('Join thousands of professionals and leading companies at IEEE Career Fair. Whether you\'re seeking your next role or looking to hire top talent, we\'ve got you covered.', 'ieee-career-fair'); ?>
                        </p>
                        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                            <a href="#events" class="btn btn-warning btn-lg fw-bold">
                                <i class="fas fa-calendar-check me-2"></i>
                                <?php _e('View Upcoming Events', 'ieee-career-fair'); ?>
                            </a>
                            <a href="#register" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-user-plus me-2"></i>
                                <?php _e('Register Today', 'ieee-career-fair'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="content-section bg-light" id="events">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title mb-4" data-aos="fade-up">
                        <?php _e('Explore Upcoming Career Fairs', 'ieee-career-fair'); ?>
                    </h2>
                    <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                        <?php _e('Mark your calendar and join us at these exciting career events', 'ieee-career-fair'); ?>
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <?php
                // Get upcoming career events
                $events = new WP_Query(array(
                    'post_type' => 'career_event',
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                    'meta_query' => array(
                        array(
                            'key' => '_ieee_event_date',
                            'value' => date('Y-m-d'),
                            'compare' => '>=',
                            'type' => 'DATE'
                        )
                    ),
                    'meta_key' => '_ieee_event_date',
                    'orderby' => 'meta_value',
                    'order' => 'ASC'
                ));

                if ($events->have_posts()) :
                    $delay = 100;
                    while ($events->have_posts()) :
                        $events->the_post();
                        $event_date = get_post_meta(get_the_ID(), '_ieee_event_date', true);
                        $event_time = get_post_meta(get_the_ID(), '_ieee_event_time', true);
                        $event_location = get_post_meta(get_the_ID(), '_ieee_event_location', true);
                        $event_status = get_post_meta(get_the_ID(), '_ieee_event_status', true);
                        $registration_url = get_post_meta(get_the_ID(), '_ieee_event_registration_url', true);
                        
                        $formatted_date = $event_date ? date('M d, Y', strtotime($event_date)) : '';
                        $status_class = '';
                        $status_text = '';
                        
                        switch ($event_status) {
                            case 'registration_open':
                                $status_class = 'success';
                                $status_text = __('Registration Open', 'ieee-career-fair');
                                break;
                            case 'sold_out':
                                $status_class = 'warning';
                                $status_text = __('Sold Out', 'ieee-career-fair');
                                break;
                            case 'completed':
                                $status_class = 'secondary';
                                $status_text = __('Completed', 'ieee-career-fair');
                                break;
                            default:
                                $status_class = 'primary';
                                $status_text = __('Coming Soon', 'ieee-career-fair');
                        }
                        ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                            <article class="event-card h-100">
                                <?php if ($formatted_date) : ?>
                                    <div class="event-date">
                                        <div class="h5 mb-0"><?php echo date('d', strtotime($event_date)); ?></div>
                                        <div class="small"><?php echo date('M Y', strtotime($event_date)); ?></div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="event-details">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h3 class="h5 mb-0"><?php the_title(); ?></h3>
                                        <span class="badge bg-<?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                    </div>
                                    
                                    <?php if ($event_time) : ?>
                                        <div class="mb-2">
                                            <i class="fas fa-clock text-muted me-2"></i>
                                            <span class="text-muted"><?php echo esc_html($event_time); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($event_location) : ?>
                                        <div class="mb-3">
                                            <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                            <span class="text-muted"><?php echo esc_html($event_location); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="event-excerpt mb-3">
                                        <?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 15); ?>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm flex-grow-1">
                                            <?php _e('Learn More', 'ieee-career-fair'); ?>
                                        </a>
                                        <?php if ($registration_url && $event_status !== 'completed' && $event_status !== 'sold_out') : ?>
                                            <a href="<?php echo esc_url($registration_url); ?>" class="btn btn-primary btn-sm" target="_blank">
                                                <?php _e('Register', 'ieee-career-fair'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php
                        $delay += 100;
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Default events if none are set up yet
                    $default_events = array(
                        array(
                            'title' => 'IEEE Virtual Career Fair 2025',
                            'date' => '2025-08-18',
                            'time' => '10:00 AM - 4:00 PM UTC',
                            'location' => 'Virtual Event',
                            'description' => 'Join us for our premier virtual career fair featuring top technology companies from around the world. Connect with recruiters and explore opportunities.',
                            'status' => 'Registration Open',
                            'status_class' => 'success'
                        ),
                        array(
                            'title' => 'IEEE Region 10 Career Summit',
                            'date' => '2025-10-30',
                            'time' => '9:00 AM - 5:00 PM SGT',
                            'location' => 'Virtual Event',
                            'description' => 'Connect with leading employers in the Asia Pacific region. Featuring companies specializing in electronics and telecommunications.',
                            'status' => 'Coming Soon',
                            'status_class' => 'primary'
                        ),
                        array(
                            'title' => 'IEEE Student Professional Development Fair',
                            'date' => '2025-12-04',
                            'time' => '11:00 AM - 3:00 PM EST',
                            'location' => 'Virtual Event',
                            'description' => 'Designed for students and recent graduates. Get career guidance, resume reviews, and networking opportunities.',
                            'status' => 'Coming Soon',
                            'status_class' => 'primary'
                        )
                    );
                    
                    foreach ($default_events as $index => $event) :
                        $delay = 100 + ($index * 100);
                        ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                            <article class="event-card h-100">
                                <div class="event-date">
                                    <div class="h5 mb-0"><?php echo date('d', strtotime($event['date'])); ?></div>
                                    <div class="small"><?php echo date('M Y', strtotime($event['date'])); ?></div>
                                </div>
                                
                                <div class="event-details">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h3 class="h5 mb-0"><?php echo esc_html($event['title']); ?></h3>
                                        <span class="badge bg-<?php echo esc_attr($event['status_class']); ?>"><?php echo esc_html($event['status']); ?></span>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <i class="fas fa-clock text-muted me-2"></i>
                                        <span class="text-muted small"><?php echo esc_html($event['time']); ?></span>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                        <span class="text-muted small"><?php echo esc_html($event['location']); ?></span>
                                    </div>
                                    
                                    <div class="event-excerpt mb-3">
                                        <?php echo esc_html($event['description']); ?>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-outline-primary btn-sm flex-grow-1" disabled>
                                            <?php _e('Learn More', 'ieee-career-fair'); ?>
                                        </button>
                                        <?php if ($event['status'] === 'Registration Open') : ?>
                                            <button class="btn btn-primary btn-sm" disabled>
                                                <?php _e('Register Now', 'ieee-career-fair'); ?>
                                            </button>
                                        <?php else : ?>
                                            <button class="btn btn-primary btn-sm" disabled>
                                                <?php _e('Coming Soon', 'ieee-career-fair'); ?>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
            
            <!-- View All Events Button -->
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="<?php echo home_url('/career-events/'); ?>" class="btn btn-primary btn-lg">
                    <?php _e('View All Career Events', 'ieee-career-fair'); ?> <i class="fas fa-arrow-right ms-2"></i>
                </a>
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