    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3><?php esc_html_e('About IEEE Career Fairs', 'ieee-career-fair'); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('ieee_footer_about', __('IEEE Career Fairs connect talented professionals with top employers across various technology fields. Our events provide networking opportunities, career insights, and direct access to industry leaders.', 'ieee-career-fair'))); ?></p>
                        <div class="social-links mt-3">
                            <?php if (get_theme_mod('ieee_social_facebook')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('ieee_social_facebook')); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('ieee_social_twitter')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('ieee_social_twitter')); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('ieee_social_linkedin')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('ieee_social_linkedin')); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('ieee_social_instagram')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('ieee_social_instagram')); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3><?php esc_html_e('Quick Links', 'ieee-career-fair'); ?></h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3><?php esc_html_e('Contact Us', 'ieee-career-fair'); ?></h3>
                        <?php if (get_theme_mod('ieee_contact_email')) : ?>
                            <p><i class="fas fa-envelope"></i> <a href="mailto:<?php echo esc_attr(get_theme_mod('ieee_contact_email')); ?>"><?php echo esc_html(get_theme_mod('ieee_contact_email')); ?></a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- IEEE Standard Footer -->
        <div class="ieee-standard-footer" style="background: #333333; color: #666; text-align: center; padding-top: 20px;">
            <div class="container">
                <p id="util" style="text-align: left; padding: 11px 36px; font-size: 0.9em; line-height: 120%;">
                    <a href="http://www.ieee.org/index.html" id="u-home" style="color: #000; text-decoration: none;">Home</a> &#160;|&#160; 
                    <a href="http://www.ieee.org/sitemap.html" id="u-home" style="color: #000; text-decoration: none;">Sitemap/More Sites</a> &#160;|&#160; 
                    <a href="http://www.ieee.org/about/contact_center/index.html" id="u-contact" style="color: #000; text-decoration: none;">Contact</a> &#160;|&#160; 
                    <a href="http://www.ieee.org/accessibility_statement.html" id="u-accessibility" style="color: #000; text-decoration: none;">Accessibility</a> &#160;|&#160; 
                    <a href="http://www.ieee.org/p9-26.html" id="u-non" style="color: #000; text-decoration: none;">Nondiscrimination Policy</a> &#160;|&#160; 
                    <a href="http://ieee-ethics-reporting.org/" id="u-ethics-reporting" style="color: #000; text-decoration: none;">IEEE Ethics Reporting</a> &#160;|&#160; 
                    <a href="https://privacy.ieee.org/policies" id="u-privacy" style="color: #000; text-decoration: none;">IEEE Privacy Policy</a> &#160;|&#160; 
                    <a href="https://www.ieee.org/about/help/site-terms-conditions.html" id="u-terms" style="color: #000; text-decoration: none;">Terms & Disclosures</a>
                </p>

                <p id="util" style="text-align: left; padding: 11px 36px; font-size: 0.9em; line-height: 120%; color: #000;">
                    &copy; Copyright <script>document.write(new Date().getFullYear())</script> IEEE - All rights reserved. A public charity, IEEE is the world's largest technical professional organization dedicated to advancing technology for the benefit of humanity.
                </p>
            </div>
        </div>
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