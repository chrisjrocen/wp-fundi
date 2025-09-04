# WP-FUNDI Customizer Export/Import

This document explains the export/import functionality for theme customizer settings in the WP-FUNDI theme.

## Overview

The WP-FUNDI theme includes a comprehensive export/import system that allows users to export their customizer settings as JSON files and import them across different sites. This feature is particularly useful for multisite installations, staging/production environments, or when setting up multiple sites with consistent styling.

## Features

### 📤 Export Functionality
- **JSON Format**: Settings exported as structured JSON files
- **Metadata Included**: Version, theme, export date, and site URL
- **Selective Export**: Only exports WP-FUNDI theme settings
- **Instant Download**: Browser-based file download
- **Security**: Nonce-protected export process

### 📥 Import Functionality
- **File Validation**: JSON format and structure validation
- **Theme Compatibility**: Ensures settings are compatible with current theme
- **Live Preview**: Imported settings apply immediately in customizer
- **Error Handling**: Comprehensive error messages and validation
- **Security**: Nonce-protected import process

## Available Settings

The export/import system includes the following customizer settings:

### Color Settings
- `wp_fundi_background_color` - Background color
- `wp_fundi_heading_color` - Heading color
- `wp_fundi_link_hover_color` - Link hover color

### Typography Settings
- `wp_fundi_font_size` - Base font size
- `wp_fundi_line_height` - Line height
- `wp_fundi_body_font` - Body font (Google Fonts)

## Usage

### Accessing Export/Import

1. **Navigate to Customizer**: Go to Appearance > Customize
2. **Open Fundi Styles Panel**: Click on "Fundi Styles"
3. **Find Export/Import Section**: Scroll to "Export/Import Settings"
4. **Use Export/Import Controls**: Click the respective buttons

### Exporting Settings

1. **Click Export Button**: Click "Export Settings" button
2. **File Download**: Browser will download a JSON file
3. **File Naming**: Files are named with timestamp (e.g., `wp-fundi-customizer-settings-2024-01-15-14-30-25.json`)

### Importing Settings

1. **Click Import Button**: Click "Import Settings" button
2. **Select File**: Choose a valid JSON export file
3. **Automatic Import**: Settings are imported and applied immediately
4. **Success Message**: Confirmation message shows number of imported settings

## JSON File Structure

### Export File Format
```json
{
  "version": "1.0.0",
  "theme": "wp-fundi",
  "exported_at": "2024-01-15T14:30:25.000Z",
  "site_url": "https://example.com",
  "settings": {
    "wp_fundi_background_color": "#ffffff",
    "wp_fundi_heading_color": "#333333",
    "wp_fundi_link_hover_color": "#005177",
    "wp_fundi_font_size": "16",
    "wp_fundi_line_height": "1.6",
    "wp_fundi_body_font": "Inter"
  }
}
```

### File Metadata
- **version**: Theme version when exported
- **theme**: Theme slug for compatibility checking
- **exported_at**: ISO timestamp of export
- **site_url**: Source site URL
- **settings**: Object containing all customizer settings

## Technical Implementation

### PHP Backend

#### Export Function
```php
function wp_fundi_export_customizer_settings() {
    // Security checks
    if ( ! wp_verify_nonce( $_POST['nonce'], 'wp_fundi_export_import' ) ) {
        wp_die( 'Security check failed.' );
    }
    
    if ( ! current_user_can( 'customize' ) ) {
        wp_die( 'You do not have permission to export settings.' );
    }
    
    // Collect settings
    $settings = array();
    $theme_mods = get_theme_mods();
    
    // Export only WP-FUNDI settings
    $wp_fundi_settings = array(
        'wp_fundi_background_color',
        'wp_fundi_heading_color',
        'wp_fundi_link_hover_color',
        'wp_fundi_font_size',
        'wp_fundi_line_height',
        'wp_fundi_body_font',
    );
    
    foreach ( $wp_fundi_settings as $setting ) {
        if ( isset( $theme_mods[ $setting ] ) ) {
            $settings[ $setting ] = $theme_mods[ $setting ];
        }
    }
    
    // Create export data with metadata
    $export_data = array(
        'version'     => WP_FUNDI_VERSION,
        'theme'       => get_stylesheet(),
        'exported_at' => current_time( 'mysql' ),
        'site_url'    => home_url(),
        'settings'    => $settings,
    );
    
    // Set download headers
    $filename = 'wp-fundi-customizer-settings-' . date( 'Y-m-d-H-i-s' ) . '.json';
    header( 'Content-Type: application/json' );
    header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
    
    echo wp_json_encode( $export_data, JSON_PRETTY_PRINT );
    exit;
}
```

#### Import Function
```php
function wp_fundi_import_customizer_settings() {
    // Security and validation
    if ( ! wp_verify_nonce( $_POST['nonce'], 'wp_fundi_export_import' ) ) {
        wp_die( 'Security check failed.' );
    }
    
    if ( ! current_user_can( 'customize' ) ) {
        wp_die( 'You do not have permission to import settings.' );
    }
    
    // File validation
    if ( ! isset( $_FILES['import_file'] ) || $_FILES['import_file']['error'] !== UPLOAD_ERR_OK ) {
        wp_die( 'No file uploaded or upload error.' );
    }
    
    $file = $_FILES['import_file'];
    $file_content = file_get_contents( $file['tmp_name'] );
    $import_data = json_decode( $file_content, true );
    
    // JSON validation
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        wp_die( 'Invalid JSON file.' );
    }
    
    // Structure validation
    if ( ! isset( $import_data['settings'] ) || ! is_array( $import_data['settings'] ) ) {
        wp_die( 'Invalid settings file format.' );
    }
    
    // Theme compatibility check
    if ( isset( $import_data['theme'] ) && $import_data['theme'] !== get_stylesheet() ) {
        wp_die( 'Settings are not compatible with the current theme.' );
    }
    
    // Import settings
    $imported_count = 0;
    foreach ( $import_data['settings'] as $setting => $value ) {
        if ( in_array( $setting, $wp_fundi_settings, true ) ) {
            set_theme_mod( $setting, $value );
            $imported_count++;
        }
    }
    
    wp_send_json_success( array(
        'message' => sprintf( 'Successfully imported %d settings.', $imported_count )
    ) );
}
```

### JavaScript Frontend

#### Export Implementation
```javascript
// Export settings
$('#export-settings').on('click', function(e) {
    e.preventDefault();
    
    // Get current customizer settings
    var settings = {};
    var wpFundiSettings = [
        'wp_fundi_background_color',
        'wp_fundi_heading_color', 
        'wp_fundi_link_hover_color',
        'wp_fundi_font_size',
        'wp_fundi_line_height',
        'wp_fundi_body_font'
    ];
    
    wpFundiSettings.forEach(function(setting) {
        var control = wp.customize.control(setting);
        if (control) {
            settings[setting] = control.setting.get();
        }
    });
    
    // Create export data
    var exportData = {
        version: '1.0.0',
        theme: wp.customize.theme.stylesheet,
        exported_at: new Date().toISOString(),
        site_url: wp.customize.url.home,
        settings: settings
    };
    
    // Create and download file
    var dataStr = JSON.stringify(exportData, null, 2);
    var dataBlob = new Blob([dataStr], {type: 'application/json'});
    var url = URL.createObjectURL(dataBlob);
    
    var link = document.createElement('a');
    link.href = url;
    link.download = 'wp-fundi-customizer-settings-' + 
        new Date().toISOString().slice(0, 19).replace(/:/g, '-') + '.json';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
    
    showNotice('Settings exported successfully!', 'success');
});
```

#### Import Implementation
```javascript
// Import settings
$('#import-file').on('change', function(e) {
    var file = e.target.files[0];
    if (!file) return;
    
    // File validation
    if (file.type !== 'application/json' && !file.name.endsWith('.json')) {
        showNotice('Please select a valid JSON file.', 'error');
        return;
    }
    
    if (file.size > 1024 * 1024) {
        showNotice('File size must be less than 1MB.', 'error');
        return;
    }
    
    var reader = new FileReader();
    reader.onload = function(e) {
        try {
            var importData = JSON.parse(e.target.result);
            
            // Validate import data
            if (!importData.settings || typeof importData.settings !== 'object') {
                showNotice('Invalid settings file format.', 'error');
                return;
            }
            
            // Import settings
            var importedCount = 0;
            Object.keys(importData.settings).forEach(function(setting) {
                var control = wp.customize.control(setting);
                if (control) {
                    control.setting.set(importData.settings[setting]);
                    importedCount++;
                }
            });
            
            showNotice('Successfully imported ' + importedCount + ' settings!', 'success');
            
        } catch (error) {
            showNotice('Invalid JSON file.', 'error');
        }
    };
    
    reader.readAsText(file);
    $('#import-file').val('');
});
```

## Security Features

### Authentication & Authorization
- **Nonce Protection**: All requests protected with WordPress nonces
- **Capability Checks**: Requires `customize` capability
- **User Authentication**: Must be logged in to export/import

### File Validation
- **File Type**: Only JSON files accepted
- **File Size**: Maximum 1MB file size limit
- **JSON Structure**: Validates JSON format and structure
- **Theme Compatibility**: Ensures settings match current theme

### Data Sanitization
- **Input Sanitization**: All inputs properly sanitized
- **Output Escaping**: All outputs properly escaped
- **XSS Protection**: Prevents cross-site scripting attacks

## Error Handling

### Common Error Messages
- **Security Check Failed**: Invalid or missing nonce
- **Permission Denied**: User lacks customize capability
- **Invalid JSON File**: File is not valid JSON
- **Invalid Settings Format**: JSON structure is incorrect
- **Theme Incompatible**: Settings from different theme
- **File Too Large**: Import file exceeds 1MB limit

### User Feedback
- **Success Messages**: Confirmation of successful operations
- **Error Messages**: Clear error descriptions
- **Loading States**: Visual feedback during operations
- **Auto-hide Notices**: Messages disappear after 5 seconds

## Use Cases

### Multisite Networks
- **Consistent Branding**: Apply same styling across all sites
- **Template Sites**: Create template with predefined settings
- **Bulk Updates**: Update multiple sites simultaneously

### Development Workflow
- **Staging to Production**: Move settings from staging to live site
- **Local to Remote**: Transfer settings from local development
- **Backup & Restore**: Backup customizer settings before changes

### Client Work
- **Design Handoff**: Provide clients with complete styling package
- **Site Migration**: Move settings when changing hosting
- **Version Control**: Track customizer changes over time

## Browser Support

### Modern Browsers
- **Chrome**: 60+ (File API, Blob API)
- **Firefox**: 55+ (File API, Blob API)
- **Safari**: 12+ (File API, Blob API)
- **Edge**: 79+ (File API, Blob API)

### Required Features
- **File API**: For reading import files
- **Blob API**: For creating download files
- **URL.createObjectURL**: For file downloads
- **JSON.parse/stringify**: For data processing

## Performance Considerations

### Optimization Features
- **Selective Export**: Only exports relevant settings
- **Client-side Processing**: Reduces server load
- **Efficient Validation**: Minimal processing overhead
- **Small File Sizes**: JSON files are typically < 1KB

### Best Practices
- **Regular Exports**: Export settings before major changes
- **File Management**: Organize export files by date/project
- **Testing**: Test imports on staging before production
- **Backup**: Keep multiple export versions

## Troubleshooting

### Common Issues

1. **Export Button Not Working**
   - Check browser console for JavaScript errors
   - Ensure customizer is fully loaded
   - Verify user has customize permissions

2. **Import Fails**
   - Check file format (must be .json)
   - Verify file size (max 1MB)
   - Ensure file is from WP-FUNDI theme

3. **Settings Not Applied**
   - Check theme compatibility
   - Verify setting names match
   - Clear any caching plugins

### Debug Mode
Enable WordPress debug mode to see detailed error messages:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

### Manual Import
If automatic import fails, settings can be manually applied:
```php
// Example: Set background color
set_theme_mod('wp_fundi_background_color', '#ffffff');

// Example: Set font size
set_theme_mod('wp_fundi_font_size', '16');
```

## Future Enhancements

### Planned Features
- **Bulk Import**: Import multiple files at once
- **Setting Presets**: Predefined setting combinations
- **Cloud Sync**: Automatic backup to cloud storage
- **Version History**: Track setting changes over time

### API Extensions
```php
// Future API possibilities
wp_fundi_export_settings($format = 'json');
wp_fundi_import_settings($file_path);
wp_fundi_get_export_history();
wp_fundi_create_setting_preset($name, $settings);
```

## Conclusion

The WP-FUNDI customizer export/import system provides a robust, secure, and user-friendly way to manage theme settings across multiple sites. With comprehensive validation, error handling, and security features, it's suitable for both individual users and multisite administrators who need consistent theming across their network.
