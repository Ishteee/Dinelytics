# Use an official PHP image as a base. Alpine is lightweight.
FROM php:8.2-fpm-alpine

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies needed for Laravel
# and PHP extensions.
RUN apk add --no-cache \
    build-base \
    libzip-dev \
    zip \
    oniguruma-dev \
    # Install git for composer
    git \
    # Install Node.js and npm for frontend assets
    nodejs \
    npm \
    # Install SQLite driver
    sqlite-dev

# Install PHP extensions required by Laravel
RUN docker-php-ext-install \
    pdo \
    pdo_sqlite \
    bcmath \
    mbstring \
    zip

# Install Composer (PHP package manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files and install dependencies
# This leverages Docker layer caching.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copy the rest of the application files
COPY . .

# Build frontend assets
RUN npm install && npm run build

# Generate application key and cache configurations
# We use --show to output the key, but it's handled by Render's env vars.
# The main purpose here is to ensure commands run.
RUN php artisan key:generate --force
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Set correct permissions for storage and bootstrap cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose the port Laravel will run on. Render will map this to 80/443.
EXPOSE 10000

# The command to start the application server.
# This is what Render will execute when the container starts.
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
