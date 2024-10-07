FROM php:fpm

# Install necessary PHP extensions and tools
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /app

# Copy the composer.json file
COPY composer.json /app/

# Install Composer dependencies
RUN composer install

# Copy the rest of the application files
COPY . .