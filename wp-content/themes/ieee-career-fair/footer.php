    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <!-- IEEE Standard Footer -->
        <div id="footer">
            <style type="text/css">
                #footer {
                    font-family: Verdana, Arial, Helvetica, sans-serif;
                    font-size: 100%;
                    color: #666;
                    background: #fff;
                    padding: 0;
                    border-top: 3px solid #999;
                    margin: 0;
                    text-align: center;
                }
                
                #footer p {
                    font-size: .9em;
                    line-height: 120%;
                    padding: 0 0 10px 0;
                    border: 0;
                    margin: 0;
                }
                
                #util {
                    color: #000;
                    text-align: left;
                    padding: 11px 36px;
                }
                
                #util a:link, #util a:visited, #util a:active {
                    color: #000;
                    text-decoration: none;
                }
                
                #util a:hover {
                    color: #000;
                    text-decoration: underline;
                }
            </style>
            
            <p id="util">
                <a href="http://www.ieee.org/index.html" id="u-home">Home</a> &#160;|&#160; 
                <a href="http://www.ieee.org/sitemap.html" id="u-home">Sitemap/More Sites</a> &#160;|&#160; 
                <a href="http://www.ieee.org/about/contact_center/index.html" id="u-contact">Contact</a> &#160;|&#160; 
                <a href="http://www.ieee.org/accessibility_statement.html" id="u-accessibility">Accessibility</a> &#160;|&#160; 
                <a href="http://www.ieee.org/p9-26.html" id="u-non">Nondiscrimination Policy</a> &#160;|&#160; 
                <a href="http://ieee-ethics-reporting.org/" id="u-ethics-reporting">IEEE Ethics Reporting</a> &#160;|&#160; 
                <a href="https://privacy.ieee.org/policies" id="u-privacy">IEEE Privacy Policy</a> &#160;|&#160; 
                <a href="https://www.ieee.org/about/help/site-terms-conditions.html" id="u-terms">Terms & Disclosures</a>
            </p>

            <p id="util">&copy; Copyright <?php echo date('Y'); ?> IEEE - All rights reserved. A public charity, IEEE is the world's largest technical professional organization dedicated to advancing technology for the benefit of humanity.</p>
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
});
</script>

</body>
</html> 