<?php
/**
 * The header for our theme
 * 
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * 
 * @package IEEE_Career_Fair
 * @version 1.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/ieee-logo.png" type="image/png">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="keywords" content="IEEE, Career Fair, Jobs, Technology, Engineering, Students, Professionals">
    <meta name="author" content="IEEE">
    
    <!-- Open Graph Tags for Social Media -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/ieee-logo.png">
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/ieee-logo.png">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
            <div class="container">
                <!-- Brand/Logo -->
                <a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ieee-logo.png" 
                         alt="<?php bloginfo('name'); ?>" 
                         class="ieee-logo me-2">
                    <span class="fw-bold text-primary d-none d-md-inline">
                        <?php bloginfo('name'); ?>
                    </span>
                </a>

                <!-- Mobile menu toggle button -->
                <button class="navbar-toggler" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#primary-navigation" 
                        aria-controls="primary-navigation" 
                        aria-expanded="false" 
                        aria-label="<?php esc_attr_e('Toggle navigation', 'ieee-career-fair'); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="primary-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
                        'container'       => false,
                        'fallback_cb'     => '__return_false',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 2,
                        'walker'          => new IEEE_Bootstrap_Nav_Walker(),
                    ));
                    ?>
                    
                    <!-- Call-to-Action Button -->
                    <div class="ms-3">
                        <a href="#register" class="btn btn-warning btn-sm fw-bold">
                            <i class="fas fa-user-plus me-1"></i>
                            <?php _e('Register Now', 'ieee-career-fair'); ?>
                        </a>
                    </div>
                </div><!-- .navbar-collapse -->
            </div><!-- .container -->
        </nav><!-- .navbar -->
    </header><!-- #masthead -->

    <div id="content" class="site-content"> 