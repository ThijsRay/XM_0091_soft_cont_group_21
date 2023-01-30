FROM php:8.2.1-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/download/1.5.52/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
  install-php-extensions imagick && \
  install-php-extensions pgsql

# Deal with strange google ingress behavior that seems to require each route to
# resolve to a HTTP 200
RUN mkdir -p /var/www/html/api && touch /var/www/html/api/index.php && touch /var/www/html/index.php

COPY php.ini.prod "$PHP_INI_DIR/php.ini"
COPY src/ /var/www/html/api
COPY assets/placeholder.png /media
