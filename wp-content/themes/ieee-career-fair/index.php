<?php
/**
 * The main template file
 * 
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * 
 * @package IEEE_Career_Fair
 * @since IEEE Career Fair 1.0
 */

get_header(); ?>

<main id="main" class="site-main container my-5">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            
            <?php if (have_posts()) : ?>
                
                <div class="posts-container">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
                            
                            <header class="entry-header mb-3">
                                <?php if (is_singular()) : ?>
                                    <h1 class="entry-title h2"><?php the_title(); ?></h1>
                                <?php else : ?>
                                    <h2 class="entry-title h3">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                <?php endif; ?>
                                
                                <div class="entry-meta text-muted small">
                                    <span class="posted-on">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>
                                    </span>
                                    
                                    <?php if (get_the_author()) : ?>
                                        <span class="byline ms-3">
                                            <i class="fas fa-user me-1"></i>
                                            <span class="author vcard">
                                                <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                    <?php echo get_the_author(); ?>
                                                </a>
                                            </span>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if (has_category()) : ?>
                                        <span class="cat-links ms-3">
                                            <i class="fas fa-folder me-1"></i>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </header>
                            
                            <?php if (has_post_thumbnail() && ! is_singular()) : ?>
                                <div class="post-thumbnail mb-3">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="entry-content">
                                <?php
                                if (is_singular()) {
                                    the_content();
                                } else {
                                    the_excerpt();
                                }
                                
                                wp_link_pages(array(
                                    'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'ieee-career-fair') . '</span>',
                                    'after'  => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                    'pagelink' => '<span class="screen-reader-text">' . __('Page', 'ieee-career-fair') . ' </span>%',
                                    'separator' => '<span class="screen-reader-text">, </span>',
                                ));
                                ?>
                            </div>
                            
                            <?php if (! is_singular()) : ?>
                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                        <?php _e('Read More', 'ieee-career-fair'); ?>
                                        <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </footer>
                            <?php endif; ?>
                            
                        </article>
                        
                    <?php endwhile; ?>
                </div>
                
                <?php
                // Pagination
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'ieee-career-fair'),
                    'next_text' => __('Next', 'ieee-career-fair') . ' <i class="fas fa-chevron-right"></i>',
                    'class'     => 'pagination-wrapper d-flex justify-content-center mt-5'
                ));
                ?>
                
            <?php else : ?>
                
                <div class="no-posts-found text-center py-5">
                    <div class="alert alert-info">
                        <h2><?php _e('Nothing Found', 'ieee-career-fair'); ?></h2>
                        <p class="mb-0">
                            <?php if (is_home() && current_user_can('publish_posts')) : ?>
                                <?php
                                /* translators: 1: link to WP admin new post page. */
                                printf(
                                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ieee-career-fair'),
                                    esc_url(admin_url('post-new.php'))
                                );
                                ?>
                            <?php elseif (is_search()) : ?>
                                <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ieee-career-fair'); ?></p>
                            <?php else : ?>
                                <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ieee-career-fair'); ?></p>
                            <?php endif; ?>
                        </p>
                        
                        <?php if (is_search() || ! is_home()) : ?>
                            <div class="mt-3">
                                <?php get_search_form(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
            <?php endif; ?>
            
        </div>
        
        <div class="col-lg-4 col-md-5">
            <aside id="secondary" class="widget-area">
                
                <!-- IEEE Career Fair Info Widget -->
                <div class="widget bg-light p-4 rounded mb-4">
                    <h3 class="widget-title h5 mb-3 text-primary">
                        <i class="fas fa-info-circle me-2"></i>
                        <?php _e('About IEEE Career Fair', 'ieee-career-fair'); ?>
                    </h3>
                    <p class="mb-3">
                        <?php _e('Connect with top employers, explore exciting career opportunities, and take your professional journey to the next level.', 'ieee-career-fair'); ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/events/')); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-calendar-alt me-1"></i>
                        <?php _e('View Events', 'ieee-career-fair'); ?>
                    </a>
                </div>
                
                <?php if (is_active_sidebar('sidebar-1')) : ?>
                    <?php dynamic_sidebar('sidebar-1'); ?>
                <?php else : ?>
                    
                    <!-- Recent Posts Widget -->
                    <div class="widget mb-4">
                        <h3 class="widget-title h5 mb-3">
                            <i class="fas fa-clock me-2"></i>
                            <?php _e('Recent Updates', 'ieee-career-fair'); ?>
                        </h3>
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ));
                        
                        if ($recent_posts) : ?>
                            <ul class="list-unstyled">
                                <?php foreach ($recent_posts as $post) : ?>
                                    <li class="border-bottom pb-2 mb-2">
                                        <a href="<?php echo get_permalink($post['ID']); ?>" class="text-decoration-none">
                                            <small class="text-muted d-block"><?php echo get_the_date('', $post['ID']); ?></small>
                                            <span class="fw-medium"><?php echo $post['post_title']; ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <p class="text-muted"><?php _e('No recent posts found.', 'ieee-career-fair'); ?></p>
                        <?php endif;
                        wp_reset_query();
                        ?>
                    </div>
                    
                    <!-- Quick Links Widget -->
                    <div class="widget bg-primary text-white p-4 rounded">
                        <h3 class="widget-title h5 mb-3 text-white">
                            <i class="fas fa-link me-2"></i>
                            <?php _e('Quick Links', 'ieee-career-fair'); ?>
                        </h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href="<?php echo esc_url(home_url('/events/')); ?>" class="text-white text-decoration-none">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    <?php _e('Career Events', 'ieee-career-fair'); ?>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="<?php echo esc_url(home_url('/partners/')); ?>" class="text-white text-decoration-none">
                                    <i class="fas fa-handshake me-2"></i>
                                    <?php _e('Our Partners', 'ieee-career-fair'); ?>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="text-white text-decoration-none">
                                    <i class="fas fa-envelope me-2"></i>
                                    <?php _e('Contact Us', 'ieee-career-fair'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="https://ieee.org" target="_blank" rel="noopener" class="text-white text-decoration-none">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    <?php _e('IEEE.org', 'ieee-career-fair'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                <?php endif; ?>
                
            </aside>
        </div>
        
    </div>
</main>

<?php get_footer(); ?> 