#!/bin/bash
cp /home/site/wwwroot/docker-custom.conf /etc/nginx/sites-available/default
mkdir -p /home/site/wwwroot/storage/framework/cache/data
mkdir -p /home/site/wwwroot/storage/framework/sessions
mkdir -p /home/site/wwwroot/storage/framework/testing
mkdir -p /home/site/wwwroot/storage/framework/views
mkdir -p /home/site/wwwroot/storage/logs
chmod -R 775 /home/site/wwwroot/storage
chmod -R 775 /home/site/wwwroot/bootstrap/cache
chown -R www-data:www-data /home/site/wwwroot/storage
service nginx reload