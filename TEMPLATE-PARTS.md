# WP-FUNDI Theme Template Parts

This document explains the reusable template parts system in the WP-FUNDI theme.

## Overview

Template parts are reusable PHP files that contain specific sections of a page. They promote code reusability, maintainability, and consistency across the theme.

## Available Template Parts

### 1. Header Template Parts

#### `header-main.php`

- **Purpose**: Main header content including site branding and navigation
- **Used in**: `header.php`
- **Features**:
  - Site logo or title display
  - Site description
  - Primary navigation menu
  - Mobile menu toggle
  - Proper semantic HTML structure

### 2. Footer Template Parts

#### `footer-main.php`

- **Purpose**: Main footer content including widgets and site info
- **Used in**: `footer.php`
- **Features**:
  - Footer widget areas (Footer One & Footer Two)
  - Widget placeholders when empty
  - Site information and copyright
  - Footer navigation menu
  - Theme credits

### 3. Content Template Parts

#### `content.php`

- **Purpose**: Standard post content display
- **Used in**: `index.php`, `single.php`, `archive.php`
- **Features**:
  - Post title and meta information
  - Featured image display
  - Post content or excerpt
  - Read more links
  - Entry footer with categories and tags

#### `content-page.php`

- **Purpose**: Page content display
- **Used in**: `page.php`
- **Features**:
  - Page title
  - Featured image
  - Page content
  - Edit link for logged-in users

#### `content-none.php`

- **Purpose**: Display when no content is found
- **Used in**: `index.php`, `archive.php`, `search.php`
- **Features**:
  - "Nothing here" message
  - Different messages for different contexts
  - Search form when appropriate

#### `content-portfolio.php`

- **Purpose**: Portfolio item display
- **Used in**: `portfolio.php`, `single-portfolio.php`
- **Features**:
  - Portfolio thumbnail with overlay effect
  - Portfolio title and meta information
  - Categories and tags display
  - Project details (client, date, URL)
  - Responsive grid layout

## Template Hierarchy

### Main Templates Using Template Parts

#### `header.php`

```php
<?php get_template_part( 'template-parts/header-main' ); ?>
```

#### `footer.php`

```php
<?php get_template_part( 'template-parts/footer-main' ); ?>
```

#### `index.php`

```php
<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
```

#### `portfolio.php`

```php
<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>
```

#### `single-portfolio.php`

```php
<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>
```

## Benefits of Template Parts

### 1. Code Reusability

- Same template part can be used in multiple templates
- Reduces code duplication
- Easier maintenance

### 2. Consistency

- Ensures consistent display across different templates
- Standardized HTML structure
- Uniform styling

### 3. Flexibility

- Easy to override specific parts
- Child theme friendly
- Modular architecture

### 4. Performance

- Efficient loading with `get_template_part()`
- Cached template parts
- Optimized file structure

## Creating New Template Parts

### 1. File Naming Convention

- Use descriptive names: `content-{type}.php`
- Follow WordPress naming conventions
- Place in `template-parts/` directory

### 2. Template Part Structure

```php
<?php
/**
 * Template part for displaying {description}
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<!-- Your template part content here -->
```

### 3. Using Template Parts

```php
// Basic usage
<?php get_template_part( 'template-parts/content', 'custom' ); ?>

// With variables
<?php get_template_part( 'template-parts/content', 'custom', array( 'custom_var' => $value ) ); ?>
```

## Portfolio Template System

### Portfolio Features

- **Grid Layout**: Responsive 3-column grid on desktop
- **Hover Effects**: Image overlay and scaling effects
- **Meta Information**: Categories, tags, and custom fields
- **Navigation**: Previous/next portfolio navigation
- **Custom Fields**: Client, date, and project URL support

### Portfolio Custom Fields

The portfolio template supports these custom fields:

- `_portfolio_client`: Client name
- `_portfolio_date`: Project completion date
- `_portfolio_project_url`: Live project URL

### Portfolio Taxonomies

- `portfolio_category`: Portfolio categories
- `portfolio_tag`: Portfolio tags

## Styling Template Parts

### CSS Classes

Each template part includes specific CSS classes:

- `.portfolio-item`: Portfolio item container
- `.portfolio-thumbnail`: Image container
- `.portfolio-overlay`: Hover overlay effect
- `.portfolio-content`: Content area
- `.portfolio-meta`: Meta information area

### Responsive Design

- Mobile-first approach
- Flexible grid layouts
- Touch-friendly interactions
- Optimized typography

## Child Theme Compatibility

### Overriding Template Parts

To override a template part in a child theme:

1. Copy the template part to your child theme
2. Place it in `template-parts/` directory
3. Modify as needed
4. The child theme version will be used automatically

### Example Child Theme Override

```markdown
child-theme/
├── template-parts/
│   ├── header-main.php (overrides parent)
│   └── content-custom.php (new template part)
```

## Best Practices

### 1. Security

- Always include security check: `if ( ! defined( 'ABSPATH' ) ) exit;`
- Escape all output with appropriate functions
- Sanitize user input

### 2. Performance

- Use `get_template_part()` instead of `include`
- Minimize database queries
- Cache expensive operations

### 3. Accessibility

- Use semantic HTML elements
- Include proper ARIA labels
- Ensure keyboard navigation
- Maintain color contrast

### 4. Internationalization

- Use translation functions: `esc_html__()`, `esc_html_e()`
- Provide context for translators
- Test with different languages

## Browser Support

Template parts work in all modern browsers:

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Troubleshooting

### Common Issues

1. **Template part not loading**
   - Check file path and naming
   - Verify file permissions
   - Clear any caching plugins

2. **Styling issues**
   - Check CSS class names
   - Verify CSS file loading
   - Use browser developer tools

3. **Content not displaying**
   - Check conditional logic
   - Verify data availability
   - Test with different content types

### Debug Mode

Enable WordPress debug mode to see template part loading:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
```
