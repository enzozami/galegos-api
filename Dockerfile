FROM php:8.5.12-fpm-trixie

ARG DEV=false

# Corrige CVEs dos pacotes do SO
RUN apt-get update && apt-get upgrade -y && rm -rf /var/lib/apt/lists/*

# Compila as extensões e remove as libs -dev, mantendo só as de runtime
RUN set -eux; \
    savedAptMark="$(apt-mark showmanual)"; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
    libpng-dev libpq-dev libicu-dev libjpeg62-turbo-dev libfreetype6-dev; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" pdo_pgsql exif pcntl bcmath intl gd; \
    pecl install redis-6.3.0; \
    docker-php-ext-enable redis; \
    apt-mark auto '.*' > /dev/null; \
    apt-mark manual $savedAptMark; \
    find /usr/local -type f -executable -exec ldd '{}' ';' 2>/dev/null \
    | awk '/=>/ { so = $(NF-1); if (index(so, "/usr/local/") == 1) { next }; gsub("^/(usr/)?", "", so); printf "*%s\n", so }' \
    | sort -u | xargs -r dpkg-query --search \
    | awk 'sub(":$", "", $1) { print $1 }' \
    | sort -u | xargs -r apt-mark manual; \
    apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
    rm -rf /var/lib/apt/lists/* /tmp/pear

# unzip é usado pelo Composer
RUN apt-get update && apt-get install -y --no-install-recommends unzip \
    && rm -rf /var/lib/apt/lists/*

# Só em dev: Xdebug e ferramentas de rede/debug
RUN if [ "$DEV" = "true" ]; then \
    apt-get update && apt-get install -y --no-install-recommends \
    curl iputils-ping procps iproute2 dnsutils \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/* /tmp/pear; \
    else \
    cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"; \
    fi

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ARG UID=1000
ARG GID=1000

RUN groupadd -g ${GID} web \
    && useradd -u ${UID} -g ${GID} -m -s /bin/bash web \
    && chown -R web:web /var/www/html

USER web
WORKDIR /var/www/html/

CMD ["php-fpm", "-F"]