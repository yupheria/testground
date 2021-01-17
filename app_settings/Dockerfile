# Dockerfile
FROM php:7-fpm

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install Git
RUN apt-get -y update
RUN apt-get -y install git

# Install php-zip
RUN apt-get install -y \
         libzip-dev \
         && docker-php-ext-install zip