FROM php:7.2.3-fpm-alpine3.7

# Install
RUN apk add --update --no-cache --virtual .ext-deps \
        zip openssh curl \
        libjpeg-turbo-dev \
        libwebp-dev \
        libpng-dev \
        freetype-dev \
        libmcrypt-dev \
        autoconf \
        libintl libxml2-dev \
        icu icu-dev \
        git unzip \
        g++ \
        make

# Configurations & php extensions
RUN docker-php-ext-configure exif && \
    docker-php-ext-configure bcmath && \
    docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/include \
    --with-png-dir=/usr/include \
    --with-webp-dir=/usr/include \
    --with-freetype-dir=/usr/include && \
    docker-php-ext-install exif gd bcmath \
    opcache pdo_mysql mysqli json iconv \
    ctype tokenizer simplexml xml dom intl


# Composer and File permissions
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# install phpunit
RUN wget https://phar.phpunit.de/phpunit-6.1.phar && \
    chmod +x phpunit-6.1.phar && \
    mv phpunit-6.1.phar /usr/local/bin/phpunit

RUN echo "expose_php=0" > /usr/local/etc/php/php.ini

COPY ./docker/php-fpm/symfony.pool.conf /usr/local/etc/php-fpm.d/
COPY ./docker/php-fpm/symfony.ini /usr/local/etc/
COPY ./docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/

COPY ./docker/php-fpm/entrypoint.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/entrypoint.sh

# Copy Symfony project, when building a Container we need php files in the contaier.
# COPY ./symfony /var/www/symfony

# To keep version and changelog in deploy
COPY ./CHANGELOG.md /var/www/symfony/CHANGELOG.md

WORKDIR /var/www/symfony

# Install Symfony vendors and clean up, only when not developing
ENV COMPOSER_ALLOW_SUPERUSER=1
#RUN composer install

# Phpunit is installed, and we can run the tests on build time
#RUN phpunit -d memory_limit=2G

# clear cache
RUN rm -rf app/cache/* \
    && rm -rf app/logs/*

CMD ["/bin/sh", "-c", "/usr/local/bin/entrypoint.sh"]