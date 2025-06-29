# Use the official PHP image with Apache
FROM php:8.1-apache

# Install required PHP extensions for WordPress
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite for WordPress permalinks
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy theme files
COPY . /var/www/html/wp-content/themes/ieee-career-fair/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"] 