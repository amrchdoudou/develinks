FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable Apache rewrite module (optional)
RUN a2enmod rewrite