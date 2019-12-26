FROM ubuntu:18.04
ENV TZ=America/Los_Angeles
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update
RUN apt-get install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt-get update
RUN apt-get install -y  mariadb-server  mariadb-client curl
RUN apt-get install -y  gettext php7.2 php7.2-opcache php7.2-mbstring php-memcached php7.2-mysql php7.2-fpm curl php7.2-curl php7.2-gd php7.2-imagick php7.2-json php-psr
RUN apt-get install -y php-phalcon git
RUN echo extension=psr.so | tee -a /etc/php/7.2/fpm/php.ini
RUN apt-get install -y nginx vim
COPY default.conf.prod /etc/nginx/sites-available/default
RUN mkdir /app/
RUN mkdir /startup/
COPY services.sh /startup/services.sh
RUN apt-get install libpcre3-dev -y
RUN curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | bash
RUN apt-get install php7.2-phalcon
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'baf1608c33254d00611ac1705c1d9958c817a1a33bce370c0595974b342601bd80b92a3f46067da89e3b06bff421f182') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    mv composer.phar /usr/local/bin/composer
ENTRYPOINT /startup/services.sh
EXPOSE 80 9000 3306



