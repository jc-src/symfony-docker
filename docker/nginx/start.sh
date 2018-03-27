#!/usr/bin/env sh

envsubst "`printf '${%s} ' $(sh -c "env|cut -d'=' -f1")`" < /tmp/default.conf.dev > /etc/nginx/conf.d/default.conf

nginx -g 'daemon off;'
