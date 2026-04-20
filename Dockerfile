FROM php:8.2-apache

WORKDIR /var/www/html

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy project files
COPY OnlineVotingSystem_/ .

# Enable Apache rewrite
RUN a2enmod rewrite

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Fix port for Code Engine
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 8080
