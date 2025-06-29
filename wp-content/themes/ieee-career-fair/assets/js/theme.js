/**
 * IEEE Career Fair Theme JavaScript
 * 
 * Handles all interactive functionality for the theme including:
 * - Navigation behavior
 * - Smooth scrolling
 * - Animation triggers
 * - Form handling
 * - Performance optimizations
 * 
 * @package IEEE_Career_Fair
 * @version 1.0
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        
        // Initialize all components
        initNavigation();
        initSmoothScrolling();
        initCollapsibleSections();
        initFormHandling();
        initAccessibility();
        initPerformanceOptimizations();
        
        // Initialize AOS if available
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });
        }
    });

    /**
     * Navigation Functionality
     * Handles mobile menu, scroll behavior, and active states
     */
    function initNavigation() {
        const navbar = $('.navbar');
        const navbarToggler = $('.navbar-toggler');
        const navbarCollapse = $('.navbar-collapse');
        
        // Handle navbar scroll behavior
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 50) {
                navbar.addClass('scrolled');
            } else {
                navbar.removeClass('scrolled');
            }
        });
        
        // Close mobile menu when clicking on a link
        $('.navbar-nav .nav-link').on('click', function() {
            if (navbarCollapse.hasClass('show')) {
                navbarToggler.click();
            }
        });
        
        // Highlight active navigation item based on scroll position
        const sections = $('section[id]');
        const navLinks = $('.navbar-nav .nav-link[href^="#"]');
        
        $(window).on('scroll', function() {
            let current = '';
            
            sections.each(function() {
                const sectionTop = $(this).offset().top - 100;
                if ($(window).scrollTop() >= sectionTop) {
                    current = $(this).attr('id');
                }
            });
            
            navLinks.removeClass('active');
            if (current) {
                navLinks.filter('[href="#' + current + '"]').addClass('active');
            }
        });
    }

    /**
     * Smooth Scrolling
     * Implements smooth scrolling for anchor links with proper offset
     */
    function initSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                
                const offset = 80; // Account for fixed header
                const targetPosition = target.offset().top - offset;
                
                $('html, body').animate({
                    scrollTop: targetPosition
                }, 800, 'easeInOutQuart');
            }
        });
        
        // Add easing function if not available
        if (!$.easing.easeInOutQuart) {
            $.easing.easeInOutQuart = function(x, t, b, c, d) {
                if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
                return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
            };
        }
    }

    /**
     * Collapsible Sections
     * Enhanced accordion/collapsible functionality
     */
    function initCollapsibleSections() {
        $('.collapsible-header').on('click', function() {
            const $this = $(this);
            const $content = $this.next('.collapsible-content');
            const $icon = $this.find('.collapsible-icon');
            
            // Toggle content
            $content.slideToggle(300);
            
            // Toggle icon rotation
            $icon.toggleClass('open');
            
            // Update ARIA attributes for accessibility
            const isExpanded = $content.is(':visible');
            $this.attr('aria-expanded', isExpanded);
        });
    }

    /**
     * Form Handling
     * Handles newsletter subscription and contact forms
     */
    function initFormHandling() {
        // Newsletter form
        $('#newsletter-form').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $email = $form.find('input[type="email"]');
            const $button = $form.find('button[type="submit"]');
            const email = $email.val();
            
            if (!email || !isValidEmail(email)) {
                showMessage($form, 'error', ieee_i18n.invalid_email || 'Please enter a valid email address.');
                return;
            }
            
            // Show loading state
            $button.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
            
            // Simulate form submission (replace with actual AJAX call)
            setTimeout(function() {
                showMessage($form, 'success', ieee_i18n.newsletter_success || 'Thank you for subscribing!');
                $form[0].reset();
                $button.html('<i class="fas fa-paper-plane"></i>').prop('disabled', false);
            }, 1000);
        });
        
        // Contact forms with enhanced validation
        $('.contact-form').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const isValid = validateForm($form);
            
            if (isValid) {
                submitForm($form);
            }
        });
    }

    /**
     * Email Validation
     */
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    /**
     * Form Validation
     */
    function validateForm($form) {
        let isValid = true;
        
        $form.find('input[required], textarea[required], select[required]').each(function() {
            const $field = $(this);
            const value = $field.val().trim();
            
            if (!value) {
                showFieldError($field, ieee_i18n.required_field || 'This field is required.');
                isValid = false;
            } else {
                clearFieldError($field);
                
                // Additional validation based on field type
                if ($field.attr('type') === 'email' && !isValidEmail(value)) {
                    showFieldError($field, ieee_i18n.invalid_email || 'Please enter a valid email address.');
                    isValid = false;
                }
            }
        });
        
        return isValid;
    }

    /**
     * Show field error
     */
    function showFieldError($field, message) {
        $field.addClass('is-invalid');
        
        let $error = $field.next('.invalid-feedback');
        if (!$error.length) {
            $error = $('<div class="invalid-feedback"></div>');
            $field.after($error);
        }
        $error.text(message);
    }

    /**
     * Clear field error
     */
    function clearFieldError($field) {
        $field.removeClass('is-invalid');
        $field.next('.invalid-feedback').remove();
    }

    /**
     * Submit form via AJAX
     */
    function submitForm($form) {
        const $button = $form.find('button[type="submit"]');
        const originalText = $button.html();
        
        // Show loading state
        $button.html('<i class="fas fa-spinner fa-spin me-2"></i>' + (ieee_i18n.sending || 'Sending...')).prop('disabled', true);
        
        // Prepare form data
        const formData = new FormData($form[0]);
        formData.append('action', 'ieee_submit_form');
        formData.append('nonce', ieee_ajax.nonce);
        
        // Submit via AJAX
        $.ajax({
            url: ieee_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    showMessage($form, 'success', response.data.message);
                    $form[0].reset();
                } else {
                    showMessage($form, 'error', response.data.message || ieee_i18n.form_error || 'An error occurred. Please try again.');
                }
            },
            error: function() {
                showMessage($form, 'error', ieee_i18n.form_error || 'An error occurred. Please try again.');
            },
            complete: function() {
                $button.html(originalText).prop('disabled', false);
            }
        });
    }

    /**
     * Show form message
     */
    function showMessage($form, type, message) {
        let $alert = $form.find('.form-alert');
        
        if (!$alert.length) {
            $alert = $('<div class="form-alert alert alert-dismissible fade show mt-3" role="alert"></div>');
            $form.append($alert);
        }
        
        $alert.removeClass('alert-success alert-danger alert-info')
              .addClass('alert-' + (type === 'error' ? 'danger' : type))
              .html(message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>');
        
        // Auto-hide success messages
        if (type === 'success') {
            setTimeout(function() {
                $alert.alert('close');
            }, 5000);
        }
    }

    /**
     * Accessibility Enhancements
     */
    function initAccessibility() {
        // Keyboard navigation for dropdowns
        $('.dropdown-toggle').on('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                $(this).click();
            }
        });
        
        // Focus management for modals
        $(document).on('shown.bs.modal', '.modal', function() {
            $(this).find('[autofocus]').focus();
        });
        
        // Skip to content functionality
        $('.skip-to-content').on('click', function(e) {
            e.preventDefault();
            const target = $($(this).attr('href'));
            if (target.length) {
                target.attr('tabindex', '-1').focus();
            }
        });
        
        // Announce dynamic content changes to screen readers
        function announceToScreenReader(message) {
            const $announcer = $('#screen-reader-announcements');
            if ($announcer.length) {
                $announcer.text(message);
            }
        }
    }

    /**
     * Performance Optimizations
     */
    function initPerformanceOptimizations() {
        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-load');
                        img.classList.add('lazy-loaded');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
        
        // Debounced scroll handler
        let scrollTimeout;
        $(window).on('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                handleScroll();
            }, 10);
        });
        
        // Preload critical assets
        preloadCriticalAssets();
    }

    /**
     * Handle scroll events
     */
    function handleScroll() {
        const scrollTop = $(window).scrollTop();
        
        // Show/hide back to top button
        const $backToTop = $('#back-to-top');
        if (scrollTop > 300) {
            $backToTop.fadeIn();
        } else {
            $backToTop.fadeOut();
        }
        
        // Parallax effect for hero section
        const $hero = $('.hero-section');
        if ($hero.length && scrollTop < $hero.height()) {
            $hero.css('transform', 'translateY(' + scrollTop * 0.5 + 'px)');
        }
    }

    /**
     * Preload critical assets
     */
    function preloadCriticalAssets() {
        // Preload hero background image
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            const bgImage = window.getComputedStyle(heroSection).backgroundImage;
            if (bgImage && bgImage !== 'none') {
                const imageUrl = bgImage.slice(4, -1).replace(/"/g, '');
                const img = new Image();
                img.src = imageUrl;
            }
        }
    }

    /**
     * Counter Animation
     */
    function animateCounters() {
        $('.stat-number').each(function() {
            const $this = $(this);
            const target = parseInt($this.data('target'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const timer = setInterval(function() {
                current += increment;
                if (current >= target) {
                    $this.text(target.toLocaleString());
                    clearInterval(timer);
                } else {
                    $this.text(Math.floor(current).toLocaleString());
                }
            }, 16);
        });
    }

    /**
     * Initialize counter animation when stats section is visible
     */
    if ('IntersectionObserver' in window) {
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        });
        
        const statsSection = document.getElementById('stats');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }
    }

    /**
     * Back to top button functionality
     */
    $(document).on('click', '#back-to-top', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 800, 'easeInOutQuart');
    });

    /**
     * Copy to clipboard functionality
     */
    window.copyToClipboard = function(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(function() {
                showToast(ieee_i18n.link_copied || 'Link copied to clipboard!');
            });
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showToast(ieee_i18n.link_copied || 'Link copied to clipboard!');
        }
    };

    /**
     * Show toast notification
     */
    function showToast(message) {
        const toast = $('<div class="toast-notification position-fixed bg-success text-white p-3 rounded" style="top: 20px; right: 20px; z-index: 9999;">' + message + '</div>');
        $('body').append(toast);
        
        setTimeout(function() {
            toast.fadeOut(function() {
                toast.remove();
            });
        }, 3000);
    }

    /**
     * Initialize tooltips and popovers
     */
    if (typeof bootstrap !== 'undefined') {
        // Initialize Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Initialize Bootstrap popovers
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    }

})(jQuery);

/**
 * Vanilla JavaScript for critical functionality
 * (Runs before jQuery is loaded)
 */
document.addEventListener('DOMContentLoaded', function() {
    
    // Add loading states to forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
            }
        });
    });
    
    // Handle external links
    const externalLinks = document.querySelectorAll('a[href^="http"]:not([href*="' + window.location.hostname + '"])');
    externalLinks.forEach(link => {
        link.setAttribute('target', '_blank');
        link.setAttribute('rel', 'noopener noreferrer');
    });
    
    // Add focus styles for keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });
    
    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });
    
});

/**
 * Service Worker Registration for PWA capabilities
 */
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js').then(function(registration) {
            console.log('ServiceWorker registration successful');
        }).catch(function(err) {
            console.log('ServiceWorker registration failed');
        });
    });
} 