FROM php:5.4-fpm

# Install required dependencies
RUN docker-php-ext-install mysql

RUN apt-get update -y && \
	apt-get install -y mysql-client && \
	apt-get install -y git

# Use Custom PHP.ini configuration
COPY config/php.ini /usr/local/etc/php/

# Use the RSA keys provided
RUN mkdir -p /.ssh_tmp
COPY ssh-keys/id_rsa /.ssh_tmp/
COPY ssh-keys/id_rsa.pub /.ssh_tmp/
COPY ssh-keys/known_hosts /.ssh_tmp/

# Install the WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
	chmod +x wp-cli.phar && \
	mv wp-cli.phar /usr/local/bin/wp

COPY config/php.sh /php.sh
ENTRYPOINT ["/php.sh"]
