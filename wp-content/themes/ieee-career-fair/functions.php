<?php
/**
 * IEEE Career Fair Theme Functions
 * 
 * This file contains all theme functionality including:
 * - Theme setup and support
 * - Asset enqueuing
 * - Custom post types for events and partners
 * - Custom fields for easy admin management
 * - Security hardening
 * - Performance optimizations
 * 
 * @package IEEE_Career_Fair
 * @version 1.0
 */

// Prevent direct access for security
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 * 
 * Sets up theme defaults and registers support for various WordPress features.
 * This function is hooked into the 'after_setup_theme' action for optimal timing.
 */
function ieee_career_fair_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Add custom image sizes for various sections
    add_image_size('hero-bg', 1920, 1080, true);
    add_image_size('partner-logo', 300, 150, true);
    add_image_size('event-thumbnail', 400, 250, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'ieee-career-fair'),
        'footer'  => esc_html__('Footer Menu', 'ieee-career-fair'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Add support for wide alignment
    add_theme_support('align-wide');

    // Set content width for embedded content
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'ieee_career_fair_setup');

/**
 * Enqueue Styles and Scripts
 * 
 * Properly loads all CSS and JavaScript files with version control
 * and dependency management for optimal loading performance.
 */
function ieee_career_fair_scripts() {
    // Theme version for cache busting
    $theme_version = wp_get_theme()->get('Version');

    // Enqueue Bootstrap CSS from CDN for better performance
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );

    // Enqueue FontAwesome for icons
    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );

    // Main theme stylesheet
    wp_enqueue_style(
        'ieee-career-fair-style',
        get_stylesheet_uri(),
        array('bootstrap'),
        $theme_version
    );

    // Bootstrap JavaScript
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.0',
        true
    );

    // Custom theme JavaScript
    wp_enqueue_script(
        'ieee-career-fair-script',
        get_template_directory_uri() . '/assets/js/theme.js',
        array('jquery', 'bootstrap'),
        $theme_version,
        true
    );

    // Localize script for AJAX functionality
    wp_localize_script('ieee-career-fair-script', 'ieee_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('ieee_nonce'),
    ));

    // Load comment reply script if needed
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ieee_career_fair_scripts');

/**
 * Custom Post Type: Career Fair Events
 * 
 * Creates a custom post type for managing career fair events
 * with user-friendly admin interface for non-technical users.
 */
function ieee_register_career_fair_events() {
    $labels = array(
        'name'                  => _x('Career Fair Events', 'Post type general name', 'ieee-career-fair'),
        'singular_name'         => _x('Career Fair Event', 'Post type singular name', 'ieee-career-fair'),
        'menu_name'             => _x('Career Events', 'Admin Menu text', 'ieee-career-fair'),
        'name_admin_bar'        => _x('Career Event', 'Add New on Toolbar', 'ieee-career-fair'),
        'add_new'               => __('Add New Event', 'ieee-career-fair'),
        'add_new_item'          => __('Add New Career Fair Event', 'ieee-career-fair'),
        'new_item'              => __('New Career Fair Event', 'ieee-career-fair'),
        'edit_item'             => __('Edit Career Fair Event', 'ieee-career-fair'),
        'view_item'             => __('View Career Fair Event', 'ieee-career-fair'),
        'all_items'             => __('All Career Events', 'ieee-career-fair'),
        'search_items'          => __('Search Career Events', 'ieee-career-fair'),
        'parent_item_colon'     => __('Parent Career Events:', 'ieee-career-fair'),
        'not_found'             => __('No career events found.', 'ieee-career-fair'),
        'not_found_in_trash'    => __('No career events found in Trash.', 'ieee-career-fair'),
        'featured_image'        => _x('Event Featured Image', 'Overrides the "Featured Image" phrase', 'ieee-career-fair'),
        'set_featured_image'    => _x('Set event image', 'Overrides the "Set featured image" phrase', 'ieee-career-fair'),
        'remove_featured_image' => _x('Remove event image', 'Overrides the "Remove featured image" phrase', 'ieee-career-fair'),
        'use_featured_image'    => _x('Use as event image', 'Overrides the "Use as featured image" phrase', 'ieee-career-fair'),
        'archives'              => _x('Career Event archives', 'The post type archive label', 'ieee-career-fair'),
        'insert_into_item'      => _x('Insert into career event', 'Overrides the "Insert into post" phrase', 'ieee-career-fair'),
        'uploaded_to_this_item' => _x('Uploaded to this career event', 'Overrides the "Uploaded to this post" phrase', 'ieee-career-fair'),
        'filter_items_list'     => _x('Filter career events list', 'Screen reader text for the filter links', 'ieee-career-fair'),
        'items_list_navigation' => _x('Career events list navigation', 'Screen reader text for the pagination', 'ieee-career-fair'),
        'items_list'            => _x('Career events list', 'Screen reader text for the items list', 'ieee-career-fair'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'career-events'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true, // Enable Gutenberg editor
    );

    register_post_type('career_event', $args);
}
add_action('init', 'ieee_register_career_fair_events');

/**
 * Custom Post Type: Partners
 * 
 * Creates a custom post type for managing partner organizations
 * with easy logo upload and link management.
 */
function ieee_register_partners() {
    $labels = array(
        'name'                  => _x('Partners', 'Post type general name', 'ieee-career-fair'),
        'singular_name'         => _x('Partner', 'Post type singular name', 'ieee-career-fair'),
        'menu_name'             => _x('Partners', 'Admin Menu text', 'ieee-career-fair'),
        'name_admin_bar'        => _x('Partner', 'Add New on Toolbar', 'ieee-career-fair'),
        'add_new'               => __('Add New Partner', 'ieee-career-fair'),
        'add_new_item'          => __('Add New Partner', 'ieee-career-fair'),
        'new_item'              => __('New Partner', 'ieee-career-fair'),
        'edit_item'             => __('Edit Partner', 'ieee-career-fair'),
        'view_item'             => __('View Partner', 'ieee-career-fair'),
        'all_items'             => __('All Partners', 'ieee-career-fair'),
        'search_items'          => __('Search Partners', 'ieee-career-fair'),
        'not_found'             => __('No partners found.', 'ieee-career-fair'),
        'not_found_in_trash'    => __('No partners found in Trash.', 'ieee-career-fair'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('partner', $args);
}
add_action('init', 'ieee_register_partners');

/**
 * Add Custom Fields Meta Boxes
 * 
 * Creates user-friendly meta boxes for custom fields
 * that non-technical users can easily manage.
 */
function ieee_add_meta_boxes() {
    // Event details meta box
    add_meta_box(
        'ieee_event_details',
        __('Event Details', 'ieee-career-fair'),
        'ieee_event_details_callback',
        'career_event',
        'normal',
        'high'
    );

    // Partner details meta box
    add_meta_box(
        'ieee_partner_details',
        __('Partner Details', 'ieee-career-fair'),
        'ieee_partner_details_callback',
        'partner',
        'normal',
        'high'
    );

    // Homepage content meta box for pages
    add_meta_box(
        'ieee_homepage_content',
        __('Homepage Content Sections', 'ieee-career-fair'),
        'ieee_homepage_content_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ieee_add_meta_boxes');

/**
 * Event Details Meta Box Callback
 * 
 * Renders the meta box for event-specific fields with
 * clear labels and help text for non-technical users.
 */
function ieee_event_details_callback($post) {
    wp_nonce_field('ieee_save_meta_box', 'ieee_meta_box_nonce');

    $event_date = get_post_meta($post->ID, '_ieee_event_date', true);
    $event_time = get_post_meta($post->ID, '_ieee_event_time', true);
    $event_location = get_post_meta($post->ID, '_ieee_event_location', true);
    $event_registration_url = get_post_meta($post->ID, '_ieee_event_registration_url', true);
    $event_status = get_post_meta($post->ID, '_ieee_event_status', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="ieee_event_date"><?php _e('Event Date', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="date" 
                       id="ieee_event_date" 
                       name="ieee_event_date" 
                       value="<?php echo esc_attr($event_date); ?>" 
                       class="regular-text" />
                <p class="description"><?php _e('Select the date when this career fair event will take place.', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_event_time"><?php _e('Event Time', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="time" 
                       id="ieee_event_time" 
                       name="ieee_event_time" 
                       value="<?php echo esc_attr($event_time); ?>" 
                       class="regular-text" />
                <p class="description"><?php _e('Enter the start time for this event (e.g., 10:00 AM).', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_event_location"><?php _e('Event Location', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="text" 
                       id="ieee_event_location" 
                       name="ieee_event_location" 
                       value="<?php echo esc_attr($event_location); ?>" 
                       class="regular-text" 
                       placeholder="<?php _e('e.g., Virtual Event or Conference Center Name', 'ieee-career-fair'); ?>" />
                <p class="description"><?php _e('Enter the location where this event will be held. For virtual events, enter "Virtual Event".', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_event_registration_url"><?php _e('Registration URL', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="url" 
                       id="ieee_event_registration_url" 
                       name="ieee_event_registration_url" 
                       value="<?php echo esc_attr($event_registration_url); ?>" 
                       class="regular-text" 
                       placeholder="https://example.com/register" />
                <p class="description"><?php _e('Enter the full URL where users can register for this event.', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_event_status"><?php _e('Event Status', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <select id="ieee_event_status" name="ieee_event_status">
                    <option value="upcoming" <?php selected($event_status, 'upcoming'); ?>><?php _e('Upcoming', 'ieee-career-fair'); ?></option>
                    <option value="registration_open" <?php selected($event_status, 'registration_open'); ?>><?php _e('Registration Open', 'ieee-career-fair'); ?></option>
                    <option value="sold_out" <?php selected($event_status, 'sold_out'); ?>><?php _e('Sold Out', 'ieee-career-fair'); ?></option>
                    <option value="completed" <?php selected($event_status, 'completed'); ?>><?php _e('Completed', 'ieee-career-fair'); ?></option>
                    <option value="cancelled" <?php selected($event_status, 'cancelled'); ?>><?php _e('Cancelled', 'ieee-career-fair'); ?></option>
                </select>
                <p class="description"><?php _e('Select the current status of this event.', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
    </table>
    
    <?php
}

/**
 * Partner Details Meta Box Callback
 * 
 * Renders the meta box for partner-specific fields including
 * website URL and organization type.
 */
function ieee_partner_details_callback($post) {
    wp_nonce_field('ieee_save_meta_box', 'ieee_meta_box_nonce');

    $partner_url = get_post_meta($post->ID, '_ieee_partner_url', true);
    $partner_type = get_post_meta($post->ID, '_ieee_partner_type', true);
    $partner_description = get_post_meta($post->ID, '_ieee_partner_description', true);
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="ieee_partner_url"><?php _e('Partner Website URL', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="url" 
                       id="ieee_partner_url" 
                       name="ieee_partner_url" 
                       value="<?php echo esc_attr($partner_url); ?>" 
                       class="regular-text" 
                       placeholder="https://partner-website.com" />
                <p class="description"><?php _e('Enter the partner\'s official website URL.', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_partner_type"><?php _e('Partner Type', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <select id="ieee_partner_type" name="ieee_partner_type">
                    <option value="sponsor" <?php selected($partner_type, 'sponsor'); ?>><?php _e('Sponsor', 'ieee-career-fair'); ?></option>
                    <option value="collaborator" <?php selected($partner_type, 'collaborator'); ?>><?php _e('Collaborator', 'ieee-career-fair'); ?></option>
                    <option value="media_partner" <?php selected($partner_type, 'media_partner'); ?>><?php _e('Media Partner', 'ieee-career-fair'); ?></option>
                    <option value="supporting_organization" <?php selected($partner_type, 'supporting_organization'); ?>><?php _e('Supporting Organization', 'ieee-career-fair'); ?></option>
                </select>
                <p class="description"><?php _e('Select the type of partnership relationship.', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_partner_description"><?php _e('Partner Description', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <textarea id="ieee_partner_description" 
                          name="ieee_partner_description" 
                          rows="4" 
                          cols="50" 
                          class="large-text"><?php echo esc_textarea($partner_description); ?></textarea>
                <p class="description"><?php _e('Brief description of the partner organization (optional).', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
    </table>
    
    <?php
}

/**
 * Homepage Content Meta Box Callback
 * 
 * Provides easy-to-use fields for editing homepage content
 * without requiring technical knowledge.
 */
function ieee_homepage_content_callback($post) {
    wp_nonce_field('ieee_save_meta_box', 'ieee_meta_box_nonce');

    $hero_title = get_post_meta($post->ID, '_ieee_hero_title', true);
    $hero_subtitle = get_post_meta($post->ID, '_ieee_hero_subtitle', true);
    $hero_background = get_post_meta($post->ID, '_ieee_hero_background', true);
    $cta_primary_text = get_post_meta($post->ID, '_ieee_cta_primary_text', true);
    $cta_primary_url = get_post_meta($post->ID, '_ieee_cta_primary_url', true);
    $cta_secondary_text = get_post_meta($post->ID, '_ieee_cta_secondary_text', true);
    $cta_secondary_url = get_post_meta($post->ID, '_ieee_cta_secondary_url', true);
    ?>
    
    <h3><?php _e('Hero Section', 'ieee-career-fair'); ?></h3>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="ieee_hero_title"><?php _e('Hero Title', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="text" 
                       id="ieee_hero_title" 
                       name="ieee_hero_title" 
                       value="<?php echo esc_attr($hero_title); ?>" 
                       class="large-text" 
                       placeholder="<?php _e('IEEE Career Fair: Your Gateway to Opportunity', 'ieee-career-fair'); ?>" />
                <p class="description"><?php _e('The main headline that appears on the homepage hero section.', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_hero_subtitle"><?php _e('Hero Subtitle', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <textarea id="ieee_hero_subtitle" 
                          name="ieee_hero_subtitle" 
                          rows="3" 
                          cols="50" 
                          class="large-text" 
                          placeholder="<?php _e('Connect with top employers, explore exciting career opportunities, and take the next step in your professional journey with IEEE Career Fairs.', 'ieee-career-fair'); ?>"><?php echo esc_textarea($hero_subtitle); ?></textarea>
                <p class="description"><?php _e('The descriptive text that appears below the main headline.', 'ieee-career-fair'); ?></p>
            </td>
        </tr>
    </table>
    
    <h3><?php _e('Call-to-Action Buttons', 'ieee-career-fair'); ?></h3>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="ieee_cta_primary_text"><?php _e('Primary Button Text', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="text" 
                       id="ieee_cta_primary_text" 
                       name="ieee_cta_primary_text" 
                       value="<?php echo esc_attr($cta_primary_text); ?>" 
                       class="regular-text" 
                       placeholder="<?php _e('Explore Career Fairs', 'ieee-career-fair'); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_cta_primary_url"><?php _e('Primary Button URL', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="url" 
                       id="ieee_cta_primary_url" 
                       name="ieee_cta_primary_url" 
                       value="<?php echo esc_attr($cta_primary_url); ?>" 
                       class="regular-text" 
                       placeholder="https://example.com/career-fair" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_cta_secondary_text"><?php _e('Secondary Button Text', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="text" 
                       id="ieee_cta_secondary_text" 
                       name="ieee_cta_secondary_text" 
                       value="<?php echo esc_attr($cta_secondary_text); ?>" 
                       class="regular-text" 
                       placeholder="<?php _e('Register for Events', 'ieee-career-fair'); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="ieee_cta_secondary_url"><?php _e('Secondary Button URL', 'ieee-career-fair'); ?></label>
            </th>
            <td>
                <input type="url" 
                       id="ieee_cta_secondary_url" 
                       name="ieee_cta_secondary_url" 
                       value="<?php echo esc_attr($cta_secondary_url); ?>" 
                       class="regular-text" 
                       placeholder="https://example.com/student-registration" />
            </td>
        </tr>
    </table>
    
    <?php
}

/**
 * Save Meta Box Data
 * 
 * Securely saves custom field data with proper validation
 * and sanitization to prevent security vulnerabilities.
 */
function ieee_save_meta_box($post_id) {
    // Security checks
    if (!isset($_POST['ieee_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['ieee_meta_box_nonce'], 'ieee_save_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Event fields with proper sanitization
    $event_fields = array(
        'ieee_event_date' => 'sanitize_text_field',
        'ieee_event_time' => 'sanitize_text_field',
        'ieee_event_location' => 'sanitize_text_field',
        'ieee_event_registration_url' => 'esc_url_raw',
        'ieee_event_status' => 'sanitize_text_field',
    );

    foreach ($event_fields as $field => $sanitizer) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, $sanitizer($_POST[$field]));
        }
    }

    // Partner fields with proper sanitization
    $partner_fields = array(
        'ieee_partner_url' => 'esc_url_raw',
        'ieee_partner_type' => 'sanitize_text_field',
        'ieee_partner_description' => 'sanitize_textarea_field',
    );

    foreach ($partner_fields as $field => $sanitizer) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, $sanitizer($_POST[$field]));
        }
    }

    // Homepage content fields with proper sanitization
    $homepage_fields = array(
        'ieee_hero_title' => 'sanitize_text_field',
        'ieee_hero_subtitle' => 'sanitize_textarea_field',
        'ieee_hero_background' => 'esc_url_raw',
        'ieee_cta_primary_text' => 'sanitize_text_field',
        'ieee_cta_primary_url' => 'esc_url_raw',
        'ieee_cta_secondary_text' => 'sanitize_text_field',
        'ieee_cta_secondary_url' => 'esc_url_raw',
    );

    foreach ($homepage_fields as $field => $sanitizer) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, $sanitizer($_POST[$field]));
        }
    }
}
add_action('save_post', 'ieee_save_meta_box');

/**
 * Admin Customizations for Better User Experience
 * 
 * Makes the WordPress admin more user-friendly for non-technical users
 * by adding helpful instructions and improving the interface.
 */
function ieee_admin_customizations() {
    ?>
    <style>
        /* Make admin interface more user-friendly */
        .ieee-admin-help {
            background: #e7f3ff;
            border-left: 4px solid #0073aa;
            padding: 12px;
            margin: 15px 0;
        }
        .ieee-admin-help h4 {
            margin-top: 0;
            color: #0073aa;
        }
        .form-table th {
            width: 200px;
        }
        .form-table td p.description {
            font-style: italic;
            color: #666;
        }
    </style>
    <?php
}
add_action('admin_head', 'ieee_admin_customizations');

/**
 * Add Help Text to Admin Pages
 * 
 * Provides contextual help for non-technical users
 * when managing content in the WordPress admin.
 */
function ieee_add_admin_help() {
    $screen = get_current_screen();
    
    if ($screen->post_type === 'career_event') {
        echo '<div class="ieee-admin-help">';
        echo '<h4>' . __('Career Event Management Help', 'ieee-career-fair') . '</h4>';
        echo '<p>' . __('Use this page to create and manage career fair events. Fill in all the required information to help visitors understand the event details. The featured image will be displayed on the events page.', 'ieee-career-fair') . '</p>';
        echo '</div>';
    }
    
    if ($screen->post_type === 'partner') {
        echo '<div class="ieee-admin-help">';
        echo '<h4>' . __('Partner Management Help', 'ieee-career-fair') . '</h4>';
        echo '<p>' . __('Add partner organizations here. Upload their logo as the featured image, and it will automatically appear in the partners section of the homepage. Make sure logos are high-quality and have transparent backgrounds when possible.', 'ieee-career-fair') . '</p>';
        echo '</div>';
    }
}
add_action('edit_form_after_title', 'ieee_add_admin_help');

/**
 * Security Enhancements
 * 
 * Implements additional security measures to protect the site
 * and user data from common vulnerabilities.
 */

// Remove WordPress version number from head for security
remove_action('wp_head', 'wp_generator');

// Disable file editing in WordPress admin
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

// Prevent information disclosure
function ieee_remove_wp_version_strings($src) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (isset($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'ieee_remove_wp_version_strings');
add_filter('style_loader_src', 'ieee_remove_wp_version_strings');

/**
 * Performance Optimizations
 * 
 * Implements various performance improvements to ensure
 * fast loading times and better user experience.
 */

// Add preload hints for critical resources
function ieee_add_preload_hints() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>';
    echo '<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>';
    echo '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">';
}
add_action('wp_head', 'ieee_add_preload_hints', 1);

// Optimize images
function ieee_add_image_sizes() {
    // Enable WebP support if available
    add_filter('wp_image_editors', function($editors) {
        if (function_exists('imagewebp')) {
            array_unshift($editors, 'WP_Image_Editor_GD');
        }
        return $editors;
    });
}
add_action('init', 'ieee_add_image_sizes');

/**
 * Accessibility Improvements
 * 
 * Ensures the theme meets accessibility standards
 * and provides a good experience for all users.
 */
function ieee_accessibility_enhancements() {
    // Add skip to content link
    echo '<a class="sr-only sr-only-focusable" href="#main">' . __('Skip to main content', 'ieee-career-fair') . '</a>';
}
add_action('wp_body_open', 'ieee_accessibility_enhancements');

/**
 * Widget Areas
 * 
 * Registers widget areas for flexible content management
 * in the footer and other areas of the site.
 */
function ieee_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'ieee-career-fair'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in the footer.', 'ieee-career-fair'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'ieee_widgets_init');

/**
 * Flush Rewrite Rules
 * 
 * Ensures custom post type URLs work correctly
 * by flushing rewrite rules when the theme is activated.
 */
function ieee_flush_rewrite_rules() {
    ieee_register_career_fair_events();
    ieee_register_partners();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'ieee_flush_rewrite_rules');

/**
 * Theme Customizer Settings
 * 
 * Adds theme customizer options for easy customization
 * without requiring code changes.
 */
function ieee_customize_register($wp_customize) {
    // Add IEEE Career Fair Panel
    $wp_customize->add_panel('ieee_career_fair_panel', array(
        'title'    => __('IEEE Career Fair Settings', 'ieee-career-fair'),
        'priority' => 30,
    ));

    // Hero Section
    $wp_customize->add_section('ieee_hero_section', array(
        'title'    => __('Hero Section', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 10,
    ));

    // Add hero background setting
    $wp_customize->add_setting('ieee_hero_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ieee_hero_bg', array(
        'label'    => __('Hero Background Image', 'ieee-career-fair'),
        'section'  => 'ieee_hero_section',
        'settings' => 'ieee_hero_bg',
    )));

    // Hero Title
    $wp_customize->add_setting('ieee_hero_title', array(
        'default'           => __('IEEE Career Fair: Your Gateway to Opportunity', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ieee_hero_title', array(
        'label'    => __('Hero Title', 'ieee-career-fair'),
        'section'  => 'ieee_hero_section',
        'type'     => 'text',
    ));

    // Hero Subtitle
    $wp_customize->add_setting('ieee_hero_subtitle', array(
        'default'           => __('Connect with top employers, explore exciting career opportunities, and take the next step in your professional journey with IEEE Career Fairs.', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('ieee_hero_subtitle', array(
        'label'    => __('Hero Subtitle', 'ieee-career-fair'),
        'section'  => 'ieee_hero_section',
        'type'     => 'textarea',
    ));

    // CTA Section
    $wp_customize->add_section('ieee_cta_section', array(
        'title'    => __('Call-to-Action Buttons', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 15,
    ));

    // Primary CTA
    $wp_customize->add_setting('ieee_primary_cta_text', array(
        'default'           => __('Explore Career Fairs', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ieee_primary_cta_text', array(
        'label'    => __('Primary Button Text', 'ieee-career-fair'),
        'section'  => 'ieee_cta_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('ieee_primary_cta_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('ieee_primary_cta_url', array(
        'label'    => __('Primary Button URL', 'ieee-career-fair'),
        'section'  => 'ieee_cta_section',
        'type'     => 'url',
    ));

    // Secondary CTA
    $wp_customize->add_setting('ieee_secondary_cta_text', array(
        'default'           => __('Register for Events', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ieee_secondary_cta_text', array(
        'label'    => __('Secondary Button Text', 'ieee-career-fair'),
        'section'  => 'ieee_cta_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('ieee_secondary_cta_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('ieee_secondary_cta_url', array(
        'label'    => __('Secondary Button URL', 'ieee-career-fair'),
        'section'  => 'ieee_cta_section',
        'type'     => 'url',
    ));

    // Partners Section
    $wp_customize->add_section('ieee_partners_section', array(
        'title'    => __('Partners Section', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 20,
    ));

    // Partners Title
    $wp_customize->add_setting('ieee_partners_title', array(
        'default'           => __('Our Partners', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ieee_partners_title', array(
        'label'    => __('Partners Section Title', 'ieee-career-fair'),
        'section'  => 'ieee_partners_section',
        'type'     => 'text',
    ));

    // Partners Description
    $wp_customize->add_setting('ieee_partners_description', array(
        'default'           => __('We collaborate with leading organizations to bring you the best career opportunities.', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('ieee_partners_description', array(
        'label'    => __('Partners Section Description', 'ieee-career-fair'),
        'section'  => 'ieee_partners_section',
        'type'     => 'textarea',
    ));

    // Events Section
    $wp_customize->add_section('ieee_events_section', array(
        'title'    => __('Events Section', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 25,
    ));

    // Events Title
    $wp_customize->add_setting('ieee_events_title', array(
        'default'           => __('Explore Upcoming Career Fairs', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ieee_events_title', array(
        'label'    => __('Events Section Title', 'ieee-career-fair'),
        'section'  => 'ieee_events_section',
        'type'     => 'text',
    ));

    // Events Description
    $wp_customize->add_setting('ieee_events_description', array(
        'default'           => __('Find an IEEE career fair near you and connect with potential employers.', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('ieee_events_description', array(
        'label'    => __('Events Section Description', 'ieee-career-fair'),
        'section'  => 'ieee_events_section',
        'type'     => 'textarea',
    ));

    // Number of events to show
    $wp_customize->add_setting('ieee_events_count', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('ieee_events_count', array(
        'label'    => __('Number of Events to Display', 'ieee-career-fair'),
        'section'  => 'ieee_events_section',
        'type'     => 'number',
        'input_attrs' => array(
            'min'   => 3,
            'max'   => 12,
            'step'  => 1,
        ),
    ));

    // FAQ Section
    $wp_customize->add_section('ieee_faq_section', array(
        'title'    => __('FAQ Section', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 30,
    ));

    // FAQ Title
    $wp_customize->add_setting('ieee_faq_title', array(
        'default'           => __('What Are IEEE Virtual Career Fairs?', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ieee_faq_title', array(
        'label'    => __('FAQ Section Title', 'ieee-career-fair'),
        'section'  => 'ieee_faq_section',
        'type'     => 'text',
    ));

    // FAQ Content
    $wp_customize->add_setting('ieee_faq_content', array(
        'default'           => __('IEEE Career Fairs are globally recognized events connecting top employers with talented professionals across engineering, computing, and technology fields...', 'ieee-career-fair'),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('ieee_faq_content', array(
        'label'    => __('FAQ Content', 'ieee-career-fair'),
        'section'  => 'ieee_faq_section',
        'type'     => 'textarea',
    ));

    // Why IEEE Section
    $wp_customize->add_section('ieee_why_section', array(
        'title'    => __('Why IEEE Career Fairs Section', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 35,
    ));

    // Why IEEE Title
    $wp_customize->add_setting('ieee_why_title', array(
        'default'           => __('Why Should Companies Join IEEE Career Fairs?', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('ieee_why_title', array(
        'label'    => __('Section Title', 'ieee-career-fair'),
        'section'  => 'ieee_why_section',
        'type'     => 'text',
    ));

    // Why IEEE Content
    $wp_customize->add_setting('ieee_why_content', array(
        'default'           => __('Partnering with IEEE provides unparalleled access to skilled talent across engineering, computing, and technical fields...', 'ieee-career-fair'),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('ieee_why_content', array(
        'label'    => __('Section Content', 'ieee-career-fair'),
        'section'  => 'ieee_why_section',
        'type'     => 'textarea',
    ));

    // Footer Section
    $wp_customize->add_section('ieee_footer_section', array(
        'title'    => __('Footer Content', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 40,
    ));

    // Footer About Text
    $wp_customize->add_setting('ieee_footer_about', array(
        'default'           => __('IEEE Career Fairs connect talented professionals with top employers across various technology fields. Our events provide networking opportunities, career insights, and direct access to industry leaders.', 'ieee-career-fair'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('ieee_footer_about', array(
        'label'    => __('About Text', 'ieee-career-fair'),
        'section'  => 'ieee_footer_section',
        'type'     => 'textarea',
    ));

    // Contact Information Section
    $wp_customize->add_section('ieee_contact_section', array(
        'title'    => __('Contact Information', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 45,
    ));

    // Contact email
    $wp_customize->add_setting('ieee_contact_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('ieee_contact_email', array(
        'label'    => __('Contact Email', 'ieee-career-fair'),
        'section'  => 'ieee_contact_section',
        'type'     => 'email',
    ));

    // Social media links
    $social_platforms = array('facebook', 'twitter', 'linkedin', 'instagram');
    
    foreach ($social_platforms as $platform) {
        $wp_customize->add_setting('ieee_social_' . $platform, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('ieee_social_' . $platform, array(
            'label'    => sprintf(__('%s URL', 'ieee-career-fair'), ucfirst($platform)),
            'section'  => 'ieee_contact_section',
            'type'     => 'url',
        ));
    }

    // Colors Section
    $wp_customize->add_section('ieee_colors_section', array(
        'title'    => __('Color Scheme', 'ieee-career-fair'),
        'panel'    => 'ieee_career_fair_panel',
        'priority' => 50,
    ));

    // Primary Color
    $wp_customize->add_setting('ieee_primary_color', array(
        'default'           => '#00629b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ieee_primary_color', array(
        'label'    => __('Primary Color', 'ieee-career-fair'),
        'section'  => 'ieee_colors_section',
    )));

    // Secondary Color
    $wp_customize->add_setting('ieee_secondary_color', array(
        'default'           => '#ffb81c',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ieee_secondary_color', array(
        'label'    => __('Secondary Color', 'ieee-career-fair'),
        'section'  => 'ieee_colors_section',
    )));
}
add_action('customize_register', 'ieee_customize_register');

/**
 * Add Admin Notice for Setup Instructions
 * 
 * Displays helpful setup instructions when the theme is first activated
 * to guide non-technical users through the initial configuration.
 */
function ieee_admin_setup_notice() {
    if (get_transient('ieee_setup_notice')) {
        ?>
        <div class="notice notice-info is-dismissible">
            <h3><?php _e('Welcome to IEEE Career Fair Theme!', 'ieee-career-fair'); ?></h3>
            <p><?php _e('Thank you for choosing the IEEE Career Fair theme. To get started:', 'ieee-career-fair'); ?></p>
            <ol>
                <li><?php _e('Create a new page and set it as your homepage in Settings > Reading', 'ieee-career-fair'); ?></li>
                <li><?php _e('Add career fair events using the "Career Events" menu', 'ieee-career-fair'); ?></li>
                <li><?php _e('Add partner organizations using the "Partners" menu', 'ieee-career-fair'); ?></li>
                <li><?php _e('Customize your site colors and settings in Appearance > Customize', 'ieee-career-fair'); ?></li>
            </ol>
            <p><a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e('Start Customizing', 'ieee-career-fair'); ?></a></p>
        </div>
        <?php
        delete_transient('ieee_setup_notice');
    }
}
add_action('admin_notices', 'ieee_admin_setup_notice');

// Set transient on theme activation
function ieee_set_setup_notice() {
    set_transient('ieee_setup_notice', true, 300); // Show for 5 minutes
}
add_action('after_switch_theme', 'ieee_set_setup_notice');

/**
 * Bootstrap Navigation Walker
 * 
 * Custom walker class for Bootstrap 5 navigation menus
 * This ensures proper Bootstrap classes are applied to menu items
 */
class IEEE_Bootstrap_Nav_Walker extends Walker_Nav_Menu {
    
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';

        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $link_classes = array('nav-link');
        if (in_array('menu-item-has-children', $classes)) {
            $link_classes[] = 'dropdown-toggle';
            $attributes .= ' data-bs-toggle="dropdown" aria-expanded="false"';
        }

        $link_class = ' class="' . implode(' ', $link_classes) . '"';

        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . $link_class . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}