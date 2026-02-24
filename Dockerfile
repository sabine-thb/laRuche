FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

RUN mkdir -p /var/www/html/style/img/logo /var/www/html/style/img/imageProfil \
    && chown -R www-data:www-data /var/www/html/style

WORKDIR /var/www/html
