# FROM php:8.3-cli

# WORKDIR /var/www/html

# RUN apt-get update && apt-get install -y \
#     git \
#     unzip \
#     libzip-dev \
#     libpng-dev \
#     libjpeg62-turbo-dev \
#     libfreetype6-dev \
#     libonig-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install \
#     pdo_mysql \
#     mbstring \
#     exif \
#     pcntl \
#     bcmath \
#     gd \
#     zip \
#     && rm -rf /var/lib/apt/lists/*

# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# # Copy Laravel project FIRST
# COPY . .

# # Install Composer dependencies
# RUN composer install \
#     --no-dev \
#     --no-interaction \
#     --prefer-dist \
#     --optimize-autoloader

# # Laravel directories
# RUN mkdir -p \
#     storage/framework/cache \
#     storage/framework/sessions \
#     storage/framework/views \
#     storage/logs \
#     bootstrap/cache

# RUN chmod -R 775 storage bootstrap/cache

# RUN php artisan optimize:clear

# EXPOSE 8080

# CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t public"]



# Frontend build
FROM node:20 AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build


# Laravel backend
FROM php:8.3-cli

WORKDIR /var/www/html

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel project
COPY . .

# Copy Vite build files
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel optimize
RUN php artisan optimize:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080