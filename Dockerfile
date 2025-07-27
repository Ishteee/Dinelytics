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
    npm

# Install PHP extensions required by Laravel
RUN docker-php-ext-install \
    pdo \
    pdo_sqlite \
    bcmath \
    mbstring \
    zip

# Install Composer (PHP package manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application files to the container
COPY . .

# Set correct permissions for storage and bootstrap cache directories
# This is a crucial step for Laravel to work correctly.
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and start php-fpm server
# Note: This is for the internal container. Render handles the external port mapping.
EXPOSE 9000
CMD ["php-fpm"]
