FROM php:8.3-fpm

WORKDIR /var/www/nb

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN apt-get update && apt-get install -y \
    libcurl4-gnutls-dev \
    libxml2-dev\
    libonig-dev \
    libssl-dev \
    libpcre3-dev \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip \
    && docker-php-ext-install pdo pdo_mysql mysqli bcmath sockets pcntl opcache exif intl calendar gettext soap 

# Additional PHP extensions
RUN docker-php-ext-install ctype
RUN docker-php-ext-install curl
RUN docker-php-ext-install dom
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install filter
RUN docker-php-ext-install xml

RUN pecl install redis \
    && docker-php-ext-enable redis

# Create a new group and user with provided IDs, and set it as the default user
RUN addgroup --gid ${GROUP_ID} nb && \
    adduser --disabled-password --gecos '' --uid ${USER_ID} --gid ${GROUP_ID} nb

# Set the user in the PHP image
USER nb

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer