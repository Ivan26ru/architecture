FROM php:8.3-fpm

RUN mkdir -p /var/www/app

WORKDIR /var/www/app

ARG UID
ARG GID
ARG UNAME

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
    nano libxml2-dev sudo nodejs npm

# php
RUN apt-get update

RUN apt-get install -y
RUN apt-get install -y libicu-dev
RUN apt-get install -y libonig-dev
RUN apt-get install -y libzip-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libpq-dev
RUN apt-get install -y libjpeg-dev
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libwebp-dev
RUN apt-get install -y zip
RUN apt-get install -y unzip
RUN apt-get install -y git
RUN apt-get install -y mariadb-client
RUN apt-get install -y libmagickwand-dev
RUN apt-get install -y libmagickcore-dev

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install exif

RUN docker-php-ext-enable  \
    intl  \
    mbstring  \
    zip  \
    pdo \
    pdo_mysql  \
    pcntl  \
    gd  \
    mysqli \
    exif

# Debugger
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN groupadd --gid ${GID} ${UNAME} \
    && useradd --home-dir "/home/${UNAME}" --create-home --uid ${UID} \
    --gid ${GID} --shell /bin/bash --skel /dev/null ${UNAME}

RUN echo "${UNAME} ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers
RUN usermod -a -G www-data ${UNAME}

COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer

#COPY ./app .
COPY ./entrypoint.sh /entrypoint.sh

USER ${UNAME}

ENTRYPOINT ["/entrypoint.sh"]
