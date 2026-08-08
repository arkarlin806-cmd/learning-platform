FROM php:8.3-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

RUN docker-php-ext-install \
    gd \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip

# Apache rewrite
RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy Laravel project
COPY . .

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Laravel permissions
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

RUN chmod -R 775 \
    storage \
    bootstrap/cache

# Laravel public directory
RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' \
    /etc/apache2/sites-available/000-default.conf

RUN sed -i '/<VirtualHost \*:80>/a \
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' \
    /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]