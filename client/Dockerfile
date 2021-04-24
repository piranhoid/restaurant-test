FROM php:7.3-fpm-alpine

RUN apk update \
&& apk add --virtual build-dependencies \
build-base \
gcc \
wget \
autoconf \
git

RUN docker-php-ext-install pdo_mysql

# Add AMQP extension
RUN apk add \
        --repository http://dl-cdn.alpinelinux.org/alpine/v3.6/main \
        --no-cache \
        rabbitmq-c-dev \
        && pecl install amqp \
        && docker-php-ext-enable amqp

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/client

CMD composer install ;  php-fpm
EXPOSE 9000
