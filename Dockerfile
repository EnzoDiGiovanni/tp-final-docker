FROM php:8.4-fpm
WORKDIR /var/www/html

RUN apt-get update -y \
 && apt-get install -y openssl zip unzip git libicu-dev zlib1g-dev libzip-dev gnupg \
 && docker-php-ext-configure intl \
 && docker-php-ext-install mysqli pdo pdo_mysql \
 && docker-php-ext-enable pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN curl -fsSL https://deb.nodesource.com/setup_current.x | bash - \
 && apt-get install -y nodejs
RUN composer install
RUN npm install && npm run build

CMD ["php-fpm"]

EXPOSE 9000
