FROM php:8.2-apache

WORKDIR /var/www/html

COPY OnlineVotingSystem_/ .

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html

# Force Apache to listen on correct port
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 8080
