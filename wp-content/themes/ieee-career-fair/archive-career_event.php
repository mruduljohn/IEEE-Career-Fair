<?php
/**
 * The template for displaying career events archive
 * 
 * @package IEEE_Career_Fair
 * @version 1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
    
    <!-- Hero Section -->
    <section class="hero-section" style="min-height: 50vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="hero-title mb-4">
                        <?php _e('Career Fair Events', 'ieee-career-fair'); ?>
                    </h1>
                    <p class="hero-subtitle">
                        <?php _e('Discover exciting career opportunities at IEEE Career Fair events worldwide. Connect with top employers and advance your professional journey.', 'ieee-career-fair'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Listing Section -->
    <section class="content-section bg-light">
        <div class="container">
            
            <!-- Filters and Search -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <form method="GET" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="event-search" class="form-label fw-bold">
                                    <?php _e('Search Events', 'ieee-career-fair'); ?>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="event-search" 
                                       name="search" 
                                       value="<?php echo esc_attr(get_query_var('search')); ?>"
                                       placeholder="<?php esc_attr_e('Search by title, location...', 'ieee-career-fair'); ?>">
                            </div>
                            
                            <div class="col-md-3">
                                <label for="event-status" class="form-label fw-bold">
                                    <?php _e('Event Status', 'ieee-career-fair'); ?>
                                </label>
                                <select class="form-select" id="event-status" name="status">
                                    <option value=""><?php _e('All Events', 'ieee-career-fair'); ?></option>
                                    <option value="upcoming" <?php selected(get_query_var('status'), 'upcoming'); ?>>
                                        <?php _e('Upcoming', 'ieee-career-fair'); ?>
                                    </option>
                                    <option value="registration_open" <?php selected(get_query_var('status'), 'registration_open'); ?>>
                                        <?php _e('Registration Open', 'ieee-career-fair'); ?>
                                    </option>
                                    <option value="completed" <?php selected(get_query_var('status'), 'completed'); ?>>
                                        <?php _e('Completed', 'ieee-career-fair'); ?>
                                    </option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="event-date" class="form-label fw-bold">
                                    <?php _e('Date Range', 'ieee-career-fair'); ?>
                                </label>
                                <select class="form-select" id="event-date" name="date_range">
                                    <option value=""><?php _e('All Dates', 'ieee-career-fair'); ?></option>
                                    <option value="this_month" <?php selected(get_query_var('date_range'), 'this_month'); ?>>
                                        <?php _e('This Month', 'ieee-career-fair'); ?>
                                    </option>
                                    <option value="next_month" <?php selected(get_query_var('date_range'), 'next_month'); ?>>
                                        <?php _e('Next Month', 'ieee-career-fair'); ?>
                                    </option>
                                    <option value="next_3_months" <?php selected(get_query_var('date_range'), 'next_3_months'); ?>>
                                        <?php _e('Next 3 Months', 'ieee-career-fair'); ?>
                                    </option>
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>
                                    <?php _e('Filter', 'ieee-career-fair'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Events Grid -->
            <div class="row">
                <?php if (have_posts()) : ?>
                    
                    <!-- Results Header -->
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="h4 mb-0">
                                <?php
                                $found_posts = $wp_query->found_posts;
                                printf(
                                    _n(
                                        '%d Event Found',
                                        '%d Events Found',
                                        $found_posts,
                                        'ieee-career-fair'
                                    ),
                                    $found_posts
                                );
                                ?>
                            </h2>
                            
                            <div class="d-flex gap-2">
                                <select class="form-select form-select-sm" id="sort-events" style="width: auto;">
                                    <option value="date_asc"><?php _e('Date (Earliest First)', 'ieee-career-fair'); ?></option>
                                    <option value="date_desc"><?php _e('Date (Latest First)', 'ieee-career-fair'); ?></option>
                                    <option value="title_asc"><?php _e('Title (A-Z)', 'ieee-career-fair'); ?></option>
                                    <option value="title_desc"><?php _e('Title (Z-A)', 'ieee-career-fair'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Events Cards -->
                    <div class="col-12">
                        <div class="row g-4" id="events-container">
                            <?php while (have_posts()) : the_post(); ?>
                                <?php
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
                                
                                <div class="col-lg-4 col-md-6 event-card-wrapper" data-date="<?php echo esc_attr($event_date); ?>" data-title="<?php echo esc_attr(get_the_title()); ?>">
                                    <article class="event-card h-100">
                                        <?php if ($formatted_date) : ?>
                                            <div class="event-date">
                                                <div class="h5 mb-0"><?php echo date('d', strtotime($event_date)); ?></div>
                                                <div class="small"><?php echo date('M Y', strtotime($event_date)); ?></div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="event-image">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('event-thumbnail', array('class' => 'img-fluid')); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="event-details">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h3 class="h5 mb-0">
                                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <span class="badge bg-<?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                            </div>
                                            
                                            <div class="event-meta mb-3">
                                                <?php if ($event_time) : ?>
                                                    <div class="mb-1">
                                                        <i class="fas fa-clock text-muted me-2"></i>
                                                        <span class="text-muted small"><?php echo esc_html($event_time); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if ($event_location) : ?>
                                                    <div class="mb-1">
                                                        <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                                        <span class="text-muted small"><?php echo esc_html($event_location); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="event-excerpt mb-3">
                                                <?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 15); ?>
                                            </div>
                                            
                                            <div class="event-actions d-flex gap-2 mt-auto">
                                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm flex-grow-1">
                                                    <?php _e('Learn More', 'ieee-career-fair'); ?>
                                                </a>
                                                <?php if ($registration_url && $event_status !== 'completed' && $event_status !== 'sold_out') : ?>
                                                    <a href="<?php echo esc_url($registration_url); ?>" class="btn btn-primary btn-sm" target="_blank" rel="noopener">
                                                        <?php _e('Register', 'ieee-career-fair'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="col-12 mt-5">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-chevron-left me-2"></i>' . __('Previous', 'ieee-career-fair'),
                            'next_text' => __('Next', 'ieee-career-fair') . '<i class="fas fa-chevron-right ms-2"></i>',
                            'class'     => 'pagination-wrapper',
                        ));
                        ?>
                    </div>

                <?php else : ?>
                    
                    <!-- No Events Found -->
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-calendar-times fa-4x text-muted"></i>
                            </div>
                            <h3><?php _e('No Events Found', 'ieee-career-fair'); ?></h3>
                            <p class="lead text-muted mb-4">
                                <?php _e('We couldn\'t find any career fair events matching your criteria. Try adjusting your filters or check back later for new events.', 'ieee-career-fair'); ?>
                            </p>
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="<?php echo home_url('/career-events/'); ?>" class="btn btn-primary">
                                    <?php _e('View All Events', 'ieee-career-fair'); ?>
                                </a>
                                <a href="<?php echo home_url(); ?>" class="btn btn-outline-primary">
                                    <?php _e('Back to Home', 'ieee-career-fair'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="content-section bg-primary">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="text-white">
                        <h2 class="mb-4"><?php _e('Don\'t Miss Out on Career Opportunities', 'ieee-career-fair'); ?></h2>
                        <p class="lead mb-4">
                            <?php _e('Stay updated with the latest IEEE Career Fair events and be the first to know about new opportunities in your field.', 'ieee-career-fair'); ?>
                        </p>
                        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                            <a href="#newsletter" class="btn btn-warning btn-lg">
                                <i class="fas fa-bell me-2"></i>
                                <?php _e('Get Notifications', 'ieee-career-fair'); ?>
                            </a>
                            <a href="<?php echo home_url(); ?>" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-home me-2"></i>
                                <?php _e('Explore More', 'ieee-career-fair'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Sort events functionality
    const sortSelect = document.getElementById('sort-events');
    const eventsContainer = document.getElementById('events-container');
    
    if (sortSelect && eventsContainer) {
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            const eventCards = Array.from(eventsContainer.children);
            
            eventCards.sort((a, b) => {
                switch (sortBy) {
                    case 'date_asc':
                        return new Date(a.dataset.date) - new Date(b.dataset.date);
                    case 'date_desc':
                        return new Date(b.dataset.date) - new Date(a.dataset.date);
                    case 'title_asc':
                        return a.dataset.title.localeCompare(b.dataset.title);
                    case 'title_desc':
                        return b.dataset.title.localeCompare(a.dataset.title);
                    default:
                        return 0;
                }
            });
            
            // Reorder DOM elements
            eventCards.forEach(card => {
                eventsContainer.appendChild(card);
            });
        });
    }
    
    // Auto-submit form on filter change
    const filterForm = document.querySelector('.content-section form');
    const filterSelects = filterForm?.querySelectorAll('select');
    
    if (filterSelects) {
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                // Auto-submit after a short delay to allow for multiple quick changes
                clearTimeout(this.submitTimeout);
                this.submitTimeout = setTimeout(() => {
                    filterForm.submit();
                }, 500);
            });
        });
    }
    
    // Search input with debouncing
    const searchInput = document.getElementById('event-search');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // You could implement live search here
                console.log('Search for:', this.value);
            }, 300);
        });
    }
    
});
</script>

<?php get_footer(); ?> 