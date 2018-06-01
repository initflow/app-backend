#!/bin/sh
set -u
set -e

php-fpm &
nginx -g "daemon off;"