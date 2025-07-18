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
    
    <style type="text/css">
        .meta-nav {
            min-height: 40px;
            background: #000000;
            color: #ffffff;
            padding: 0px;
            margin: 0px;
        }
        
        #meta-ieee-logo {
            margin: 0px;
            float:right;
        }

        #meta-ieee-logo .joinIEEE{
            text-align: right;
            color: #fff;
            padding: 11px 36px;
        }

        #meta-ieee-logo .joinIEEE:link, #meta-ieee-logo .joinIEEE:visited, #meta-ieee-logo .joinIEEE:active {
            color: #fff;
            text-decoration: none;
        }

        #meta-ieee-logo .joinIEEE:hover {
            color: #fff;
            text-decoration: underline;
        }
        
        @media (max-width: 800px) {
        .meta-nav {
            min-height: 100px;
            background: #000000;
            color: #ffffff;
            padding: 0px;
            margin: 0px;
        }
        .meta-ieee-logo {
            padding: 20px 0px 0px 0px;
            float:right;
            max-width: 100px;
        }
        }
        
        p {
            font-family: inherit;
            font-size: .9em;
            line-height: 125%;
            border: 0;
            margin: 0;
        }

        #ieee-meta-a {
            color: #fff;
            text-align: left;
            padding: 11px 36px;
            float: left;
        }
        
        #ieee-meta-a a:link, #ieee-meta-a a:visited, #ieee-meta-a a:active {
            color: #fff;
            text-decoration: none;
        }

        #ieee-meta-a a:hover {
            color: #fff;
            text-decoration: underline;
        }
        #meta-ieee-logo .donate{
            float: right;
            color: #fff;
            padding: 11px 36px;
            text-decoration: none;
        }
        
        #meta-ieee-logo .donate:hover {
            color: #fff;
            text-decoration: underline;
        }

        #meta-ieee-logo .Signin{
            float: left;
            color: #fff;
            padding: 11px 36px;
            text-decoration: none;
        }
        
        #meta-ieee-logo .Signin:hover {
            color: #fff;
            text-decoration: underline;
        }

        #meta-ieee-logo .Account{
            float: left;
            color: #fff;
            padding: 11px 36px;
            text-decoration: none;
        }
        
        #meta-ieee-logo .Account:hover {
            color: #fff;
            text-decoration: underline;
        }

        .donate {
            color: #fff;
            text-align: left;
            padding: 11px 36px;
            text-align: left;
        }

        #donate {
            color: #fff;
            text-align: right;
            padding: 11px 36px;
            text-align: right;
        }
        
        /* Main navigation styles */
        .main-navigation {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .main-navigation .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .ieee-logo {
            height: 50px;
            width: auto;
        }
    </style>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <!-- IEEE Meta Navigation -->
    <div class="meta-nav">
        <p id="ieee-meta-a"><a href="https://www.ieee.org/index.html">IEEE.org</a> &#160;|&#160; <a href="https://www.ieeexplore.ieee.org/Xplore/guesthome.jsp">IEEE <em>Xplore</em><sup>®</sup></a>&#160;|&#160; <a href="https://standards.ieee.org/">IEEE Standards</a> &#160;|&#160; <a href="https://spectrum.ieee.org/">IEEE Spectrum</a> &#160;|&#160; <a href="https://www.ieee.org/sitemap.html">More Sites</a></p>

        <p id="ieee-meta-a" style="text-align:right; float: right;">
            <a href="https://www.ieee.org/membership/join/index.html?WT.mc_id=hc_join">Join IEEE</a> &#160;|&#160; <a href="https://www.ieee.org/give">Donate</a>
        </p>
    </div>

    <header id="masthead" class="site-header">
        <nav class="main-navigation">
            <div class="container">
                <!-- Brand/Logo -->
                <a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ieee-logo.png" 
                         alt="<?php bloginfo('name'); ?>" 
                         class="ieee-logo">
                </a>

                <!-- Navigation Menu -->
                <div class="main-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'menu_class'      => 'navbar-nav d-flex flex-row',
                        'container'       => false,
                        'fallback_cb'     => '__return_false',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 2,
                    ));
                    ?>
                    
                    <!-- Call-to-Action Button -->
                    <div class="ms-3 d-none d-lg-block">
                        <a href="#register" class="btn btn-warning btn-sm fw-bold">
                            <?php _e('Register Now', 'ieee-career-fair'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header><!-- #masthead -->

    <div id="content" class="site-content"> 