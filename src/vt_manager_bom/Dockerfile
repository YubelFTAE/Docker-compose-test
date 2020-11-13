FROM php:7.0-apache
RUN a2enmod rewrite \
    ssl \
    proxy \
    proxy_http \
    proxy_ajp \
    deflate \
    headers \
    proxy_balancer \
    proxy_connect \
    proxy_html
COPY . /var/www/html