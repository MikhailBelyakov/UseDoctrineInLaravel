FROM php:8.0.5-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    openssl \
    curl \
    wget \
    gnupg \
    locales \
    pkg-config \
    zlib1g-dev \
    supervisor \
    libfreetype6-dev \
    libmcrypt-dev \
    libpng16-16 \
    zip \
    unzip \
    libonig-dev \
    libjpeg-dev libpng-dev libxslt-dev libwebp-dev libjpeg62-turbo-dev libxpm-dev \
    libicu-dev libmemcached-dev libmagick++-dev libmagickwand-dev libzip-dev cron dos2unix libgmp-dev unzip \
    libssl-dev libc-client-dev libkrb5-dev \
    git \
    graphviz \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && pecl install apfd \
    && docker-php-ext-enable apfd

RUN apt install -y librdkafka-dev \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka

ENV ACCEPT_EULA=Y
# Microsoft SQL Server Prerequisites
RUN apt-get --allow-releaseinfo-change update \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list \
        > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        unixodbc-dev \
        msodbcsql17

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install exif zip pdo pdo_mysql opcache sockets mbstring intl xml soap iconv bcmath mysqli bz2 gettext xsl gmp imap

#RUN docker-php-ext-configure --with-openssl=/usr/local // TODO исправить ошибку если всё же нужно будет использовать

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN pecl install sqlsrv pdo_sqlsrv && docker-php-ext-enable sqlsrv pdo_sqlsrv

COPY conf.d/zz_custom_settings.ini "$PHP_INI_DIR/conf.d/"
COPY php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/ /usr/share/man/ /usr/share/locale/

RUN useradd -M -d /home/nginx -s /bin/bash nginx
RUN mkdir -p /home/nginx && chown -R nginx.nginx /home/nginx

# Set working directory
WORKDIR /var/www/html

ENTRYPOINT ["php-fpm", "-F"]

EXPOSE 6001


