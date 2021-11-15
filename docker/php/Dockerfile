FROM php:5.6-apache

# Install modules
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libmemcached-dev \
        git \
        libicu-dev \
        libssl-dev \
        zlib1g-dev \
        libxml2-dev \
        libssh2-1-dev \
        imagemagick

RUN { yes '/usr' | pecl install memcached-2.2.0; } \
    && echo "extension=memcached.so" >> /usr/local/etc/php/conf.d/memcached.ini \
    && docker-php-ext-install iconv mcrypt pdo_mysql mbstring intl zip opcache \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd soap


# RUN docker-php-ext-install mysql mysqli \
#     && docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer