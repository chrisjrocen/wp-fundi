# Fundi Hero Block

A customizable hero section block for the WP-FUNDI theme with background image, title, subtitle, and call-to-action button.

## Features

- **Background Image**: Upload and set custom background images
- **Overlay Control**: Adjustable overlay opacity for better text readability
- **Rich Text Content**: Editable title and subtitle with basic formatting
- **Call-to-Action Button**: Customizable button with URL and target options
- **Content Alignment**: Left, center, or right alignment options
- **Text Color**: Customizable text color for better contrast
- **Responsive Design**: Mobile-optimized layout
- **Accessibility**: Proper ARIA labels and keyboard navigation

## Block Attributes

| Attribute | Type | Default | Description |
|-----------|------|---------|-------------|
| `backgroundImage` | Object | null | Background image object |
| `backgroundImageUrl` | String | "" | Background image URL |
| `title` | String | "Welcome to Our Site" | Hero title text |
| `subtitle` | String | "Discover amazing content and services" | Hero subtitle text |
| `buttonText` | String | "Get Started" | Button text |
| `buttonUrl` | String | "" | Button URL |
| `buttonTarget` | Boolean | false | Open button link in new tab |
| `overlayOpacity` | Number | 0.5 | Background overlay opacity (0-1) |
| `textColor` | String | "#ffffff" | Text color |
| `contentAlignment` | String | "center" | Content alignment (left/center/right) |

## Usage

1. Add the "Fundi Hero" block to your page or post
2. Upload a background image using the media uploader
3. Edit the title and subtitle text
4. Configure the call-to-action button
5. Adjust overlay opacity and text color as needed
6. Choose your preferred content alignment

## Development

### Building the Block

```bash
# Install dependencies
npm install

# Start development build
npm start

# Create production build
npm run build

# Lint code
npm run lint:js
npm run lint:css
```

### File Structure

```text
fundi-hero/
├── block.json          # Block configuration
├── index.js            # Block registration
├── edit.jsx            # Editor interface
├── save.jsx            # Frontend rendering
├── index.php           # PHP block registration
├── style.css           # Frontend styles
├── editor.css          # Editor styles
├── package.json        # Dependencies and scripts
├── webpack.config.js   # Build configuration
└── README.md           # This file
```

## Styling

The block includes comprehensive CSS for both frontend and editor views:

- **Responsive Design**: Mobile-first approach with breakpoints
- **Accessibility**: Focus states and keyboard navigation
- **Customization**: CSS custom properties for easy theming
- **Alignment Support**: Wide and full-width alignment options

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Requirements

- WordPress 6.2+
- Gutenberg Block Editor
- Modern browser with ES6 support

## License

GPL v2 or later - <https://www.gnu.org/licenses/gpl-2.0.html>
