FROM debian:bullseye

RUN apt-get update -y \
	&& apt-get install -y curl php7.4-fpm php-mysqli \
	&& rm -rf /var/lib/apt/lists/*

COPY ./conf/wordpress.conf /etc/php/7.4/fpm/pool.d/www.conf

COPY --chmod=0755 ./tools/script.sh /usr/local/bin/

CMD ["/usr/local/bin/script.sh"]
