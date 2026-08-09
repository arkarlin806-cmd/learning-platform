FROM php:8.3-cli

WORKDIR /var/www/html

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Node.js 20 + npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && node -v \
    && npm -v

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Laravel project
COPY . .

# Create Laravel directories
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["sh", "-c", "composer install --no-dev --optimize-autoloader && npm install && npm run build && php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=8080"]