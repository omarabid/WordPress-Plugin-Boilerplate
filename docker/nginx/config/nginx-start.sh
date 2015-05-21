#!/bin/bash
sed -i "s/%fpm-ip%/$PHP_PORT_9000_TCP_ADDR/" /etc/nginx/conf.d/default.conf

nginx
