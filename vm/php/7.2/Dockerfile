FROM php:7.2.8-fpm-stretch

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libssl-dev \
        git \
        zip \
    && docker-php-ext-install \
        sockets \
        iconv \
        mbstring \
        exif \
        zip \
        bcmath \
        pcntl \
        pdo \
        pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini


RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

ENV SYMFONY_ENV dev
#RUN curl --silent --show-error https://getcomposer.org/installer | php
#RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www
