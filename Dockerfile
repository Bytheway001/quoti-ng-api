FROM php:7.4.21-apache
WORKDIR /app
RUN apt-get update && apt-get install
RUN apt-get install -y zlib1g-dev libpng-dev libzip-dev
RUN apt-get install -y xvfb libfontconfig wkhtmltopdf
RUN docker-php-ext-install pdo pdo_mysql zip
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install gd
COPY composer.json .
COPY composer.lock .
COPY php.ini /usr/local/etc/php/conf.d/customphp.ini
RUN composer install
RUN chown -R www-data:www-data /app && a2enmod rewrite