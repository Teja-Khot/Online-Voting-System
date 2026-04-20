FROM php:8.2-apache

COPY OnlineVotingSystem_/ /var/www/html/

RUN a2enmod rewrite

EXPOSE 80
