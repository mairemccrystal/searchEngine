FROM amazonlinux:2
FROM php:7.1.8-apache
RUN docker-php-ext-install pdo pdo_mysql
COPY src/ /var/www/html/
EXPOSE 80

