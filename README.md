# IEEE Career Fair WordPress Site

A complete WordPress installation featuring the IEEE Career Fair theme - designed to help IEEE chapters and organizations manage career fair events and connect students with industry partners.

## 🚀 Features

### Complete WordPress Installation
- **Ready-to-deploy** WordPress site with IEEE Career Fair theme pre-installed
- **Professional design** matching IEEE branding guidelines
- **Responsive layout** optimized for all devices
- **SEO-friendly** structure and markup

### Custom Post Types
- **Career Events** - Manage job fairs, networking events, workshops, and seminars
- **Partners** - Showcase sponsor organizations and industry partners

### Admin-Friendly Interface
- **Easy content management** for non-technical users
- **Custom meta boxes** with helpful guidance
- **Drag-and-drop** partner logo uploads
- **Event registration** URL management
- **Built-in help** and documentation

### Theme Features
- **Modern UI/UX** with Bootstrap 5 framework
- **Hero section** with call-to-action buttons
- **Statistics display** for IEEE membership and success metrics
- **Partner showcase** with hover effects
- **Event listings** with filtering and search
- **Mobile-responsive** navigation
- **Loading animations** with AOS library

## 📋 Requirements

- **PHP** 7.4 or higher
- **MySQL** 5.7 or higher (or MariaDB 10.2+)
- **Web server** (Apache/Nginx)
- **WordPress** 6.0+ compatible

## 🛠️ Installation Options

### Option 1: Drag-and-Drop Deployment (Recommended for Wasmer.io)

1. **Download/Clone this repository**
   ```bash
   git clone [your-repo-url]
   cd ieee-career-fair-theme
   ```

2. **Upload to your hosting platform**
   - For Wasmer.io: Drag the entire `ieee-career-fair-theme` folder to the deployment area
   - For traditional hosting: Upload all files to your domain's document root

3. **Create database**
   - Create a MySQL database named `ieee_career_fair` (or set `DB_NAME` environment variable)
   - Note your database credentials

4. **Configure environment variables** (optional but recommended)
   ```
   DB_NAME=ieee_career_fair
   DB_USER=your_username
   DB_PASSWORD=your_password
   DB_HOST=localhost
   WP_HOME=https://yourdomain.com
   WP_SITEURL=https://yourdomain.com
   ```

5. **Run WordPress installation**
   - Visit your site URL
   - Follow the WordPress installation wizard
   - The IEEE Career Fair theme will be automatically activated

### Option 2: Traditional WordPress Installation

1. **Upload files to your web server**
2. **Create database and user**
3. **Update wp-config.php** with your database settings
4. **Run the WordPress installer**
5. **Activate the IEEE Career Fair theme** in Appearance > Themes

### Option 3: Local Development (XAMPP/WAMP)

1. **Place files in htdocs folder** (for XAMPP)
2. **Create database** in phpMyAdmin
3. **Update wp-config.php** with local database settings
4. **Access via localhost**

## 🔧 Configuration

### Database Settings
The installation supports both direct configuration and environment variables:

```php
// Direct configuration
define( 'DB_NAME', 'your_database_name' );
define( 'DB_USER', 'your_username' );
define( 'DB_PASSWORD', 'your_password' );
define( 'DB_HOST', 'localhost' );

// Or use environment variables (recommended)
DB_NAME=your_database_name
DB_USER=your_username
DB_PASSWORD=your_password
DB_HOST=localhost
```

### Security Keys
Generate new security keys at: https://api.wordpress.org/secret-key/1.1/salt/

### Default Admin Setup
After installation, create an admin user through the WordPress setup wizard.

## 📁 File Structure

```
ieee-career-fair-theme/
├── wp-admin/                 # WordPress admin files
├── wp-includes/              # WordPress core files
├── wp-content/
│   ├── themes/
│   │   └── ieee-career-fair/ # IEEE Career Fair theme
│   │       ├── style.css
│   │       ├── functions.php
│   │       ├── index.php
│   │       ├── header.php
│   │       ├── footer.php
│   │       ├── front-page.php
│   │       ├── single-career_event.php
│   │       ├── archive-career_event.php
│   │       └── assets/       # Theme assets (CSS, JS, images)
│   ├── plugins/              # WordPress plugins
│   └── uploads/              # Media uploads directory
├── wp-config.php             # WordPress configuration
├── index.php                 # WordPress entry point
└── README.md                 # This file
```

## 🎨 Customization

### Adding Events
1. **Login to WordPress admin**
2. **Navigate to Career Events > Add New**
3. **Fill in event details:**
   - Event title and description
   - Date and time
   - Location information
   - Registration URL
   - Event status (upcoming, ongoing, completed)

### Managing Partners
1. **Go to Partners > Add New**
2. **Upload partner logo**
3. **Add partner information:**
   - Organization name
   - Website URL
   - Description

### Theme Customization
- **Colors and fonts** can be modified in `wp-content/themes/ieee-career-fair/style.css`
- **Logo and branding** can be updated through Appearance > Customize
- **Layout modifications** in theme template files

## 🔍 SEO Features

- **Schema markup** for events and organizations
- **Open Graph** meta tags for social sharing
- **Optimized URLs** and permalink structure
- **Image optimization** and alt text support
- **Meta descriptions** and title tags

## 🔒 Security Features

- **File editing disabled** in admin dashboard
- **Limited post revisions** to save database space
- **Environment variable support** for sensitive data
- **Security headers** and best practices implemented

## 🌐 Deployment Examples

### Wasmer.io Deployment
```bash
# Simply drag and drop the ieee-career-fair-theme folder
# Set environment variables in Wasmer dashboard
# Access your deployed site
```

### Traditional cPanel Hosting
```bash
# Upload files via File Manager or FTP
# Create database in cPanel
# Run WordPress installation
```

### Docker Deployment
```bash
# Use included Dockerfile (if present)
docker build -t ieee-career-fair .
docker run -p 80:80 ieee-career-fair
```

## 📖 User Guide

### For Site Administrators
- **Dashboard** overview provides quick access to events and partners
- **Settings** page allows customization of site details
- **Users** can be managed with different role levels
- **Media** library stores all uploaded images and files

### For Content Editors
- **Visual editor** makes content creation easy
- **Preview** functionality to see changes before publishing
- **Categories and tags** for organizing content
- **Scheduled publishing** for future events

## 🆘 Troubleshooting

### Common Issues

**Theme not appearing:**
- Ensure all theme files are in `wp-content/themes/ieee-career-fair/`
- Check file permissions (755 for directories, 644 for files)

**Database connection errors:**
- Verify database credentials in wp-config.php
- Ensure database server is running
- Check hostname and port settings

**Missing images:**
- Verify assets are uploaded to `wp-content/themes/ieee-career-fair/assets/`
- Check image file paths in templates
- Ensure proper file permissions

**Plugin conflicts:**
- Deactivate all plugins and test
- Reactivate plugins one by one to identify conflicts

## 🔄 Updates and Maintenance

### Theme Updates
- **Backup** your site before making changes
- **Test** updates on a staging environment
- **Document** any customizations made

### WordPress Updates
- **Keep WordPress core** up to date for security
- **Update plugins** regularly
- **Monitor** site performance after updates

### Content Backup
- **Regular database backups** recommended
- **File system backups** for uploaded media
- **Configuration backups** for custom settings

## 📞 Support

### Documentation
- WordPress Codex: https://codex.wordpress.org/
- IEEE Branding Guidelines: https://ieee.org/brand

### Community
- WordPress Support Forums
- IEEE Web Development Groups
- Local IEEE Chapter Resources

## 📄 License

This theme is built on WordPress (GPL v2 or later) and follows WordPress coding standards and licensing requirements.

**WordPress License:** GPL v2 or later
**Theme License:** GPL v2 or later
**IEEE Branding:** Used with permission for IEEE chapter websites

---

*Built with ❤️ for the IEEE community. Empowering students and professionals to connect with industry opportunities.*

---

*Theme Version: 1.0*  
*Last Updated: December 2024*  
*Compatible with: WordPress 5.0+* 