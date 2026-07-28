# PHP Application (pre-built assets included)
FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libxml2-dev \
    libzip-dev \
    libsqlite3-dev \
    libonig-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite mbstring xml zip bcmath

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files (includes pre-built public/build assets)
COPY . .

# Install PHP dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Set permissions for storage & cache
RUN chmod -R 777 storage bootstrap/cache

# Write .env for build
RUN echo "APP_NAME='Supply Chain Risk'\nAPP_ENV=production\nAPP_KEY=base64:7f9Q8+uV/8N0g1KxL9mX2sQ3vR4wT5yU6zI7oP8aB9c=\nAPP_DEBUG=false\nAPP_URL=http://localhost\nDB_CONNECTION=sqlite\nDB_DATABASE=/var/www/html/database/database.sqlite\nSESSION_DRIVER=file\nQUEUE_CONNECTION=sync\nCACHE_STORE=file\nLOG_CHANNEL=stderr" > .env

# Create SQLite database file
RUN touch database/database.sqlite && chmod 666 database/database.sqlite

RUN php artisan config:clear || true
RUN php artisan storage:link || true

EXPOSE 8080

# Entrypoint: run migrations then start Apache
COPY docker-entrypoint-apache.sh /usr/local/bin/docker-entrypoint
RUN sed -i 's/\r$//' /usr/local/bin/docker-entrypoint && chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
