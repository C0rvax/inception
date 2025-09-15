FROM alpine:3.20

RUN apk update && apk add --update --no-cache \
    hugo \
    git \
    shadow \
    && rm -f /var/cache/apk/*

RUN hugo new site /var/hugo/static

WORKDIR /var/hugo/static

# COPY ./conf/config.toml ./hugo.toml
# COPY ./conf/baseof.html ./layouts/_default/baseof.html
# COPY ./conf/index.html ./layouts/index.html
# COPY ./conf/style.css ./static/style.css
# COPY ./conf/index.md ./content/index.html

COPY ./conf/ .

EXPOSE 8800

CMD ["hugo", "server", "--bind=0.0.0.0", "--baseURL=https://aduvilla.42.fr/hugo/", "-p", "8800", "--appendPort=false"]
