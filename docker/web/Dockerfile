FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable Apache rewrite module (optional)
RUN a2enmod rewrite

# Copy your PHP project files to Apache's web root
COPY . /var/www/html/

# Optional: set permissions
RUN chown -R www-data:www-data /var/www/html
