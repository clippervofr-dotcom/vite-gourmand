#!/bin/sh
set -e

if [ ! -f /var/www/html/.env ]; then
  if [ -f /etc/secrets/.env ]; then
    cp /etc/secrets/.env /var/www/html/.env
  else
    cat > /var/www/html/.env <<EOF
MYSQL_DSN="${MYSQL_DSN}"
MYSQL_USER="${MYSQL_USER}"
MYSQL_PASS="${MYSQL_PASS}"
MONGO_DSN="${MONGO_DSN}"
LOCATIONIQ_KEY="${LOCATIONIQ_KEY}"
EOF
  fi
  chmod 644 /var/www/html/.env
fi

rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*
a2enmod mpm_prefork 2>/dev/null || true

exec apache2-foreground