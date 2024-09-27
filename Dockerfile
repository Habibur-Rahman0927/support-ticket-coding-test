FROM php:8.2-fpm-alpine

RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    vim \
    zip \
    unzip \
    build-base \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle 

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

USER root

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
