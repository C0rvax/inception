#!/bin/bash

USER_PWD=$(cat "$DB_USER_PWD_FILE")
ADM_PWD=$(cat "$WP_ADM_PWD_FILE")
WP_PWD=$(cat "$WP_AUTHOR_PWD_FILE")
REDIS_PWD=$(cat "$REDIS_PWD_FILE")

if [ ! -f /var/www/html/wp-config.php ]; then
	cd /var/www/html

	curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
	chmod +x wp-cli.phar
	mv wp-cli.phar /usr/local/bin/wp

	wp core download --allow-root
	wp config create --dbname=$DB_NAME --dbuser=$MYSQL_USER --dbpass=$USER_PWD --dbhost=mariadb --allow-root
	wp core install --url="${DOMAIN_NAME%/}" --title=$TITLE --admin_user=$WP_ADM --admin_password=$ADM_PWD --admin_email=$WP_ADM_EMAIL --skip-email --allow-root
	wp user create $WP_USER $WP_USER_EMAIL --role=author --user_pass=$WP_PWD --allow-root

	# REDIS CONFIG
	wp config set FS_METHOD direct --allow-root --type=constant
	wp config set WP_REDIS_HOST redis --allow-root --type=constant
	wp config set WP_REDIS_PORT 6379 --allow-root --type=constant --raw
	wp config set WP_REDIS_PASSWORD "$REDIS_PWD" --allow-root --type=constant

	wp plugin install redis-cache --activate --allow-root
	wp redis enable --allow-root
fi

chown -R www-data:www-data /var/www/html/
chmod -R g+w /var/www/html/

mkdir -p /run/php

exec php-fpm7.4 -F
