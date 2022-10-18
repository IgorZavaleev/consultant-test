FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install -j$(nproc) mysqli pdo_mysql \
    && rm /usr/local/etc/php-fpm.d/* \
    && curl -sS https://getcomposer.org/installer > composer-setup.php \
        && php composer-setup.php && rm composer-setup.php* \
        && chmod +x composer.phar && mv composer.phar /usr/bin/composer

COPY docker-config/php/localhost.conf /usr/local/etc/php-fpm.d/

WORKDIR /www
COPY . .

RUN /usr/bin/composer install

CMD ["php-fpm"]
