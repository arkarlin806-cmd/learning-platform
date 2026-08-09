# FROM php:8.3-cli

# # System dependencies
# RUN apt-get update && apt-get install -y \
#     git \
#     unzip \
#     libzip-dev \
#     libpng-dev \
#     libjpeg62-turbo-dev \
#     libfreetype6-dev \
#     libonig-dev \
#     libxml2-dev \
#     && rm -rf /var/lib/apt/lists/*

# # GD
# RUN docker-php-ext-configure gd \
#     --with-freetype \
#     --with-jpeg

# # PHP extensions
# RUN docker-php-ext-install \
#     gd \
#     pdo_mysql \
#     mbstring \
#     exif \
#     pcntl \
#     bcmath \
#     zip

# # Composer
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www/html

# # Copy Laravel project
# COPY . .

# # Install Laravel dependencies
# RUN composer install \
#     --no-dev \
#     --optimize-autoloader \
#     --no-interaction

# # Laravel permissions
# RUN chown -R www-data:www-data storage bootstrap/cache

# RUN chmod -R 775 storage bootstrap/cache

# # Laravel cache
# RUN php artisan config:clear
# RUN php artisan route:clear
# RUN php artisan view:clear

# EXPOSE 8080

# # Railway PORT
# CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
FROM php:8.3-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

COPY . .

RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN php artisan optimize:clear

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT}"]