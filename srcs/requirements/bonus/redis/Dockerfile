FROM debian:bullseye

RUN apt-get update -y \
	&& apt-get install -y redis-server procps \
	&& rm -rf /var/lib/apt/lists/*

COPY --chmod=0755 ./tools/script.sh /usr/local/bin/

CMD ["/usr/local/bin/script.sh"]
