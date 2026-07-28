# PHP Application (pre-built assets included)
FROM php:8.4-cli

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

EXPOSE 8080

# Copy and setup entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN sed -i 's/\r$//' /usr/local/bin/docker-entrypoint && chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
