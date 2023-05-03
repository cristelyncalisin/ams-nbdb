@echo off
cd C:\NBDB-AMS\ams-nbdb
git pull origin master
php artisan clear-compiled
php artisan optimize
php artisan migrate --force

echo Batch file executed successfully.
timeout /t 1 > nul
exit
