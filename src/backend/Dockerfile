FROM php:8.2.1-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/download/1.5.52/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
  install-php-extensions imagick && \
  install-php-extensions pgsql

COPY php.ini.prod "$PHP_INI_DIR/php.ini"
COPY src/ /var/www/html/api
COPY assets/placeholder.png /media
