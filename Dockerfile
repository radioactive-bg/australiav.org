FROM wordpress:php8.2-fpm-alpine

# Install dependencies + copy WordPress
RUN apk add --no-cache bash coreutils curl tar nginx mysql-client mariadb-connector-c \
    && cp -r /usr/src/wordpress/* /var/www/html/ \
    && cp /usr/src/wordpress/wp-config-docker.php /var/www/html/ \
    && ln -sf /var/www/html/wp-config-docker.php /var/www/html/wp-config.php \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p /var/log/nginx \
    && touch /var/log/nginx/access.log /var/log/nginx/error.log

    
# Install wp-cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
 && chmod +x wp-cli.phar \
 && mv wp-cli.phar /usr/local/bin/wp

COPY ./wp-content /var/www/html/wp-content
COPY ./australiav-db-dump.sql /var/www/html/australiav-db-dump.sql
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./entrypoint.sh /entrypoint.sh
#COPY ./.htpasswd /etc/nginx/.htpasswd

# Entrypoint and permissions
RUN chmod +x /entrypoint.sh \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]
