FROM php:7.3-fpm

RUN rm /etc/apt/preferences.d/no-debian-php && \
    apt-get update -y && apt-get install -y libpng-dev libxml2-dev libzip-dev php-soap unzip

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install json gd zip soap dom

RUN pecl install xdebug-2.9.6 && docker-php-ext-enable xdebug
RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini
RUN echo 'memory_limit=1024M' >> /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install -y git

# Replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# Set debconf to run non-interactively
RUN echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections

# Install base dependencies
RUN apt-get update && apt-get install -y -q --no-install-recommends \
    apt-transport-https \
    build-essential \
    libssl-dev \
    curl \
    git \
    wget \
    && rm -rf /var/lib/apt/lists/*

#ENV NVM_DIR /usr/local/nvm
#ENV NVM_DIR ~/.nvm
#ENV NVM_DIR /root/.nvm
#ENV NODE_VERSION 11.15.0

# Install nvm with node and npm
#RUN curl https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.3/install.sh | bash \
#    && . $NVM_DIR/nvm.sh \
#    && nvm install $NODE_VERSION \
#    && nvm alias default $NODE_VERSION \
#    && nvm use default \
#    && npm install --global gulp-cli@2.2.0 \
#    && npm install --save-dev gulp@3.9.1

#ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
#ENV PATH      $NVM_DIR/v$NODE_VERSION/bin:$PATH
