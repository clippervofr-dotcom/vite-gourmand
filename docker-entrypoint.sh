#!/bin/sh
set -e

cat > /var/www/html/.env <<EOF
MYSQL_DSN=${MYSQL_DSN}
MYSQL_USER=${MYSQL_USER}
MYSQL_PASS=${MYSQL_PASS}
MONGO_DSN=${MONGO_DSN}
EOF

exec apache2-foreground