#
# PHP Setup
#

ARG PHP_VERSION=7.4.9

FROM php:${PHP_VERSION}-cli as V8

RUN set -xe; \
    apt-get update && \
    apt-get install -y --no-install-recommends \
        python \
        curl \
        git \
        build-essential \
        libglib2.0-dev \
        libxml2 \
        libtinfo5 \
        libtinfo-dev \
        patchelf && \
    cd /tmp && \
        git clone https://chromium.googlesource.com/chromium/tools/depot_tools.git --progress --verbose && \
        export PATH="$PATH:/tmp/depot_tools" && \
            fetch v8 && \
            cd v8 && \
            git checkout 7.4.288.21 && \
            gclient sync && \
            tools/dev/v8gen.py -vv x64.release -- is_component_build=true use_custom_libcxx=false && \
        export PATH="$PATH:/tmp/depot_tools" && \
            cd /tmp/v8 && \
            ninja -C out.gn/x64.release/ && \
            mkdir -p /opt/v8/lib && mkdir -p /opt/v8/include && \
            cp out.gn/x64.release/lib*.so out.gn/x64.release/*_blob.bin out.gn/x64.release/icudtl.dat /opt/v8/lib/ && \
            cp -R include/* /opt/v8/include/ && \
            for A in /opt/v8/lib/*.so; do patchelf --set-rpath '$ORIGIN' $A;done && \
        cd /tmp && \
            git clone https://github.com/phpv8/v8js.git && \
            cd v8js && \
            phpize && \
            ./configure --with-v8js=/opt/v8 LDFLAGS="-lstdc++" && \
            make && \
            make test && \
            make install && \
    docker-php-ext-enable \
        v8js


FROM php:${PHP_VERSION}-cli

#
# Install dependencies
#

COPY --from=V8 /opt /opt
COPY --from=V8 /usr/local/etc/php/conf.d/docker-php-ext-v8js.ini /usr/local/etc/php/conf.d/
COPY --from=V8 /usr/local/lib/php/extensions/no-debug-non-zts-20190902 /usr/local/lib/php/extensions/no-debug-non-zts-20190902

RUN set -xe; \
    apt-get update && \
    apt-get install -y \
        curl \
        zip \
        zlib1g-dev \
        libzip-dev \
        libicu-dev && \
    pecl install \
        xdebug-2.9.6 && \
    docker-php-ext-install \
        zip \
        intl && \
    docker-php-ext-enable \
        xdebug && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* \
           /tmp/* \
           /var/tmp/* \
           /var/log/lastlog \
           /var/log/faillog

#
# Workspace User
#

ARG APP_USER_ID=1000
ARG APP_GROUP_ID=1000

RUN set -xe; \
    groupadd -f workspace && \
    groupmod -g ${APP_GROUP_ID} workspace && \
    useradd workspace -g workspace && \
    mkdir -p /home/workspace && chmod 755 /home/workspace && chown workspace:workspace /home/workspace && \
    usermod -u ${APP_USER_ID} -m -d /home/workspace workspace -s $(which bash) && \
    chown -R workspace:workspace /var/www/html

#
# Set Timezone
#

ARG TIME_ZONE='Asia/Seoul'

RUN ln -snf /usr/share/zoneinfo/${TIME_ZONE} /etc/localtime && echo ${TIME_ZONE} > /etc/timezone

#
# Composer Setup
#

ARG COMPOSER_VERSION=1.10.10
ARG COMPOSER_REPO_PACKAGIST='https://packagist.jp'

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} && \
    composer config -g repos.packagist composer ${COMPOSER_REPO_PACKAGIST} && \
    composer global require hirak/prestissimo --no-interaction

WORKDIR /var/www/html
