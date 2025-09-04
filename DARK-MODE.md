# WP-FUNDI Dark Mode Implementation

This document explains the dark mode functionality implemented in the WP-FUNDI theme.

## Overview

The WP-FUNDI theme includes a comprehensive dark mode toggle that allows users to switch between light and dark color schemes. The implementation uses CSS custom properties (CSS variables) for dynamic theming, localStorage for preference persistence, and provides a smooth user experience with accessibility features.

## Features

### 🌙 Dark Mode Toggle
- **Location**: Header (top-right corner)
- **Design**: Circular button with sun/moon icons
- **Functionality**: Instant theme switching
- **Persistence**: Saves preference in localStorage
- **Accessibility**: Full keyboard navigation and screen reader support

### 🎨 Color Schemes

#### Light Mode (Default)
```css
:root {
    --color-background: #ffffff;
    --color-text: #333333;
    --color-text-secondary: #666666;
    --color-heading: #333333;
    --color-link: #0073aa;
    --color-link-hover: #005177;
    --color-border: #e9ecef;
    --color-card-background: #ffffff;
    --color-card-border: #e9ecef;
    --color-shadow: rgba(0, 0, 0, 0.1);
    --color-input-background: #ffffff;
    --color-input-border: #ced4da;
}
```

#### Dark Mode
```css
[data-theme="dark"] {
    --color-background: #1a1a1a;
    --color-text: #e9ecef;
    --color-text-secondary: #adb5bd;
    --color-heading: #ffffff;
    --color-link: #4dabf7;
    --color-link-hover: #74c0fc;
    --color-border: #495057;
    --color-card-background: #2d3748;
    --color-card-border: #495057;
    --color-shadow: rgba(0, 0, 0, 0.3);
    --color-input-background: #2d3748;
    --color-input-border: #495057;
}
```

## Technical Implementation

### HTML Structure
```html
<button id="dark-mode-toggle" class="dark-mode-toggle" 
        aria-label="Toggle dark mode" 
        title="Toggle dark mode">
    <span class="dark-mode-icon">
        <svg class="sun-icon">...</svg>
        <svg class="moon-icon">...</svg>
    </span>
    <span class="screen-reader-text">Toggle dark mode</span>
</button>
```

### CSS Implementation
- **CSS Custom Properties**: Dynamic color variables
- **Data Attribute**: `[data-theme="dark"]` for theme switching
- **Smooth Transitions**: 0.3s ease transitions for all color changes
- **Icon Animations**: Rotating and opacity transitions for sun/moon icons

### JavaScript Functionality
```javascript
// Core functions
window.wpFundiTheme = {
    toggleTheme: toggleTheme,
    applyTheme: applyTheme,
    getCurrentTheme: function() {
        return htmlElement.getAttribute('data-theme') || 'light';
    }
};
```

## Key Features

### 🔄 Automatic Theme Detection
- **System Preference**: Respects `prefers-color-scheme` media query
- **User Override**: User preference takes precedence over system preference
- **Fallback**: Defaults to light mode if no preference is set

### 💾 Persistent Storage
- **localStorage Key**: `wp-fundi-theme-preference`
- **Values**: `'light'` or `'dark'`
- **Scope**: Per-domain storage
- **Persistence**: Survives browser sessions and page reloads

### ⌨️ Accessibility Features
- **Keyboard Navigation**: Full keyboard support (Enter, Space)
- **Screen Reader**: Proper ARIA labels and descriptions
- **Focus Management**: Visible focus indicators
- **High Contrast**: Maintains readability in both themes

### 🎯 User Experience
- **Instant Switching**: No page reload required
- **Smooth Transitions**: Animated color changes
- **Visual Feedback**: Icon state changes
- **Responsive Design**: Works on all screen sizes

## Integration with Customizer

### Customizer Compatibility
The dark mode system works seamlessly with WordPress Customizer settings:

- **Background Color**: Customizer colors override default light mode colors
- **Heading Color**: Customizer heading colors apply to both themes
- **Link Hover Color**: Customizer link colors work in both modes
- **Font Settings**: Typography settings apply to both themes

### CSS Variable Updates
```javascript
// Customizer updates CSS variables for both themes
wp.customize('wp_fundi_background_color', function(value) {
    value.bind(function(to) {
        $(':root').css('--color-background', to);
        $('body').css('background-color', to);
    });
});
```

## Browser Support

### Modern Browsers
- Chrome 49+
- Firefox 31+
- Safari 9.1+
- Edge 16+

### Fallback Support
- **CSS Variables**: Graceful degradation for older browsers
- **localStorage**: Feature detection before use
- **Media Queries**: Progressive enhancement

## Usage Examples

### Programmatic Theme Control
```javascript
// Toggle theme
window.wpFundiTheme.toggleTheme();

// Apply specific theme
window.wpFundiTheme.applyTheme('dark');

// Get current theme
const currentTheme = window.wpFundiTheme.getCurrentTheme();
```

### CSS Customization
```css
/* Override dark mode colors */
[data-theme="dark"] {
    --color-background: #000000;
    --color-text: #ffffff;
}

/* Add custom dark mode styles */
[data-theme="dark"] .custom-element {
    background-color: var(--color-card-background);
    color: var(--color-text);
}
```

### Child Theme Integration
```php
// In child theme's functions.php
function child_theme_dark_mode_colors() {
    ?>
    <style>
    [data-theme="dark"] {
        --color-background: #0a0a0a;
        --color-text: #f0f0f0;
    }
    </style>
    <?php
}
add_action('wp_head', 'child_theme_dark_mode_colors');
```

## Performance Considerations

### Optimizations
- **CSS Variables**: Efficient color switching without DOM manipulation
- **Minimal JavaScript**: Lightweight implementation
- **Cached Preferences**: localStorage reduces repeated calculations
- **Smooth Transitions**: Hardware-accelerated CSS transitions

### Loading Strategy
- **Critical CSS**: Theme variables loaded inline
- **Progressive Enhancement**: Works without JavaScript
- **Lazy Loading**: Icons and animations load on demand

## Troubleshooting

### Common Issues

1. **Theme not persisting**
   - Check localStorage availability
   - Verify JavaScript is enabled
   - Clear browser cache

2. **Colors not updating**
   - Check CSS variable support
   - Verify data-theme attribute
   - Inspect CSS custom properties

3. **Toggle not working**
   - Check JavaScript console for errors
   - Verify button ID exists
   - Test keyboard navigation

### Debug Mode
```javascript
// Enable debug logging
localStorage.setItem('wp-fundi-debug', 'true');

// Check current state
console.log('Current theme:', window.wpFundiTheme.getCurrentTheme());
console.log('Stored preference:', localStorage.getItem('wp-fundi-theme-preference'));
```

## Future Enhancements

### Potential Additions
- **Auto-switch**: Time-based theme switching
- **Multiple Themes**: More than just light/dark
- **Custom Themes**: User-defined color schemes
- **Animation Options**: Customizable transition effects
- **Theme Scheduling**: Automatic theme changes

### API Extensions
```javascript
// Future API possibilities
window.wpFundiTheme = {
    // Current functions...
    
    // Future additions
    setAutoSwitch: function(enabled, time) {},
    addCustomTheme: function(name, colors) {},
    getAvailableThemes: function() {},
    setTransitionDuration: function(duration) {}
};
```

## Security Considerations

### Data Storage
- **localStorage**: Client-side only, no server transmission
- **No Sensitive Data**: Only theme preference stored
- **XSS Protection**: Proper input sanitization
- **CSRF Safe**: No server-side state changes

### Privacy
- **No Tracking**: Theme preference not sent to servers
- **Local Only**: All data stays in user's browser
- **Opt-in**: User explicitly chooses theme

## Testing

### Manual Testing
1. **Toggle Functionality**: Click toggle button
2. **Keyboard Navigation**: Use Tab, Enter, Space
3. **Persistence**: Reload page, check theme
4. **System Preference**: Change OS theme preference
5. **Customizer Integration**: Test with custom colors

### Automated Testing
```javascript
// Example test cases
describe('Dark Mode', function() {
    it('should toggle theme on button click', function() {
        // Test implementation
    });
    
    it('should persist theme preference', function() {
        // Test implementation
    });
    
    it('should respect system preference', function() {
        // Test implementation
    });
});
```

## Conclusion

The WP-FUNDI dark mode implementation provides a comprehensive, accessible, and performant solution for theme switching. It integrates seamlessly with WordPress Customizer, maintains user preferences, and offers a smooth user experience across all devices and browsers.
