FROM php:8.1-fpm

ARG UID=1000
ARG GID=1000

RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data

RUN apt-get  -o Acquire::Check-Valid-Until=false -o Acquire::Check-Date=false update \
    && apt-get install -y git zlib1g-dev gnupg2 python3 mariadb-client libzip-dev libicu-dev curl libcurl4-openssl-dev libpng-dev libmcrypt-dev

RUN docker-php-ext-install bcmath zip pdo pdo_mysql intl curl gd \
    && pecl install redis mcrypt \
    && docker-php-ext-enable redis mcrypt

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

WORKDIR /var/www/english-serotonin