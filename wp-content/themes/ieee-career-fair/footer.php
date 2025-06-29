    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="row py-5">
                <!-- IEEE Branding -->
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ieee-logo.png" 
                             alt="IEEE Logo" 
                             class="footer-logo mb-3">
                        <h5 class="text-white mb-3"><?php _e('IEEE Career Fair', 'ieee-career-fair'); ?></h5>
                        <p class="text-light">
                            <?php _e('Connecting talented professionals with leading employers in technology and engineering fields worldwide.', 'ieee-career-fair'); ?>
                        </p>
                        
                        <!-- Social Media Links -->
                        <div class="social-links mt-3">
                            <?php
                            $social_platforms = array(
                                'facebook'  => 'fab fa-facebook-f',
                                'twitter'   => 'fab fa-twitter',
                                'linkedin'  => 'fab fa-linkedin-in',
                                'instagram' => 'fab fa-instagram'
                            );
                            
                            foreach ($social_platforms as $platform => $icon) {
                                $social_url = get_theme_mod('ieee_social_' . $platform);
                                if ($social_url) {
                                    echo '<a href="' . esc_url($social_url) . '" 
                                            class="social-link me-3" 
                                            target="_blank" 
                                            rel="noopener noreferrer"
                                            aria-label="' . esc_attr(ucfirst($platform)) . '">
                                            <i class="' . esc_attr($icon) . '"></i>
                                          </a>';
                                }
                            }
                            ?>
                        </div><!-- .social-links -->
                    </div><!-- .footer-brand -->
                </div><!-- .col-lg-4 -->

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-white mb-3"><?php _e('Quick Links', 'ieee-career-fair'); ?></h6>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-links list-unstyled',
                        'container'      => false,
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-links list-unstyled">';
                            echo '<li><a href="' . home_url() . '">' . __('Home', 'ieee-career-fair') . '</a></li>';
                            echo '<li><a href="' . home_url('/career-events/') . '">' . __('Career Events', 'ieee-career-fair') . '</a></li>';
                            echo '<li><a href="#about">' . __('About', 'ieee-career-fair') . '</a></li>';
                            echo '<li><a href="#contact">' . __('Contact', 'ieee-career-fair') . '</a></li>';
                            echo '</ul>';
                        },
                        'depth'          => 1,
                    ));
                    ?>
                </div><!-- .col-lg-2 -->

                <!-- Contact Information -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="text-white mb-3"><?php _e('Contact Info', 'ieee-career-fair'); ?></h6>
                    <ul class="footer-links list-unstyled">
                        <?php
                        $contact_email = get_theme_mod('ieee_contact_email');
                        if ($contact_email) {
                            echo '<li class="mb-2">
                                    <i class="fas fa-envelope me-2"></i>
                                    <a href="mailto:' . esc_attr($contact_email) . '">' . esc_html($contact_email) . '</a>
                                  </li>';
                        }
                        ?>
                        <li class="mb-2">
                            <i class="fas fa-globe me-2"></i>
                            <a href="https://www.ieee.org" target="_blank" rel="noopener">www.ieee.org</a>
                        </li>
                    </ul>
                </div><!-- .col-lg-3 -->

                <!-- Newsletter Signup -->
                <div class="col-lg-3 mb-4">
                    <h6 class="text-white mb-3"><?php _e('Stay Updated', 'ieee-career-fair'); ?></h6>
                    <p class="text-light small mb-3">
                        <?php _e('Subscribe to get the latest updates about upcoming career fairs and opportunities.', 'ieee-career-fair'); ?>
                    </p>
                    
                    <!-- Newsletter Form -->
                    <form class="newsletter-form" id="newsletter-form" method="post" action="#" novalidate>
                        <div class="input-group">
                            <input type="email" 
                                   class="form-control" 
                                   placeholder="<?php esc_attr_e('Your email address', 'ieee-career-fair'); ?>" 
                                   aria-label="<?php esc_attr_e('Email address', 'ieee-career-fair'); ?>"
                                   required>
                            <button class="btn btn-warning" type="submit">
                                <i class="fas fa-paper-plane"></i>
                                <span class="sr-only"><?php _e('Subscribe', 'ieee-career-fair'); ?></span>
                            </button>
                        </div>
                        <?php wp_nonce_field('ieee_newsletter', 'newsletter_nonce'); ?>
                    </form>
                </div><!-- .col-lg-3 -->
            </div><!-- .row -->

            <!-- Footer Bottom -->
            <div class="footer-bottom border-top border-secondary py-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="text-light mb-0 small">
                            &copy; <?php echo date('Y'); ?> 
                            <a href="https://www.ieee.org" class="text-warning text-decoration-none">IEEE</a>. 
                            <?php _e('All rights reserved.', 'ieee-career-fair'); ?>
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="text-light mb-0 small">
                            <?php _e('Powered by', 'ieee-career-fair'); ?> 
                            <a href="<?php echo esc_url(__('https://wordpress.org/')); ?>" class="text-warning text-decoration-none">WordPress</a>
                        </p>
                    </div>
                </div><!-- .row -->
            </div><!-- .footer-bottom -->
        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<!-- Back to Top Button -->
<button id="back-to-top" class="btn btn-warning position-fixed" style="bottom: 20px; right: 20px; z-index: 1000; display: none;">
    <i class="fas fa-chevron-up"></i>
    <span class="sr-only"><?php _e('Back to top', 'ieee-career-fair'); ?></span>
</button>

<?php wp_footer(); ?>

<!-- Custom JavaScript for enhanced functionality -->
<script>
// Back to top functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('back-to-top');
    
    // Show/hide back to top button
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });
    
    // Smooth scroll to top
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Newsletter form submission
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.querySelector('input[type="email"]').value;
            const nonce = this.querySelector('input[name="newsletter_nonce"]').value;
            
            if (email) {
                // Here you would typically send the email to your newsletter service
                // For now, we'll just show a success message
                alert('<?php _e("Thank you for subscribing! You'll receive updates about upcoming career fairs.", "ieee-career-fair"); ?>');
                this.reset();
            }
        });
    }
    
    // Accessibility improvements
    // Add keyboard navigation support for dropdowns
    document.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
    
    // Focus management for mobile menu
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            if (!isExpanded) {
                // Focus first menu item when menu opens
                setTimeout(() => {
                    const firstMenuItem = navbarCollapse.querySelector('a');
                    if (firstMenuItem) {
                        firstMenuItem.focus();
                    }
                }, 100);
            }
        });
    }
});

// Preloader (if needed)
window.addEventListener('load', function() {
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 300);
    }
});

// Performance optimization: Lazy load images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}
</script>

</body>
</html> 