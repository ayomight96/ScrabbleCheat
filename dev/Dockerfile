FROM phpswoole/swoole:4.6.7-php8.0
ENV DISABLE_DEFAULT_SERVER=1

RUN apt-get update
#for mongodb driver
RUN apt-get install -y openssl libcurl4-openssl-dev pkg-config libssl-dev libboost-all-dev

RUN pecl install mongodb \
    && pecl install inotify \
    && docker-php-ext-enable mongodb 
# && docker-php-ext-enable inotify
RUN apt-get install -y git

RUN git clone -b v0.3.9 https://github.com/swoole/yasd && cd yasd && phpize --clean && \
    phpize && \
    ./configure && \
    make clean && \
    make && \
    make install

RUN echo "zend_extension=yasd" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini \
    # && echo "yasd.idekey=vscode" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini \
    && echo "yasd.debug_mode=remote" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini \
    #&& echo "yasd.remote_host=docker.for.mac.host.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini \
    # && echo "yasd.remote_host=172.17.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini \
    # && echo "yasd.remote_host=127.0.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini \
    && echo "yasd.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini \
    && echo "yasd.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini   \
    && echo "yasd.log_level=0" >> /usr/local/etc/php/conf.d/docker-php-ext-yasd.ini

RUN docker-php-ext-enable inotify
# RUN sed -E -i -e 's/post_max_size = 8M/post_max_size = 64M/' /etc/php.ini \
#  && sed -E -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 64M/' /etc/php.ini

# COPY etc/supervisor/available.d/* /etc/supervisor/available.d/
# COPY usr/local/boot/* /usr/local/boot
COPY usr/local/etc/php/* /usr/local/etc/php/