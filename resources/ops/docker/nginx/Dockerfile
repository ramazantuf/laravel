FROM nginx:1.28-alpine AS nginx
LABEL org.opencontainers.image.source https://github.com/ramazantuf/laravel
WORKDIR /var/www/html

COPY . /var/www/html/

COPY /resources/ops/docker/nginx/vhost.conf /etc/nginx/conf.d/default.conf
