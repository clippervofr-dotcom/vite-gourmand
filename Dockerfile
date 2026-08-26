FROM php:8.2-apache
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y pkg-config libssl-dev libzip-dev unzip

RUN a2dismod mpm_event mpm_worker 2>/dev/null; a2enmod mpm_prefork

RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN docker-php-ext-install pdo pdo_mysql bcmath zip

COPY composer.json .
COPY composer.lock .
COPY --from=composer:2.10 /usr/bin/composer /usr/bin/composer
RUN composer install

ENV APACHE_DOCUMENT_ROOT /var/www/html/public/

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . /var/www/html/

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["docker-entrypoint.sh"]
