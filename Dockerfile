# Development build
FROM php:fpm-alpine as base

# ONLY FOR PRODUCTION !! #######################################################################
ENV WORKPATH "/var/www/bileMo"
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV APP_ENV "prod"
ENV APP_SECRET "72e4c82ed7088d4da4209cf01708a279"
ENV CONTAINER_NAME "bileMo"
ENV WORKPATH "/var/www/bileMo"
ENV URL_ROOT "http://195.154.164.62:8085/"
ENV BLACKFIRE_SERVER_ID "a7c67634-5e4b-4afb-812f-e6d12984da04"
ENV BLACKFIRE_SERVER_TOKEN "80b4a84db81eeec45e752f5559f5e9c37a7b83df6399c3042fac19704e8a78df"
ENV BLACKFIRE_CLIENT_ID "8d309eeb-5bf6-431a-8f68-4b57ffac80ec"
ENV BLACKFIRE_CLIENT_TOKEN "8f925ffa61c6481d3ff8b3e35bd43e6c3f499ab5d0edf8a2996d7d9c47f8dce2"
ENV NGINX_PORT 8085
ENV PHP_PORT 9500
ENV VARNISH_PORT 8081
ENV REDIS_PORT 6379
ENV REDIS_URL "redis://195.154.164.62"
ENV CODACY_PROJECT_TOKEN "79e6369b6168446a9d78f31dddb2ac65"
ENV POSTGRES_CHARSET "utf8"
ENV POSTGRES_DB "bileMo"
ENV POSTGRES_USER "lolo"
ENV POSTGRES_PASSWORD "test"
ENV POSTGRES_PORT 5432
ENV DB_HOST "195.154.164.62"
ENV DB_DRIVER_DEV "pdo_pgsql"
ENV DB_CHARSET_DEV "utf8"
ENV DB_VERSION_DEV 9.6
ENV DATABASE_URL_DEV "pgsql://lolo:test@195.154.164.62:5432/bileMo"
ENV DB_CHARSET_TEST "utf8mb4"
ENV DB_VERSION_TEST 5.7
ENV DB_DRIVER_TEST "pdo_sqlite"
ENV DATABASE_URL_TEST "sqlite:///%kernel.project_dir%/var/data.db"
ENV MAILER_URL "gmail://lolosambo2:01mars1977@195.154.164.62"
ENV JWT_SECRET_KEY "%kernel.project_dir%/config/jwt/private.pem"
ENV JWT_PUBLIC_KEY "%kernel.project_dir%/config/jwt/public.pem"
ENV JWT_PASSPHRASE "winteriscoming"
############################################################################

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev postgresql-dev gnupg graphviz make autoconf git zlib-dev curl chromium go \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install zip intl pdo_pgsql pdo_mysql opcache json pgsql mysqli \
    && pecl install apcu redis \
    && docker-php-ext-enable apcu mysqli redis

COPY docker/php/conf/php.ini /usr/local/etc/php/php.ini

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Blackfire (Docker approach) & Blackfire Player
RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/alpine/amd64/$version \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
    && mv /tmp/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
    && mkdir -p /tmp/blackfire \
    && curl -A "Docker" -L https://blackfire.io/api/v1/releases/client/linux_static/amd64 | tar zxp -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire /usr/bin/blackfire \
    && rm -Rf /tmp/blackfire

# PHP-CS-FIXER & Deptrac
RUN wget http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -O php-cs-fixer \
    && chmod a+x php-cs-fixer \
    && mv php-cs-fixer /usr/local/bin/php-cs-fixer \
    && curl -LS http://get.sensiolabs.de/deptrac.phar -o deptrac.phar \
    && chmod +x deptrac.phar \
    && mv deptrac.phar /usr/local/bin/deptrac

RUN mkdir -p ${WORKPATH}

RUN rm -rf ${WORKDIR}/vendor \
    && ls -l ${WORKDIR}

RUN mkdir -p \
		${WORKDIR}/var/cache \
		${WORKDIR}/var/logs \
		${WORKDIR}/var/sessions \
	&& chown -R www-data ${WORKDIR}/var \
	&& chown -R www-data /tmp/

RUN chown www-data:www-data -R ${WORKPATH}

WORKDIR ${WORKPATH}

COPY . ./

EXPOSE 9500

CMD ["php-fpm"]

## Production build
FROM base

COPY docker/php/conf/production/php.ini /usr/local/etc/php/php.ini

