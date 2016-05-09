#!/bin/bash

docker run -v $(pwd)/sql:/docker-entrypoint-initdb.d -d --name mysql -e MYSQL_DATABASE=bbs -e MYSQL_ROOT_PASSWORD=secret mysql:5.6
docker run --name nginx --link mysql:mysql -p 8080:80 -v $(pwd)/public_html:/usr/share/nginx/html -d richarvey/nginx-php-fpm:latest
