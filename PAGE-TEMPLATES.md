# WP-FUNDI Page Templates

This document explains the custom page templates available in the WP-FUNDI theme.

## Overview

The WP-FUNDI theme includes two distinct page templates that provide different layouts and styling options for pages. Each template is designed with specific use cases in mind and offers unique visual experiences.

## Available Templates

### 1. Template – Minimalist

**File**: `page-minimalist.php`  
**Block Template**: `block-templates/page-minimalist.html`  
**Purpose**: Clean, focused content layout with minimal distractions

#### Features
- **Clean Layout**: Centered content with generous white space
- **Typography Focus**: Large, readable fonts with optimal line spacing
- **Minimal Design**: No sidebars, cards, or complex layouts
- **Featured Image**: Optional hero image with subtle hover effects
- **Content Width**: 600px max-width for optimal reading experience

#### Design Characteristics
- **Font Sizes**: Large, readable typography (1.125rem body text)
- **Spacing**: Generous margins and padding for breathing room
- **Colors**: Subtle use of color with focus on readability
- **Interactions**: Minimal hover effects and transitions

#### Best Use Cases
- Blog posts and articles
- About pages
- Documentation
- Long-form content
- Pages requiring focus and readability

#### CSS Classes
```css
.minimalist-template
.minimalist-container
.minimalist-content
.minimalist-header
.minimalist-featured-image
.minimalist-title-wrapper
.minimalist-title
.minimalist-excerpt
.minimalist-body
.minimalist-content-wrapper
.minimalist-footer
```

### 2. Template – Creative

**File**: `page-creative.php`  
**Block Template**: `block-templates/page-creative.html`  
**Purpose**: Dynamic, visually engaging layout with enhanced elements

#### Features
- **Hero Section**: Full-width featured image with overlay text
- **Grid Layout**: Two-column layout with main content and sidebar
- **Visual Elements**: Cards, shadows, gradients, and animations
- **Social Sharing**: Built-in social media sharing buttons
- **Navigation**: Post navigation with enhanced styling
- **Rich Typography**: Multiple heading styles with decorative elements

#### Design Characteristics
- **Hero Image**: 60vh height with gradient overlay
- **Typography**: Bold headings with decorative accents
- **Cards**: Elevated content areas with shadows
- **Colors**: Rich color palette with gradients
- **Interactions**: Hover effects, transforms, and animations

#### Best Use Cases
- Portfolio pages
- Landing pages
- Product showcases
- Creative content
- Pages requiring visual impact

#### CSS Classes
```css
.creative-template
.creative-container
.creative-content
.creative-header
.creative-hero
.creative-featured-image
.creative-title-section
.creative-title-wrapper
.creative-title
.creative-excerpt
.creative-meta
.creative-body
.creative-content-wrapper
.creative-main-content
.creative-sidebar
.creative-actions
.creative-share
.creative-footer
.creative-navigation
```

## Template Selection

### How to Use

1. **Edit a Page**: Go to Pages > All Pages and edit any page
2. **Page Attributes**: In the Page Attributes meta box, find "Template"
3. **Select Template**: Choose either "Template – Minimalist" or "Template – Creative"
4. **Update**: Save the page to apply the template

### Block Editor Integration

Both templates are available as block templates in the WordPress Block Editor:

1. **Create New Page**: Go to Pages > Add New
2. **Template Options**: Click the template icon in the top toolbar
3. **Choose Template**: Select from "Minimalist" or "Creative" templates
4. **Customize**: Edit the template blocks as needed

## Technical Implementation

### PHP Templates

#### Minimalist Template Structure
```php
<main class="site-main minimalist-template">
    <div class="minimalist-container">
        <article class="minimalist-content">
            <header class="minimalist-header">
                <!-- Featured image and title -->
            </header>
            <div class="minimalist-body">
                <!-- Main content -->
            </div>
            <footer class="minimalist-footer">
                <!-- Edit link -->
            </footer>
        </article>
    </div>
</main>
```

#### Creative Template Structure
```php
<main class="site-main creative-template">
    <div class="creative-container">
        <article class="creative-content">
            <header class="creative-header">
                <!-- Hero section with featured image -->
            </header>
            <div class="creative-body">
                <div class="creative-content-wrapper">
                    <div class="creative-main-content">
                        <!-- Main content -->
                    </div>
                    <aside class="creative-sidebar">
                        <!-- Actions and sharing -->
                    </aside>
                </div>
            </div>
            <footer class="creative-footer">
                <!-- Navigation -->
            </footer>
        </article>
    </div>
</main>
```

### Block Templates

#### Minimalist Block Template
```html
<!-- wp:group {"className":"minimalist-template"} -->
<div class="wp-block-group minimalist-template">
    <!-- wp:post-featured-image /-->
    <!-- wp:post-title /-->
    <!-- wp:post-excerpt /-->
    <!-- wp:post-content /-->
</div>
<!-- /wp:group -->
```

#### Creative Block Template
```html
<!-- wp:group {"className":"creative-template"} -->
<div class="wp-block-group creative-template">
    <!-- wp:group {"className":"creative-hero"} -->
    <div class="wp-block-group creative-hero">
        <!-- wp:post-featured-image /-->
        <!-- wp:post-title /-->
        <!-- wp:post-excerpt /-->
    </div>
    <!-- /wp:group -->
    <!-- wp:columns {"className":"creative-content-wrapper"} -->
    <div class="wp-block-columns creative-content-wrapper">
        <!-- wp:column {"className":"creative-main-content"} -->
        <div class="wp-block-column creative-main-content">
            <!-- wp:post-content /-->
        </div>
        <!-- /wp:column -->
        <!-- wp:column {"className":"creative-sidebar"} -->
        <div class="wp-block-column creative-sidebar">
            <!-- wp:social-links /-->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
```

## Responsive Design

### Breakpoints

Both templates are fully responsive with the following breakpoints:

- **Desktop**: 1024px and above
- **Tablet**: 768px to 1023px
- **Mobile**: 767px and below

### Responsive Features

#### Minimalist Template
- **Mobile**: Reduced padding and font sizes
- **Tablet**: Maintains centered layout
- **Desktop**: Full typography and spacing

#### Creative Template
- **Mobile**: Single column layout, reduced hero height
- **Tablet**: Sidebar moves above content
- **Desktop**: Full two-column layout

## Customization

### CSS Custom Properties

Both templates use CSS custom properties for easy customization:

```css
:root {
    --color-background: #ffffff;
    --color-text: #333333;
    --color-heading: #333333;
    --color-link: #0073aa;
    --color-link-hover: #005177;
    --color-border: #e9ecef;
    --color-card-background: #ffffff;
    --color-card-border: #e9ecef;
    --color-shadow: rgba(0, 0, 0, 0.1);
}
```

### Child Theme Overrides

To customize templates in a child theme:

```php
// In child theme's functions.php
function child_theme_page_templates( $templates ) {
    // Override template registration
    return $templates;
}
add_filter( 'theme_page_templates', 'child_theme_page_templates' );
```

### CSS Overrides

```css
/* Override minimalist template styles */
.minimalist-title {
    font-size: 4rem;
    color: #ff0000;
}

/* Override creative template styles */
.creative-hero {
    height: 80vh;
    background: linear-gradient(45deg, #ff0000, #00ff00);
}
```

## Dark Mode Support

Both templates fully support the theme's dark mode functionality:

- **Automatic**: Templates automatically adapt to dark mode
- **CSS Variables**: All colors use CSS custom properties
- **Smooth Transitions**: Color changes are animated
- **Consistent**: Dark mode works across all template elements

## Performance Considerations

### Optimizations
- **CSS**: Efficient selectors and minimal specificity
- **Images**: Responsive images with proper sizing
- **JavaScript**: No additional JavaScript required
- **Loading**: Templates load with the main theme styles

### Best Practices
- **Images**: Optimize featured images for web
- **Content**: Use appropriate content lengths for each template
- **Plugins**: Ensure compatibility with page builder plugins

## Browser Support

### Modern Browsers
- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

### Fallback Support
- **CSS Grid**: Graceful degradation for older browsers
- **Flexbox**: Fallback layouts for IE11
- **CSS Variables**: Fallback values provided

## Troubleshooting

### Common Issues

1. **Template not appearing in dropdown**
   - Check if template files exist
   - Verify theme activation
   - Clear any caching plugins

2. **Styles not loading**
   - Check CSS file paths
   - Verify theme enqueue functions
   - Clear browser cache

3. **Block template not working**
   - Ensure block template support is enabled
   - Check file permissions
   - Verify WordPress version (5.9+)

### Debug Mode

Enable WordPress debug mode to see template-related errors:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
```

## Future Enhancements

### Planned Features
- **Additional Templates**: More layout options
- **Template Builder**: Visual template customization
- **A/B Testing**: Template performance comparison
- **Analytics**: Template usage tracking

### API Extensions
```php
// Future template API
wp_fundi_get_available_templates();
wp_fundi_get_template_styles( $template );
wp_fundi_customize_template( $template, $options );
```

## Conclusion

The WP-FUNDI page templates provide flexible, modern layouts for different content types. The minimalist template focuses on readability and content, while the creative template emphasizes visual impact and engagement. Both templates are fully responsive, accessible, and integrate seamlessly with the theme's customization options.
