FROM php:8.2-apache
WORKDIR /var/www/html
RUN apt-get update -y \
    && apt-get upgrade -y
RUN apt install git -y
RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version='2.6.5'
COPY . .
RUN composer install
RUN a2enmod ssl && a2enmod rewrite
