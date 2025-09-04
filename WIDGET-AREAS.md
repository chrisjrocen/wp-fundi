# WP-FUNDI Theme Widget Areas

This document explains the widget areas available in the WP-FUNDI theme.

## Available Widget Areas

The theme includes three widget areas:

### 1. Sidebar
- **ID**: `sidebar-1`
- **Location**: Right side of the main content area (on desktop)
- **Description**: Add widgets here to appear in your sidebar
- **Placeholder**: Shows helpful message when empty

### 2. Footer One
- **ID**: `footer-1`
- **Location**: First column in the footer
- **Description**: Add widgets here to appear in the first footer column
- **Placeholder**: Shows helpful message when empty

### 3. Footer Two
- **ID**: `footer-2`
- **Location**: Second column in the footer
- **Description**: Add widgets here to appear in the second footer column
- **Placeholder**: Shows helpful message when empty

## Widget Area Features

### Flexible Layout
- **Sidebar**: Single column layout
- **Footer**: Two-column grid layout on desktop, single column on mobile
- **Responsive**: Automatically adjusts for different screen sizes

### Placeholder System
When widget areas are empty, they display helpful placeholders that:
- Show the widget area name
- Provide instructions on how to add widgets
- Maintain consistent layout and spacing
- Are styled to match the theme design

### Widget Styling
All widgets in the theme include:
- Consistent spacing and typography
- Proper color schemes for different areas
- Responsive design
- Accessibility features

## How to Add Widgets

1. Go to **Appearance > Widgets** in your WordPress admin
2. Drag widgets from the "Available Widgets" section to the desired widget area
3. Configure the widget settings
4. Save your changes

## Widget Area Locations

### Sidebar Widget Area
- Appears on all pages and posts that use the sidebar layout
- Positioned to the right of the main content
- Includes placeholder when empty

### Footer Widget Areas
- Appears at the bottom of all pages
- Two-column layout on desktop screens
- Single column layout on mobile devices
- Both areas show placeholders when empty

## Customization

### Adding New Widget Areas
To add new widget areas, modify the `register_widget_areas()` method in `functions.php`:

```php
register_sidebar(
    array(
        'name'          => esc_html__( 'Your Widget Area Name', 'wp-fundi' ),
        'id'            => 'your-widget-area-id',
        'description'   => esc_html__( 'Description of your widget area.', 'wp-fundi' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    )
);
```

### Styling Widget Areas
Widget areas can be customized through CSS:

```css
/* Sidebar widget area */
.widget-area {
    /* Your custom styles */
}

/* Footer widget areas */
.footer-widget-area {
    /* Your custom styles */
}

/* Widget placeholders */
.widget-placeholder {
    /* Your custom placeholder styles */
}
```

## Responsive Behavior

### Desktop (768px and above)
- Sidebar appears to the right of main content
- Footer widgets display in two columns
- Full spacing and typography

### Mobile (below 768px)
- Sidebar appears below main content
- Footer widgets stack in single column
- Optimized spacing for touch devices

## Accessibility Features

- Proper semantic HTML structure
- ARIA labels and roles
- Keyboard navigation support
- Screen reader friendly
- High contrast color schemes

## Browser Support

Widget areas work in all modern browsers:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Performance

- Efficient widget loading
- Minimal CSS and JavaScript
- Optimized for fast page loads
- Cached widget output when possible
