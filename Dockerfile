from php:apache

RUN docker-php-ext-install mysqli && docker-php-ext-install pdo_mysql

COPY --chown=www-data:www-data . /var/www/html/
