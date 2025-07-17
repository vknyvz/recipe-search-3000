#!/bin/bash
set -e

# Start MySQL
/etc/init.d/mysql start

# Database setup
mysql -vv -se "CREATE DATABASE IF NOT EXISTS skeleton_app;"
mysql skeleton_app < /skeleton_app.sql

# Update root user password and grant privileges
mysql -vv -se "ALTER USER 'root'@'localhost' IDENTIFIED BY 'usman';"
mysql -vv -se "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost'; FLUSH PRIVILEGES;"

# Enable Apache rewrite module
a2enmod rewrite

# Keep container running with Apache
apachectl -D FOREGROUND
