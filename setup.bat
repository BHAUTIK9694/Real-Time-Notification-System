@echo off
setlocal

REM Project Setup Script

REM Check PHP version
for /f "delims=" %%a in ('php -r "echo PHP_VERSION;"') do set PHP_VERSION=%%a
echo PHP Version: %PHP_VERSION%

REM Install Composer Dependencies
composer install

REM Install NPM Packages
npm install

REM Generate Application Key
php artisan key:generate

REM Clear Configuration Cache
php artisan config:clear
php artisan cache:clear

REM Run Migrations
php artisan migrate:fresh

REM Seed Database
php artisan db:seed

REM Compile Frontend Assets
npm run dev

REM Start Development Server
php artisan serve

pause