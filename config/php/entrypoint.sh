#!/bin/sh
set -e

# Create app log directory
mkdir -p /var/log/app
chown www-data:www-data /var/log/app
chmod 775 /var/log/app

# Execute the command passed to docker run
exec "$@"
