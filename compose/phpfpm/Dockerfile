FROM php:8.1-fpm-bullseye

#### START - Permisos
RUN groupadd -g 1000 app \
 && useradd -g 1000 -u 1000 -d /var/www -s /bin/bash app

RUN mkdir -p /etc/nginx/html /var/www/html /sock 
RUN chown -R app:app /usr/local/etc/php/conf.d /sock

RUN mkdir -p /var/www && chown -R app:app /var/www/
#### END

#### START - Instalar Composer en el contenedor PHP
RUN curl -sS https://getcomposer.org/installer | \
  php -- --install-dir=/usr/local/bin --filename=composer
#### END

#### START - Instalar dependencias php para magento
RUN apt-get update && apt-get install -y --no-install-recommends \
  cron \
  git \
  gzip \
  libfreetype6-dev \
  libicu-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  libxslt1-dev \
  libzip-dev \
  lsof \
  mariadb-client \
  vim \
  zip \
  procps \
  sudo \
  openssh-client \
  libonig-dev \
  libwebp-dev \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure \
  gd --enable-gd --with-freetype --with-jpeg --with-webp

RUN docker-php-ext-install \
  bcmath \
  gd \
  zip \
  intl \
  pdo_mysql \
  soap \
  xsl \
  sockets
#### END

#### START - Instalar Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
#### END

#### START - Configuraciones
COPY conf/php-fpm.conf /usr/local/etc/
COPY conf/www.conf /usr/local/etc/php-fpm.d/
COPY conf/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY conf/php.ini $PHP_INI_DIR
#### END

USER app:app
VOLUME /var/www
WORKDIR /var/www/html