FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update -y \
    && apt-get upgrade -y \
    && apt install git -y

RUN pecl install redis \
    && docker-php-ext-enable redis
RUN { \
    echo 'session.save_handler = redis'; \
    echo 'session.save_path = tcp://redis:6379'; \
} >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini

RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version='2.6.5'
COPY . .
RUN composer install

RUN a2enmod ssl && a2enmod rewrite
