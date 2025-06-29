# IEEE Career Fair WordPress Theme - Deployment Guide

## 🚀 Quick Deploy Options

### **1. Wasmer.io Deployment**

**Prerequisites:**
- GitHub repository
- Wasmer.io account

**Steps:**
1. Push this repository to GitHub
2. Connect your GitHub to Wasmer.io
3. Deploy directly from repository
4. Configure environment variables

```bash
# Clone this repository
git clone https://github.com/your-username/ieee-career-fair-theme.git
cd ieee-career-fair-theme

# Deploy to Wasmer.io
wasmer deploy
```

### **2. Docker Deployment**

```bash
# Build Docker image
docker build -t ieee-career-fair-theme .

# Run container
docker run -p 8080:80 ieee-career-fair-theme
```

### **3. Traditional WordPress Hosting**

1. Upload theme files to `/wp-content/themes/ieee-career-fair/`
2. Activate theme in WordPress admin
3. Configure custom fields and content

## 🔧 Configuration

### **Environment Variables**
```
WORDPRESS_DB_HOST=localhost
WORDPRESS_DB_USER=root
WORDPRESS_DB_PASSWORD=password
WORDPRESS_DB_NAME=wordpress
```

### **Required WordPress Plugins** (Optional)
- Advanced Custom Fields (for enhanced custom fields)
- Yoast SEO (for better SEO)
- W3 Total Cache (for performance)

## 📋 Post-Deployment Setup

1. **Activate Theme**: Go to Appearance → Themes → Activate "IEEE Career Fair"
2. **Set Homepage**: Create a new page titled "Home" and set as static homepage
3. **Add Content**: 
   - Create career events in Career Events menu
   - Add partner logos in Partners menu
   - Customize settings in Appearance → Customize
4. **Configure Menus**: Set up navigation in Appearance → Menus

## 🌐 Live Demo URLs

After deployment, your site will be available at:
- **Wasmer.io**: `https://your-app-name.wasmer.app`
- **Local**: `http://localhost:8080`

## 🎯 Features Included

- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Custom post types for events and partners
- ✅ Easy admin interface for non-technical users
- ✅ SEO optimized
- ✅ Fast loading with optimized assets
- ✅ Bootstrap 5 framework
- ✅ FontAwesome icons
- ✅ AOS animations

## 🔒 Security Notes

- All user inputs are sanitized and validated
- CSRF protection with nonces
- No hardcoded credentials
- Safe file handling practices

## 📞 Support

For deployment assistance:
1. Check WordPress requirements (PHP 7.4+, MySQL 5.6+)
2. Ensure proper file permissions (755 for directories, 644 for files)
3. Verify .htaccess configuration for permalinks

## 🔄 Updates

To update the theme:
1. Pull latest changes from repository
2. Replace theme files on server
3. Clear any caching
4. Test functionality

---

**Theme Version**: 1.0  
**Compatible With**: WordPress 5.0+  
**Last Updated**: December 2024 