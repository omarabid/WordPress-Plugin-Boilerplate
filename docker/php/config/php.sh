#!/bin/bash

# Clean any files 
cd /wp
rm -rf /wp/*
rm -rf /devl/*

# Setup RSA Keys
mkdir -p ~/.ssh
mv /.ssh_tmp/id_rsa ~/.ssh/id_rsa
mv /.ssh_tmp/id_rsa.pub ~/.ssh/id_rsa.pub
mv /.ssh_tmp/known_hosts ~/.ssh/known_hosts
rm -r /.ssh_tmp

# Download a new version of WordPress
wp core download --path=/wp --version=$WP_VERSION --allow-root

# Configure WordPress
wp core config --dbname=$MYSQL_DATABASE --dbuser=root --dbpass=$MYSQL_ROOT_PASSWORD --dbhost=$DB_PORT_3306_TCP_ADDR --allow-root --extra-php <<PHP
define( 'WP_DEBUG', true );
define( 'SAVE_QUERIES', true );
define( 'WP_DEBUG_LOG', true );
PHP

# Install WordPress
wp core install --url=$WP_URL --title=$WP_TITLE --admin_user=$WP_USERNAME --admin_password=$WP_PASSWORD --admin_email=$WP_EMAIL --allow-root

# Enable Smart Permalinks
wp rewrite structure '/%postname%' --allow-root

# Remove Default WordPress Plugins
wp plugin delete hello --allow-root
wp plugin delete akismet --allow-root

# Install dependency Plugins
array=(${WP_PLUGINS//:/ })
for i in "${!array[@]}"
do
    wp plugin install ${array[i]} --activate --allow-root
done

# Install dependency Themes
array=(${WP_THEMES//:/ })
for i in "${!array[@]}"
do
    wp theme install ${array[i]} --activate --allow-root
done

# Install development Plugins
array=(${WP_DEV_PLUGINS//|/ })
for i in "${!array[@]}"
do
   git clone ${array[i]} /wp/wp-content/plugins/plugin-$i  
   wp plugin activate plugin-$i --allow-root
   mv /wp/wp-content/plugins/plugin-$i /devl/plugin-$i
   ln -s /devl/plugin-$i /wp/wp-content/plugins/plugin-$i
done

# Install development Themes
array=(${WP_DEV_THEMES//:/ })
for i in "${!array[@]}"
do
	git clone ${array[i]} /wp/wp-content/themes/theme-$i 
	wp theme install ${array[i]} --allow-root
	mv /wp/wp-content/themes/theme-$i /devl/theme-$i
   ln -s /devl/theme-$i /wp/wp-content/themes/theme-$i
done

php-fpm
