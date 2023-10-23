FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
	git \
	curl \
	libjpeg62-turbo-dev \
	libpng-dev \
	libonig-dev \
	libwebp-dev \
	libxml2-dev \
	libzip-dev \
	sudo \
	unzip \
	zip \
	zlib1g-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure PHP extensions
RUN docker-php-ext-configure gd --with-webp --with-jpeg

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add CA Certificates
ADD http://www.cacert.org/certs/root.crt /usr/local/share/ca-certificates/cacert.crt
COPY ./docker-compose/certs/* /usr/local/share/ca-certificates/.

RUN update-ca-certificates

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user