FROM nginx:1.13.7-alpine

COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/symfony.conf.dev /tmp/default.conf.dev
COPY ./docker/nginx/start.sh /usr/local/bin/

WORKDIR /var/www/symfony

EXPOSE 80
