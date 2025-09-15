FROM debian:bullseye

RUN apt-get update -y \
	&& apt-get install mariadb-server netcat -y \
	&& rm -rf /var/lib/apt/lists/*

COPY ./conf/mariadb.conf /etc/mysql/mariadb.conf.d/50-server.cnf

COPY --chmod=0755 ./tools/script.sh /usr/local/bin/

CMD ["/usr/local/bin/script.sh"]
