<?php
/**
 * The template for displaying single career events
 * 
 * @package IEEE_Career_Fair
 * @version 1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php while (have_posts()) : the_post(); ?>
        
        <?php
        // Get event meta data
        $event_date = get_post_meta(get_the_ID(), '_ieee_event_date', true);
        $event_time = get_post_meta(get_the_ID(), '_ieee_event_time', true);
        $event_location = get_post_meta(get_the_ID(), '_ieee_event_location', true);
        $event_status = get_post_meta(get_the_ID(), '_ieee_event_status', true);
        $registration_url = get_post_meta(get_the_ID(), '_ieee_event_registration_url', true);
        
        $formatted_date = $event_date ? date('F j, Y', strtotime($event_date)) : '';
        $formatted_time = $event_time ? date('g:i A', strtotime($event_time)) : '';
        ?>

        <!-- Hero Section -->
        <section class="hero-section" style="min-height: 60vh;">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-10">
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>" class="text-white"><?php _e('Home', 'ieee-career-fair'); ?></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo home_url('/career-events/'); ?>" class="text-white"><?php _e('Career Events', 'ieee-career-fair'); ?></a></li>
                                <li class="breadcrumb-item active text-warning" aria-current="page"><?php the_title(); ?></li>
                            </ol>
                        </nav>
                        
                        <h1 class="hero-title mb-4"><?php the_title(); ?></h1>
                        
                        <div class="event-meta d-flex flex-wrap justify-content-center gap-4 mb-4">
                            <?php if ($formatted_date) : ?>
                                <div class="text-white">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <?php echo esc_html($formatted_date); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($formatted_time) : ?>
                                <div class="text-white">
                                    <i class="fas fa-clock me-2"></i>
                                    <?php echo esc_html($formatted_time); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($event_location) : ?>
                                <div class="text-white">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <?php echo esc_html($event_location); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($registration_url && $event_status !== 'completed') : ?>
                            <a href="<?php echo esc_url($registration_url); ?>" class="cta-button" target="_blank">
                                <i class="fas fa-user-plus me-2"></i>
                                <?php _e('Register Now', 'ieee-career-fair'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Event Content -->
        <section class="content-section bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <article class="event-content">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="event-image mb-5">
                                    <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded shadow')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="event-description">
                                <?php the_content(); ?>
                            </div>
                        </article>
                    </div>
                    
                    <!-- Event Sidebar -->
                    <div class="col-lg-4">
                        <div class="event-sidebar">
                            <!-- Event Details Card -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><?php _e('Event Details', 'ieee-career-fair'); ?></h5>
                                </div>
                                <div class="card-body">
                                    <?php if ($formatted_date) : ?>
                                        <div class="mb-3">
                                            <strong><?php _e('Date:', 'ieee-career-fair'); ?></strong><br>
                                            <?php echo esc_html($formatted_date); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($formatted_time) : ?>
                                        <div class="mb-3">
                                            <strong><?php _e('Time:', 'ieee-career-fair'); ?></strong><br>
                                            <?php echo esc_html($formatted_time); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($event_location) : ?>
                                        <div class="mb-3">
                                            <strong><?php _e('Location:', 'ieee-career-fair'); ?></strong><br>
                                            <?php echo esc_html($event_location); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="mb-3">
                                        <strong><?php _e('Status:', 'ieee-career-fair'); ?></strong><br>
                                        <?php
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
                                                $status_text = __('Event Completed', 'ieee-career-fair');
                                                break;
                                            default:
                                                $status_class = 'primary';
                                                $status_text = __('Coming Soon', 'ieee-career-fair');
                                        }
                                        ?>
                                        <span class="badge bg-<?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                    </div>
                                    
                                    <?php if ($registration_url && $event_status !== 'completed') : ?>
                                        <a href="<?php echo esc_url($registration_url); ?>" class="btn btn-primary w-100" target="_blank">
                                            <i class="fas fa-external-link-alt me-2"></i>
                                            <?php _e('Register Now', 'ieee-career-fair'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Share Event -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><?php _e('Share This Event', 'ieee-career-fair'); ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex gap-2">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                           target="_blank" 
                                           class="btn btn-outline-primary btn-sm flex-fill">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                           target="_blank" 
                                           class="btn btn-outline-info btn-sm flex-fill">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" 
                                           target="_blank" 
                                           class="btn btn-outline-primary btn-sm flex-fill">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <button onclick="navigator.share ? navigator.share({title: '<?php echo esc_js(get_the_title()); ?>', url: '<?php echo esc_js(get_permalink()); ?>'}) : copyToClipboard('<?php echo esc_js(get_permalink()); ?>')" 
                                                class="btn btn-outline-secondary btn-sm flex-fill">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Related Events -->
                            <?php
                            $related_events = new WP_Query(array(
                                'post_type' => 'career_event',
                                'posts_per_page' => 3,
                                'post__not_in' => array(get_the_ID()),
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
                            
                            if ($related_events->have_posts()) : ?>
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><?php _e('Related Events', 'ieee-career-fair'); ?></h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <?php while ($related_events->have_posts()) : $related_events->the_post(); ?>
                                            <?php $related_date = get_post_meta(get_the_ID(), '_ieee_event_date', true); ?>
                                            <div class="p-3 border-bottom">
                                                <h6 class="mb-1">
                                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h6>
                                                <?php if ($related_date) : ?>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        <?php echo date('M j, Y', strtotime($related_date)); ?>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                        <div class="p-3">
                                            <a href="<?php echo home_url('/career-events/'); ?>" class="btn btn-outline-primary btn-sm w-100">
                                                <?php _e('View All Events', 'ieee-career-fair'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('<?php _e("Link copied to clipboard!", "ieee-career-fair"); ?>');
    });
}
</script>

<?php get_footer(); ?> 