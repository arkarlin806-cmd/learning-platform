# # =========================
# # Frontend Build
# # =========================

# FROM node:20 AS frontend

# WORKDIR /app

# COPY package*.json ./

# RUN npm install

# COPY . .

# RUN npm run build

# RUN test -f public/build/manifest.json


# # =========================
# # Laravel
# # =========================

# FROM php:8.3-cli

# WORKDIR /var/www/html


# # =========================
# # System Dependencies
# # =========================

# RUN apt-get update && apt-get install -y \
#     git \
#     unzip \
#     ffmpeg \
#     libzip-dev \
#     libpng-dev \
#     libjpeg62-turbo-dev \
#     libfreetype6-dev \
#     libonig-dev \
#     && docker-php-ext-configure gd \
#         --with-freetype \
#         --with-jpeg \
#     && docker-php-ext-install \
#         pdo_mysql \
#         mbstring \
#         exif \
#         pcntl \
#         bcmath \
#         gd \
#         zip \
#     && rm -rf /var/lib/apt/lists/*


# # =========================
# # PHP Upload Configuration
# # =========================

# RUN printf "upload_max_filesize=500M\n\
# post_max_size=520M\n\
# memory_limit=512M\n\
# max_execution_time=900\n\
# max_input_time=900\n\
# max_file_uploads=20\n" \
# > /usr/local/etc/php/conf.d/uploads.ini


# # =========================
# # Verify PHP Configuration
# # =========================

# RUN php -i | grep -E \
#     "upload_max_filesize|post_max_size|memory_limit|max_execution_time|max_input_time"


# # =========================
# # Composer
# # =========================

# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# # =========================
# # Laravel Source
# # =========================

# COPY . .


# # =========================
# # Copy Vite Production Build
# # =========================

# COPY --from=frontend /app/public/build /var/www/html/public/build


# # =========================
# # Composer Install
# # =========================

# RUN composer install \
#     --no-dev \
#     --no-interaction \
#     --prefer-dist \
#     --optimize-autoloader


# # =========================
# # Laravel Directories
# # =========================

# RUN mkdir -p \
#     storage/framework/cache \
#     storage/framework/sessions \
#     storage/framework/views \
#     storage/logs \
#     storage/app/temp \
#     storage/app/chunks \
#     bootstrap/cache


# # =========================
# # Permissions
# # =========================

# RUN chmod -R 775 storage bootstrap/cache


# # =========================
# # Storage Link
# # =========================

# RUN php artisan storage:link || true


# # =========================
# # Port
# # =========================

# EXPOSE 8080


# # =========================
# # Start Laravel
# # =========================

# CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]


# =========================
# Frontend Build
# =========================
FROM node:20 AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

RUN test -f public/build/manifest.json


# =========================
# Laravel
# =========================
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
    ffmpeg \
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


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

COPY --from=frontend /app/public/build /var/www/html/public/build


RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader


RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    storage/app/public \
    bootstrap/cache


RUN php artisan storage:link || true


RUN chmod -R 775 storage bootstrap/cache


EXPOSE 8080

CMD ["sh", "-c", "php artisan optimize:clear && php artisan storage:link || true && php artisan serve --host=0.0.0.0 --port=8080"]