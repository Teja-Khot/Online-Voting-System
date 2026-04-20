FROM php:8.2-apache

# Set working directory explicitly
WORKDIR /var/www/html

# Copy project
COPY OnlineVotingSystem_/ .

# Enable Apache rewrite
RUN a2enmod rewrite

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
