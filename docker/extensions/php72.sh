#!/bin/sh

echo
echo "============================================"
echo "Install extensions from   : ${MORE_EXTENSION_INSTALLER}"
echo "PHP version               : ${PHP_VERSION}"
echo "Extra Extensions          : ${PHP_EXTENSIONS}"
echo "Multicore Compilation     : ${MC}"
echo "Work directory            : ${PWD}"
echo "============================================"
echo


if [ -z "${EXTENSIONS##*,mcrypt,*}" ]; then
    echo "---------- mcrypt was REMOVED from PHP 7.2.0 ----------"
fi


if [ -z "${EXTENSIONS##*,mysql,*}" ]; then
    echo "---------- mysql was REMOVED from PHP 7.0.0 ----------"
fi


if [ -z "${EXTENSIONS##*,sodium,*}" ]; then
    echo "---------- Install sodium ----------"
    echo "Sodium is bundled with PHP from PHP 7.2.0 "
fi

if [ -z "${EXTENSIONS##*,amqp,*}" ]; then
    echo "---------- Install amqp ----------"
    apk add --no-cache rabbitmq-c-dev
    cd /tmp/extensions
    pecl install amqp-1.9.4.tgz
    docker-php-ext-enable amqp
fi

if [ -z "${EXTENSIONS##*,redis,*}" ]; then
    echo "---------- Install redis ----------"
    mkdir redis \
    && tar -xf redis-4.1.1.tgz -C redis --strip-components=1 \
    && ( cd redis && phpize && ./configure && make ${MC} && make install ) \
    && docker-php-ext-enable redis
fi


if [ -z "${EXTENSIONS##*,memcached,*}" ]; then
    echo "---------- Install memcached ----------"
	apk add --no-cache libmemcached-dev zlib-dev
    printf "\n" | pecl install memcached-3.1.3
    docker-php-ext-enable memcached
fi


if [ -z "${EXTENSIONS##*,pcntl,*}" ]; then
    echo "---------- Install swoole ----------"
    mkdir pcntl \
    && tar -xf pcntl-5.0.0rc1.tgz -C pcntl --strip-components=1 \
    && ( cd pcntl && phpize && ./configure --enable-openssl && make ${MC} && make install ) \
    && docker-php-ext-enable pcntl
fi


if [ -z "${EXTENSIONS##*,pdo_sqlsrv,*}" ]; then
    echo "---------- Install pdo_sqlsrv ----------"
	apk add --no-cache unixodbc-dev
    pecl install pdo_sqlsrv
    docker-php-ext-enable pdo_sqlsrv
fi


if [ -z "${EXTENSIONS##*,swoole,*}" ]; then
    echo "---------- Install swoole ----------"
	apk add --no-cache unixodbc-dev
    pecl install swoole
    docker-php-ext-enable swoole
fi


if [ -z "${EXTENSIONS##*,xdebug,*}" ]; then
    echo "---------- Install xdebug ----------"
	apk add --no-cache unixodbc-dev
    pecl install xdebug
    docker-php-ext-enable xdebug
fi


if [ -z "${EXTENSIONS##*,sqlsrv,*}" ]; then
    echo "---------- Install sqlsrv ----------"
	apk add --no-cache unixodbc-dev
    printf "\n" | pecl install sqlsrv
    docker-php-ext-enable sqlsrv
fi
