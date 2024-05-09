FROM php:8.3.3-apache

# Basic
RUN apt-get update && apt install git libpq-dev zip unzip -y;

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer; \
    php -r "unlink('composer-setup.php');"

# Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN a2enmod rewrite; \
    sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf;

# PHP extensions and config
RUN docker-php-ext-install mysqli pgsql pdo pdo_mysql pdo_pgsql && docker-php-ext-enable pdo_mysql; \
    mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini";

# Permissions
#CMD chown -R www-data /var/www/html/public /var/www/html/storage



