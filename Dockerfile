FROM php:8.5-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl \
    unzip \
    iputils-ping \
    procps \
    iproute2 \
    dnsutils \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

RUN docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    intl \
    gd

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN pecl clear-cache \
    && pecl install redis-6.3.0 \
    && docker-php-ext-enable redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ARG UID=1000
ARG GID=1000

RUN groupadd -g ${GID} web \
    && useradd \
    -u ${UID} \
    -g ${GID} \
    -m \
    -s /bin/bash \
    web

RUN chown -R web:web /var/www/html

USER web

WORKDIR /var/www/html/

CMD ["php-fpm", "-F"]