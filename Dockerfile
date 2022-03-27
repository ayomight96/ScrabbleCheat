FROM phpswoole/swoole:4.6.7-php8.0
ENV DISABLE_DEFAULT_SERVER=1

RUN apt-get update
#for mongodb driver
RUN apt-get install -y openssl libcurl4-openssl-dev pkg-config libssl-dev git

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

COPY . /var/www
COPY dev/usr/local/etc/php/php.ini /usr/local/etc/php/php.ini
COPY etc/supervisor/available.d/* /etc/supervisor/available.d/
RUN composer install --no-dev  --ignore-platform-reqs