@echo off
cd C:\NBDB-AMS\ams-nbdb
git pull origin master
php artisan clear-compiled
php artisan optimize
php artisan migrate --force

php artisan serve
start chrome "http://127.0.0.1:8000"
