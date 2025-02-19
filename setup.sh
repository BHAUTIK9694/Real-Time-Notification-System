#!/bin/bash

# Project Setup Script

# Check PHP version
php_version=$(php -r "echo PHP_VERSION;")
echo "PHP Version: $php_version"

# Install Composer Dependencies
composer install

# Install NPM Packages
npm install

# Generate Application Key
php artisan key:generate

# Clear Configuration Cache
php artisan config:clear
php artisan cache:clear

# Run Migrations
php artisan migrate:fresh

# Seed Database
php artisan db:seed

# Compile Frontend Assets
npm run dev

# Start Development Server
php artisan serve