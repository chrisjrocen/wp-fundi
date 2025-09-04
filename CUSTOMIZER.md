# WP-FUNDI Theme Customizer

This document explains the WordPress Customizer functionality in the WP-FUNDI theme.

## Overview

The WP-FUNDI theme includes a comprehensive Customizer panel called "Fundi Styles" that allows users to customize the appearance of their site with live preview functionality.

## Customizer Panel: Fundi Styles

### Location
- **Access**: Appearance > Customize > Fundi Styles
- **Priority**: 30 (appears after Site Identity)

### Panel Description
"Customize the appearance of your site with these style options."

## Available Sections

### 1. Colors Section

#### Background Color
- **Setting**: `wp_fundi_background_color`
- **Default**: `#ffffff` (white)
- **Description**: Choose the background color for your site
- **Control Type**: Color Picker
- **Sanitization**: `wp_fundi_sanitize_hex_color()`
- **Transport**: `postMessage` (live preview)

#### Heading Color
- **Setting**: `wp_fundi_heading_color`
- **Default**: `#333333` (dark gray)
- **Description**: Choose the color for headings (h1, h2, h3, etc.)
- **Control Type**: Color Picker
- **Sanitization**: `wp_fundi_sanitize_hex_color()`
- **Transport**: `postMessage` (live preview)

#### Link Hover Color
- **Setting**: `wp_fundi_link_hover_color`
- **Default**: `#005177` (dark blue)
- **Description**: Choose the color for links when hovered
- **Control Type**: Color Picker
- **Sanitization**: `wp_fundi_sanitize_hex_color()`
- **Transport**: `postMessage` (live preview)

### 2. Typography Section

#### Base Font Size
- **Setting**: `wp_fundi_font_size`
- **Default**: `16` (pixels)
- **Description**: Adjust the base font size for your site
- **Control Type**: Range Slider
- **Range**: 12px - 24px
- **Step**: 1px
- **Sanitization**: `wp_fundi_sanitize_font_size()`
- **Transport**: `postMessage` (live preview)

#### Line Height
- **Setting**: `wp_fundi_line_height`
- **Default**: `1.6`
- **Description**: Adjust the line height for better readability
- **Control Type**: Range Slider
- **Range**: 1.2 - 2.0
- **Step**: 0.1
- **Sanitization**: `wp_fundi_sanitize_line_height()`
- **Transport**: `postMessage` (live preview)

## Live Preview Features

### Real-time Updates
All customizer settings include live preview functionality:
- Changes are applied immediately in the preview pane
- No need to save and refresh to see changes
- Smooth transitions and animations

### Selective Refresh
The theme includes selective refresh for:
- Site title (`blogname`)
- Site description (`blogdescription`)
- Header text color (`header_textcolor`)

## Sanitization Functions

### Color Sanitization
```php
function wp_fundi_sanitize_hex_color( $color ) {
    if ( '' === $color ) {
        return '';
    }
    
    // 3 or 6 hex digits, or the empty string.
    if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
    }
    
    return '';
}
```

### Font Size Sanitization
```php
function wp_fundi_sanitize_font_size( $value ) {
    $value = absint( $value );
    if ( $value < 12 ) {
        return 12;
    }
    if ( $value > 24 ) {
        return 24;
    }
    return $value;
}
```

### Line Height Sanitization
```php
function wp_fundi_sanitize_line_height( $value ) {
    $value = floatval( $value );
    if ( $value < 1.2 ) {
        return 1.2;
    }
    if ( $value > 2.0 ) {
        return 2.0;
    }
    return $value;
}
```

## CSS Output

### Dynamic CSS Generation
The theme generates CSS dynamically based on customizer values:

```php
function wp_fundi_customizer_css() {
    $background_color = get_theme_mod( 'wp_fundi_background_color', '#ffffff' );
    $heading_color = get_theme_mod( 'wp_fundi_heading_color', '#333333' );
    $link_hover_color = get_theme_mod( 'wp_fundi_link_hover_color', '#005177' );
    $font_size = get_theme_mod( 'wp_fundi_font_size', '16' );
    $line_height = get_theme_mod( 'wp_fundi_line_height', '1.6' );
    
    // Generate CSS based on customizer values
    // Only output CSS if values differ from defaults
}
```

### CSS Variables Support
The theme uses CSS custom properties for hover colors:
```css
a:hover,
a:focus {
    color: var(--hover-color, var(--wp--preset--color--secondary));
}
```

## JavaScript Live Preview

### Customizer Preview Script
The theme includes a customizer preview script (`js/customizer.js`) that handles:

- Real-time color updates
- Font size and line height changes
- Site title and description updates
- Header text color changes

### jQuery Integration
```javascript
wp.customize( 'wp_fundi_background_color', function( value ) {
    value.bind( function( to ) {
        $( 'body' ).css( 'background-color', to );
    } );
} );
```

## Usage Examples

### Accessing Customizer Values
```php
// Get background color
$bg_color = get_theme_mod( 'wp_fundi_background_color', '#ffffff' );

// Get heading color
$heading_color = get_theme_mod( 'wp_fundi_heading_color', '#333333' );

// Get font size
$font_size = get_theme_mod( 'wp_fundi_font_size', '16' );
```

### Using in Templates
```php
<div style="background-color: <?php echo esc_attr( get_theme_mod( 'wp_fundi_background_color', '#ffffff' ) ); ?>;">
    Content here
</div>
```

## Child Theme Compatibility

### Overriding Customizer Settings
Child themes can override customizer defaults:

```php
// In child theme's functions.php
function child_theme_customizer_defaults( $wp_customize ) {
    $wp_customize->get_setting( 'wp_fundi_background_color' )->default = '#f0f0f0';
}
add_action( 'customize_register', 'child_theme_customizer_defaults' );
```

### Adding New Settings
Child themes can add new customizer settings:

```php
function child_theme_customizer_additions( $wp_customize ) {
    $wp_customize->add_setting( 'child_theme_custom_color', array(
        'default'           => '#ff0000',
        'sanitize_callback' => 'wp_fundi_sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'child_theme_custom_color',
            array(
                'label'   => 'Custom Color',
                'section' => 'wp_fundi_colors',
            )
        )
    );
}
add_action( 'customize_register', 'child_theme_customizer_additions' );
```

## Performance Considerations

### Transport Method
- All settings use `postMessage` transport for live preview
- No page refresh required for preview
- Efficient JavaScript-based updates

### CSS Optimization
- Only outputs CSS when values differ from defaults
- Uses CSS custom properties where possible
- Minimal impact on page load times

## Browser Support

Customizer functionality works in all modern browsers:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Troubleshooting

### Common Issues

1. **Colors not updating in preview**
   - Check if JavaScript is enabled
   - Verify customizer.js is loading
   - Clear browser cache

2. **Settings not saving**
   - Check user permissions
   - Verify sanitization functions
   - Check for JavaScript errors

3. **CSS not applying**
   - Check if `wp_fundi_customizer_css()` is hooked to `wp_head`
   - Verify theme mod values are being retrieved
   - Check for CSS conflicts

### Debug Mode
Enable WordPress debug mode to see customizer-related errors:
```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
```

## Security Features

### Input Sanitization
- All color inputs are validated with regex patterns
- Numeric inputs are bounded within safe ranges
- All outputs are properly escaped

### Nonce Verification
- Customizer changes are verified with WordPress nonces
- CSRF protection built-in
- Secure AJAX communication

## Future Enhancements

Potential additions to the customizer:
- Font family selection
- Spacing controls
- Border radius options
- Shadow effects
- Animation settings
