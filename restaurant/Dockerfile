FROM php:7.3-fpm-alpine

RUN apk update \
&& apk add --virtual build-dependencies \
build-base \
gcc \
wget \
autoconf \
git

RUN docker-php-ext-install pdo_mysql

ADD docker_init.sh /root/docker_init.sh
RUN ["chmod", "+x", "/root/docker_init.sh"]

RUN apk add supervisor
ADD supervisord.conf /etc/supervisor/
ADD messenger-worker.conf /etc/supervisor/conf.d/

# Add AMQP extension
RUN apk add \
        --repository http://dl-cdn.alpinelinux.org/alpine/v3.6/main \
        --no-cache \
        rabbitmq-c-dev \
        && pecl install amqp \
        && docker-php-ext-enable amqp

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/restaurant

CMD /root/docker_init.sh ; composer install ;  php-fpm
EXPOSE 9000
