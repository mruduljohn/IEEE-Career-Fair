    </div><!-- #content -->

    <footer id="colophon" class="site-footer" style="background-color: #333333;">
        <div id="footer">
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

<style>
    #util {
        color: #fff;
        text-align: left;
        padding: 11px 36px;
    }

    #util a:link, #util a:visited, #util a:active {
        color: #fff;
        text-decoration: none;
    }

    #util a:hover {
        color: #fff;
        text-decoration: underline;
    }

    /* Back to top button */
    #back-to-top {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        background-color: #ffb81c;
        color: #000;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        text-align: center;
        line-height: 50px;
        cursor: pointer;
    }
</style>

<!-- Back to Top Button -->
<button id="back-to-top" aria-label="Back to top">
    <i class="fas fa-chevron-up"></i>
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