FROM debian:jessie

RUN apt-get update && apt-get install -y \
    nginx

ADD nginx.conf /etc/nginx/
ADD restaurant.conf /etc/nginx/sites-available/
ADD client.conf /etc/nginx/sites-available/

RUN ln -s /etc/nginx/sites-available/client.conf /etc/nginx/sites-enabled/client \
&& ln -s /etc/nginx/sites-available/restaurant.conf /etc/nginx/sites-enabled/restaurant \
&& rm /etc/nginx/sites-enabled/default

RUN echo "upstream php-upstream-client { server php-client:9000; }" >> /etc/nginx/conf.d/upstream.conf
RUN echo "upstream php-upstream-restaurant { server php-restaurant:9000; }" >> /etc/nginx/conf.d/upstream.conf

CMD ["nginx"]

EXPOSE 80
