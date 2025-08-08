FROM nginx:1.28-alpine AS nginx

WORKDIR /var/www/html

COPY . /var/www/html/



COPY /resources/ops/docker/nginx/vhost.conf /etc/nginx/conf.d/default.conf
COPY --from=assets-build /var/www/html/public /var/www/html/