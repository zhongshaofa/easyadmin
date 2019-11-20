ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm-alpine

ARG PHP_EXTENSIONS
ARG MORE_EXTENSION_INSTALLER
ARG ALPINE_REPOSITORIES

COPY ./docker/extensions /tmp/extensions
WORKDIR /tmp/extensions

ENV EXTENSIONS=",${PHP_EXTENSIONS}," \
    MC="-j$(nproc)" \
    TIMEZONE=${timezone:-"Asia/Shanghai"}

RUN export MC="-j$(nproc)" \
    && chmod +x install.sh \
    && sh install.sh \
    && mv composer.phar /usr/local/bin/composer \
    && chmod a+x /usr/local/bin/composer \
    && rm -rf /tmp/extensions

RUN apk update \
# Ffmpeg
#    && apk add yasm && apk add ffmpeg \
# nodejs
    && apk add nodejs && apk add npm \
    && npm config set registry https://registry.npm.taobao.org \
# apidoc
    && npm install apidoc -g \
    && cd /usr/lib/node_modules/apidoc/node_modules/apidoc-core/lib/workers \
    && find -name 'api_group.js' | xargs perl -pi -e 's|group = group.replace|// group = group.replace|g' \
# Timezone
    && apk --no-cache add tzdata zeromq \
    && cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    && echo "[Date]\ndate.timezone=${TIMEZONE}" > /usr/local/etc/php/conf.d/timezone.ini


WORKDIR /var/www/html
