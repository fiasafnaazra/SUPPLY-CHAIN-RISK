#!/bin/sh
set -e

PORT="${PORT:-8080}"
echo "Configuring Apache to listen on port $PORT..."

# Rewrite ports.conf cleanly
cat > /etc/apache2/ports.conf << EOF
Listen $PORT
EOF

# Rewrite 000-default.conf cleanly with AllowOverride All for Laravel routing
cat > /etc/apache2/sites-available/000-default.conf << EOF
<VirtualHost *:$PORT>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        Options FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

echo "Creating SQLite database..."
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chmod 666 /var/www/html/database/database.sqlite

echo "Setting up .env file..."
cat > /var/www/html/.env << EOF
APP_NAME="Supply Chain Risk"
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY:-base64:7f9Q8+uV/8N0g1KxL9mX2sQ3vR4wT5yU6zI7oP8aB9c=}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-${RENDER_EXTERNAL_URL:-http://localhost}}
LOG_CHANNEL=stderr
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_CONNECTION=sync
CACHE_STORE=file
EOF

echo "Clearing cache..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

echo "Running migrations..."
php artisan migrate --force || true

echo "Running seeders..."
php artisan db:seed --force || true

echo "Starting Apache server on port $PORT..."
exec apache2-foreground
