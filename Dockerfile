
# # Frontend build
# FROM node:20 AS frontend

# WORKDIR /app

# COPY package*.json ./

# RUN npm install

# COPY . .

# RUN npm run build


# # Laravel backend
# FROM php:8.3-cli

# WORKDIR /var/www/html

# # PHP extensions
# RUN docker-php-ext-install pdo pdo_mysql

# # Composer
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# # Copy Laravel project
# COPY . .

# # Copy Vite build files
# COPY --from=frontend /app/public/build ./public/build

# # Install PHP dependencies
# RUN composer install --no-dev --optimize-autoloader

# # Laravel optimize
# RUN php artisan optimize:clear \
#     && php artisan config:cache \
#     && php artisan route:cache \
#     && php artisan view:cache

# EXPOSE 8080

# CMD php artisan serve --host=0.0.0.0 --port=8080


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
# Laravel Application
# =========================
FROM php:8.3-cli

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

# IMPORTANT: Copy Vite build into final image
COPY --from=frontend /app/public/build /var/www/html/public/build

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

RUN php artisan optimize:clear

RUN php artisan config:cache

RUN php artisan view:cache

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]