# WP-FUNDI Theme Colors and Typography

This document explains the color palette and typography presets available in the WP-FUNDI theme.

## Color Palette

The theme includes a comprehensive color palette with 10 predefined colors:

### Primary Colors

- **Primary**: `#0073aa` - Main brand color
- **Secondary**: `#005177` - Darker variant of primary
- **Accent**: `#00a0d2` - Lighter accent color

### Neutral Colors

- **Background**: `#ffffff` - White background
- **Dark Gray**: `#333333` - Dark text color
- **Medium Gray**: `#666666` - Secondary text color
- **Light Gray**: `#f8f9fa` - Light background color

### Status Colors

- **Success**: `#28a745` - Green for success messages
- **Warning**: `#ffc107` - Yellow for warnings
- **Error**: `#dc3545` - Red for errors

## Typography Presets

### Font Families

The theme includes 6 font family presets with proper fallback stacks:

1. **Inter (System Fonts)**: `Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif`
2. **Poppins**: `Poppins, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif`
3. **Open Sans**: `Open Sans, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif`
4. **Lato**: `Lato, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif`
5. **Merriweather (Serif)**: `Merriweather, Georgia, "Times New Roman", Times, serif`
6. **Source Code Pro (Monospace)**: `"Source Code Pro", Monaco, Consolas, "Liberation Mono", "Courier New", monospace`

### Font Sizes

The theme includes 6 predefined font sizes:

- **Small**: 14px
- **Regular**: 16px (default)
- **Medium**: 18px
- **Large**: 24px
- **Extra Large**: 32px
- **Huge**: 48px

## Gradient Presets

The theme includes 5 gradient presets:

1. **Primary to Secondary**: `linear-gradient(135deg, #0073aa 0%, #005177 100%)`
2. **Primary to Accent**: `linear-gradient(135deg, #0073aa 0%, #00a0d2 100%)`
3. **Warm Gradient**: `linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%)`
4. **Cool Gradient**: `linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%)`
5. **Dark Gradient**: `linear-gradient(135deg, #2c3e50 0%, #34495e 100%)`

## Usage in Block Editor

### Colors

In the WordPress block editor, you can access these colors through:

- **Text Color**: Available in the block toolbar
- **Background Color**: Available in the block settings panel
- **Link Color**: Available in link settings

### Typography

Typography options are available in the block settings panel:

- **Font Family**: Choose from the 6 predefined font families
- **Font Size**: Select from the 6 predefined sizes
- **Line Height**: Adjustable through the typography panel

### Gradients

Gradient backgrounds are available in the block settings panel under the background section.

## CSS Custom Properties

All colors, fonts, and gradients are available as CSS custom properties:

```css
/* Colors */
--wp--preset--color--primary: #0073aa;
--wp--preset--color--secondary: #005177;
--wp--preset--color--accent: #00a0d2;
/* ... and more */

/* Font Families */
--wp--preset--font-family--inter-system: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
--wp--preset--font-family--poppins: Poppins, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
/* ... and more */

/* Font Sizes */
--wp--preset--font-size--small: 14px;
--wp--preset--font-size--regular: 16px;
/* ... and more */

/* Gradients */
--wp--preset--gradient--primary-to-secondary: linear-gradient(135deg, #0073aa 0%, #005177 100%);
/* ... and more */
```

## Utility Classes

The theme includes utility classes for all presets:

### Color Classes

```css
.has-primary-color { color: var(--wp--preset--color--primary) !important; }
.has-primary-background-color { background-color: var(--wp--preset--color--primary) !important; }
/* ... and more for all colors */
```

### Typography Classes

```css
.has-inter-system-font-family { font-family: var(--wp--preset--font-family--inter-system) !important; }
.has-large-font-size { font-size: var(--wp--preset--font-size--large) !important; }
/* ... and more for all fonts and sizes */
```

### Gradient Classes

```css
.has-primary-to-secondary-gradient-background { background: var(--wp--preset--gradient--primary-to-secondary) !important; }
/* ... and more for all gradients */
```

## Customization

### Adding New Colors

To add new colors, modify the `get_color_palette()` method in `functions.php`:

```php
array(
    'name'  => esc_html__( 'Custom Color', 'wp-fundi' ),
    'slug'  => 'custom-color',
    'color' => '#your-color-code',
),
```

### Adding New Font Families

To add new font families, modify the `get_font_families()` method in `functions.php`:

```php
array(
    'fontFamily' => 'Your Font, fallback, sans-serif',
    'name'       => esc_html__( 'Your Font Name', 'wp-fundi' ),
    'slug'       => 'your-font-slug',
),
```

### Adding New Gradients

To add new gradients, modify the `get_gradient_presets()` method in `functions.php`:

```php
array(
    'name'     => esc_html__( 'Your Gradient Name', 'wp-fundi' ),
    'gradient' => 'linear-gradient(135deg, #color1 0%, #color2 100%)',
    'slug'     => 'your-gradient-slug',
),
```

## Browser Support

All color and typography features are supported in:

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Performance

- CSS custom properties provide excellent performance
- Font fallbacks ensure text is always readable
- Gradients are CSS-based for optimal performance
- All presets are loaded efficiently through WordPress theme support
