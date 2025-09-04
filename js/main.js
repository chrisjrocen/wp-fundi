/**
 * Main JavaScript file for WP-FUNDI theme
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

(function() {
    'use strict';

    // Mobile menu toggle functionality
    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.main-navigation');

    if (menuToggle && navigation) {
        menuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            this.setAttribute('aria-expanded', !isExpanded);
            navigation.classList.toggle('toggled');
            document.body.classList.toggle('menu-open');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navigation.contains(event.target) && !menuToggle.contains(event.target)) {
                menuToggle.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('toggled');
                document.body.classList.remove('menu-open');
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && navigation.classList.contains('toggled')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('toggled');
                document.body.classList.remove('menu-open');
            }
        });
    }

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                event.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add focus styles for keyboard navigation
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });

    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });

    // Dark Mode Toggle Functionality
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const htmlElement = document.documentElement;
    const STORAGE_KEY = 'wp-fundi-theme-preference';
    const THEME_ATTRIBUTE = 'data-theme';

    // Check for saved theme preference or default to 'light'
    const currentTheme = localStorage.getItem(STORAGE_KEY) || 'light';
    
    // Apply the saved theme on page load
    function applyTheme(theme) {
        htmlElement.setAttribute(THEME_ATTRIBUTE, theme);
        localStorage.setItem(STORAGE_KEY, theme);
        
        // Update toggle button state
        if (darkModeToggle) {
            const isDark = theme === 'dark';
            darkModeToggle.setAttribute('aria-pressed', isDark);
            darkModeToggle.setAttribute('aria-label', 
                isDark ? 'Switch to light mode' : 'Switch to dark mode'
            );
        }
    }

    // Toggle between light and dark themes
    function toggleTheme() {
        const currentTheme = htmlElement.getAttribute(THEME_ATTRIBUTE) || 'light';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        applyTheme(newTheme);
    }

    // Initialize theme on page load
    applyTheme(currentTheme);

    // Add click event listener to toggle button
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', toggleTheme);
        
        // Add keyboard support
        darkModeToggle.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggleTheme();
            }
        });
    }

    // Listen for system theme changes
    if (window.matchMedia) {
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        
        // Only apply system preference if no user preference is saved
        if (!localStorage.getItem(STORAGE_KEY)) {
            mediaQuery.addEventListener('change', function(event) {
                const systemTheme = event.matches ? 'dark' : 'light';
                applyTheme(systemTheme);
            });
        }
    }

    // Expose theme functions globally for external use
    window.wpFundiTheme = {
        toggleTheme: toggleTheme,
        applyTheme: applyTheme,
        getCurrentTheme: function() {
            return htmlElement.getAttribute(THEME_ATTRIBUTE) || 'light';
        }
    };

})();
