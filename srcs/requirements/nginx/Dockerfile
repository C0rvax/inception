FROM alpine:3.20

RUN apk update && apk add --no-cache \
        nginx \
        openssl \
        procps

COPY conf/nginx.conf /etc/nginx/nginx.conf
COPY conf/default.conf /etc/nginx/conf.d/default.conf

COPY --chmod=0755 tools/script.sh /usr/local/bin/

EXPOSE 443

CMD ["/usr/local/bin/script.sh"]

# FROM debian:bullseye
#
# RUN apt-get update -y \
# 	&& apt-get install -y nginx openssl procps \
# 	&& rm -rf /var/lib/apt/lists/*
#
# COPY ./conf/default.conf /etc/nginx/sites-available/default
#
# COPY ./static/ .
#
# COPY --chmod=0755 ./tools/script.sh /usr/local/bin/
#
# CMD ["/usr/local/bin/script.sh"]
