FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    postgresql-client \
    libpq-dev

RUN docker-php-ext-install pdo_pgsql mbstring zip exif pcntl bcmath xml

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]
